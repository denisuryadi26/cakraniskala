<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\UserRepository;
use App\Service\GroupService;
use App\Service\Generator\AgamaService;
use App\Service\Generator\SabukService;
use App\Service\Generator\UnlatService;
use App\Service\Generator\CategoryService;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Service\UploadHandler;

class UserController extends CoreController
{
    protected $menu;
    protected $userRepository;
    protected $userService;
    private $settingVal;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->menu = $this->get_menu();
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->settingVal = $this->get_all_setting();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(UserService $userService, GroupService $groupService, AgamaService $agamaService, UnlatService $unlatService, SabukService $sabukServise, CategoryService $categoryServise)
    {
        $group = $groupService->all();
        $agama = $agamaService->all();
        $sabuk = $sabukServise->all();
        $kategori = $categoryServise->all();
        $unlat = $unlatService->all();
        $user = $userService->all();
        // $status = ['Aktif', 'Tidak Aktif'];
        $status = [
            'Aktif' => 1,
            'Tidak Aktif' => 0,
        ];
        return view('admin.contents.user.index', [
            'menu' => $this->menu,
            'group' => $group,
            'agama' => $agama,
            'sabuk' => $sabuk,
            'kategori' => $kategori,
            'unlat' => $unlat,
            'status' => $status,
            'user' => $user,
            'setting' => ($this->settingVal ? $this->settingVal : ''),
            'access' => $this->user_access
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
        $validate = $this->userService->formValidate($request->all());
        if ($validate) {
            return response()->json(
                $validate,
                200
            );
        }

        $input = $request->all();
        // dd($input);
        $id = $input['id'];

        if ($request->hasFile('profile_picture')) {
            // dd($request->hasFile('image'));
            $profile_picture = $this->userService->insertFiles($uploadHandler, $this->userRepository->getModel(), $request, 'profile_picture', $id);
        } else {
            $profile_picture = $this->userService->find($id)->profile_picture;
        }
        if ($request->hasFile('dokument')) {
            // dd($request);
            $dokument = $this->userService->insertFiles($uploadHandler, $this->userRepository->getModel(), $request, 'dokument', $id);
        } else {
            $dokument = $this->userService->find($id)->dokument;
        }
        $input['profile_picture'] = $profile_picture;
        $input['dokument'] = $dokument;
        $input['password'] = bcrypt($request->get('password'));
        // dd($input);
        $user = $this->userRepository->save($input);
        return response()->json([
            'status' => 'success',
            'message' => "Data is successfully  " . (is_object($user) == true ? 'added' : 'updated')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $id  = $request->only('id');
        $this->userRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data is successfully deleted'
        ], 200);
    }
    public function get(Request $request)
    {
        $id = $request->get('id');
        $data = $this->userRepository->find($id, ['group', 'agama', 'sabuk', 'unlat', 'kategori']);

        return response()->json(['data' => $data], 200);
    }

    public function __datatable()
    {
        return $this->load_data_table($this->userRepository);
    }
}
