<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers\Generator;

use App\Models\Generator\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CoreController;


use App\Repository\Generator\GalleryRepository;
use App\Service\Generator\GalleryService;
use App\Service\UploadHandler;


class GalleryController extends CoreController
{
    protected $menu;
    private $settingVal;
    protected $galleryRepository;
    protected $galleryService;

    public function __construct(GalleryRepository $galleryRepository, GalleryService $galleryService)
    {
        $this->menu = $this->get_menu();
        $this->galleryRepository = $galleryRepository;
        $this->galleryService = $galleryService;
        $this->settingVal = $this->get_all_setting();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contents.gallery.index', [
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
        // $validate = $this->galleryService->formValidate($request->all());
        // if ($validate) {
        //     return response()->json(
        //         $validate,
        //         200
        //     );
        // }
        $input = $request->all();
        $id = $input['id'];

        if ($request->hasFile('image')) {
            $image = $this->galleryService->insertFiles($uploadHandler, $this->galleryRepository->getModel(), $request, 'gallery', $id);
        } else {
            $image = $this->galleryService->find($id)->image;
        }
        $input['image'] = $image;
        $gallery = $this->galleryRepository->save($input);

        return response()->json([
            'status' => 'success',
            'message' => "Data is successfully  " . (is_object($gallery) == true ? 'added' : 'updated')
        ], 200);
    }

    public function destroy(Request $request)
    {
        $id  = $request->only('id');
        $gallery = $this->galleryRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data is successfully deleted'
        ], 200);
    }

    public function get(Request $request)
    {
        $id = $request->get('id');
        $data = $this->galleryRepository->find($id);

        return response()->json(['data' => $data], 200);
    }

    public function __datatable()
    {
        return $this->load_data_table($this->galleryRepository);
    }
}
