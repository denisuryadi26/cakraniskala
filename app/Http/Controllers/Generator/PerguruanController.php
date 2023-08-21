<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers\Generator;

use App\Models\Generator\Perguruan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CoreController;


use App\Repository\Generator\PerguruanRepository;
use App\Service\Generator\PerguruanService;
use App\Service\UploadHandler;


class PerguruanController extends CoreController
{
    protected $menu;
    private $settingVal;
    protected $perguruanRepository;
    protected $perguruanService;

    public function __construct(PerguruanRepository $perguruanRepository, PerguruanService $perguruanService)
    {
        $this->menu = $this->get_menu();
        $this->perguruanRepository = $perguruanRepository;
        $this->perguruanService = $perguruanService;
        $this->settingVal = $this->get_all_setting();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contents.perguruan.index', [
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
        // $validate = $this->perguruanService->formValidate($request->all());
        // if ($validate)
        // {
        //     return response()->json(
        //         $validate
        //         ,200);
        // }
        $input = $request->all();
        $id = $input['id'];

        if ($request->hasFile('image')) {
            $image = $this->perguruanService->insertFiles($uploadHandler, $this->perguruanRepository->getModel(), $request, 'perguruan', $id);
        } else {
            $image = $this->perguruanService->find($id)->image;
        }
        $input['image'] = $image;
        $perguruan = $this->perguruanRepository->save($input);

        return response()->json([
            'status' => 'success',
            'message' => "Data is successfully  " . (is_object($perguruan) == true ? 'added' : 'updated')
        ], 200);
    }

    public function destroy(Request $request)
    {
        $id  = $request->only('id');
        $perguruan = $this->perguruanRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data is successfully deleted'
        ], 200);
    }

    public function get(Request $request)
    {
        $id = $request->get('id');
        $data = $this->perguruanRepository->find($id);

        return response()->json(['data' => $data], 200);
    }

    public function __datatable()
    {
        return $this->load_data_table($this->perguruanRepository);
    }
}
