<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Repository\SettingRepository;
use App\Repository\UserRepository;
use App\Service\GroupService;
use App\Service\Generator\AgamaService;
use App\Service\Generator\SabukService;
use App\Service\Generator\UnlatService;
use App\Service\Generator\CategoryService;
use App\Service\SettingService;
use App\Service\UploadHandler;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;

class ProfileController extends CoreController
{
    private $menu;
    private $settingVal;
    protected $userService;
    protected $userRepository;
    protected $groupService;
    protected $agamaService;
    protected $categoryServise;
    protected $sabukServise;
    protected $unlatService;

    public function __construct(UserService $userService, UserRepository $userRepository, GroupService $groupService, AgamaService $agamaService, UnlatService $unlatService, SabukService $sabukServise, CategoryService $categoryServise)
    {
        $this->menu = $this->get_menu();
        $this->settingVal = $this->get_all_setting();
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->groupService = $groupService;
        $this->agamaService = $agamaService;
        $this->sabukServise = $sabukServise;
        $this->categoryServise = $categoryServise;
        $this->unlatService = $unlatService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $group = $this->groupService->all();
        $agama = $this->agamaService->all();
        $sabuk = $this->sabukServise->all();
        $kategori = $this->categoryServise->all();
        $unlat = $this->unlatService->all();
        //        return view('admin.contents.profile.index', ['menu' => ($this->menu ? $this->menu : ''), 'setting' => ( $this->settingVal ? $this->settingVal : '')]);
        return view('admin.contents.profile.index', [
            'menu' => $this->menu,
            'group' => $group,
            'agama' => $agama,
            'sabuk' => $sabuk,
            'kategori' => $kategori,
            'unlat' => $unlat,
            'setting' => ($this->settingVal ? $this->settingVal : ''),
            'profile' => $this->userService->find(Auth::user()->id, 'group')
        ]);
    }

    public function store(Request $request, UploadHandler $uploadHandler): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $id = Auth::user()->id;

        if ($request->hasFile('fileUpload')) {
            $pp = $this->userService->insertFiles($uploadHandler, $this->userRepository->getModel(), $request, 'profile_picture', $id);
        } else {
            $pp = $this->userService->find($id)->profile_picture;
        }
        // $input['password'] = bcrypt($input['password']);

        // Only hash and set password if provided
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }
        $input['profile_picture'] = $pp;
        // dd($input);

        $user = $this->userRepository->save($input);

        return response()->json([
            'status' => 'success',
            'message' => "Data is successfully  " . (is_object($user) == true ? 'added' : 'updated')
        ], 200);
    }
}
