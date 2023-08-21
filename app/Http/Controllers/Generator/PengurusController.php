<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers\Generator;

use App\Models\Generator\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CoreController;


use App\Repository\Generator\PengurusRepository;
use App\Service\Generator\PengurusService;
use App\Service\UploadHandler;


class PengurusController extends CoreController
{
    protected $menu;
    private $settingVal;
    protected $pengurusRepository;
    protected $pengurusService;

    public function __construct(PengurusRepository $pengurusRepository, PengurusService $pengurusService)
    {
        $this->menu = $this->get_menu();
        $this->pengurusRepository = $pengurusRepository;
        $this->pengurusService = $pengurusService;
        $this->settingVal = $this->get_all_setting();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contents.pengurus.index', [
            'menu' => ($this->menu ? $this->menu : ''),
            'setting' => ($this->settingVal ? $this->settingVal : '')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, UploadHandler $uploadHandler)
    {
        // $validate = $this->pengurusService->formValidate($request->all());
        // if ($validate) {
        //     return response()->json(
        //         $validate,
        //         200
        //     );
        // }
        $input = $request->all();
        $id = $input['id'];

        if ($request->hasFile('image')) {
            $image = $this->pengurusService->insertFiles($uploadHandler, $this->pengurusRepository->getModel(), $request, 'pengurus', $id);
        } else {
            $image = $this->pengurusService->find($id)->image;
        }
        $input['image'] = $image;
        $pengurus = $this->pengurusRepository->save($input);

        return response()->json([
            'status' => 'success',
            'message' => "Data is successfully  " . (is_object($pengurus) == true ? 'added' : 'updated')
        ], 200);
    }

    public function destroy(Request $request)
    {
        $id  = $request->only('id');
        $pengurus = $this->pengurusRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data is successfully deleted'
        ], 200);
    }

    public function get(Request $request)
    {
        $id = $request->get('id');
        $data = $this->pengurusRepository->find($id);

        return response()->json(['data' => $data], 200);
    }

    public function __datatable()
    {
        return $this->load_data_table($this->pengurusRepository);
    }
}
