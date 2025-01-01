<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers;

use App\Exports\UserList;
use App\Models\User;
use App\Repository\UserRepository;
use App\Service\GroupService;
use App\Service\Generator\AgamaService;
use App\Service\Generator\SabukService;
use App\Service\Generator\UnlatService;
use App\Service\Generator\CategoryService;
use App\Service\Generator\SequenceCodeService;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Service\UploadHandler;
use Maatwebsite\Excel\Facades\Excel;

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
    public function index(UserService $userService, GroupService $groupService, AgamaService $agamaService, UnlatService $unlatService, SabukService $sabukServise, CategoryService $categoryServise, SequenceCodeService $sequenceCodeService)
    {
        $group = $groupService->all();
        $agama = $agamaService->all();
        $sabuk = $sabukServise->all();
        $kategori = $categoryServise->all();
        $unlat = $unlatService->all();
        $user = $userService->all();
        $digit = $sequenceCodeService->digitCn();
        $getSequence = $this->userService->getSequence();
        $sum = 1;
        // $updateSequence = $sum += $getSequence;
        $updateSequence = $getSequence + $sum;
        $updateSequenceFormatted = str_pad($updateSequence, $digit['sequence_digit'], '0', STR_PAD_LEFT);
        // update sequence
        // $updatesequence = $this->userService->updateSequence($updateSequence);
        // $updatesequence = $this->requestdetailService->updateSequence($updateSequence);
        $newSequence = $updateSequenceFormatted;
        // dd($updateSequenceFormatted);
        $status = [
            1 => 'YA',
            0 => 'TIDAK',
        ];
        return view('admin.contents.user.index', [
            'menu' => $this->menu,
            'group' => $group,
            'agama' => $agama,
            'sabuk' => $sabuk,
            'code' => $newSequence,
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
            // Proses file upload
            $dokument = $this->userService->insertFiles($uploadHandler, $this->userRepository->getModel(), $request, 'dokument', $id);
        } else {
            // Cek jika data ditemukan
            $user = $this->userService->find($id);
            $dokument = $user ? $user->dokument : null; // Jika tidak ada data, set null
        }
        if ($request->hasFile('kta')) {
            // Proses file upload
            $kta = $this->userService->insertFiles($uploadHandler, $this->userRepository->getModel(), $request, 'kta', $id);
        } else {
            // Cek jika data ditemukan
            $user = $this->userService->find($id);
            $kta = $user ? $user->kta : null; // Jika tidak ada data, set null
        }

        $input['profile_picture'] = $profile_picture;
        $input['dokument'] = $dokument;
        $input['kta'] = $kta;
        // Only hash and set password if provided
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }
        // dd($input);
        // Check if $id is not present
        if (empty($id)) {
            // Execute the sequence update logic
            $getSequence = $this->userService->getSequence();
            $sum = 1;
            $updateSequence = $sum + $getSequence;
            // Update sequence
            $updatesequence = $this->userService->updateSequence($updateSequence);
        }
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
        // dd($request);
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

    public function __datatable(Request $request)
    {
        $nik = $request->get('nik');
        $name = $request->get('name');
        $status = $request->get('status');
        $unlat = $request->get('unlat');
        $is_kta = $request->get('is_kta');
        // dd($nik);
        $filter = [
            'nik' => $nik,
            'name' => $name,
            'status' => $status,
            'unlat' => $unlat,
            'is_kta' => $is_kta,
        ];
        // return $this->userService->loadDataTable($request);
        return $this->load_data_table($this->userRepository, $filter);
    }

    public function generateUserCode(Request $request)
    {
        // dd($request);
        // $user_id = $request->get('id');
        $data = $this->userService->generateUserCode(['type' => 'CN']);

        return response()->json(['data' => $data], 200);
    }

    public function downloadUsers(Request $request)
    {
        // dd($request);
        $status = $request->get('status');
        $unlat = $request->get('unlat');
        $nik = $request->get('nik');
        $name = $request->get('name');
        $is_kta = $request->get('is_kta');
        // dd($request);
        $filename = "user_list";
        $filter = [];

        if ($nik) {
            $filename .= '_' . $nik;
            $filter = ['nik' => $nik];
        }

        if ($name) {
            $filename .= '_' . $name;
            $filter = ['name' => $name];
        }

        if ($unlat) {
            $filename .= '_' . $unlat;
            $filter = ['unlat' => $unlat];
        }

        if ($is_kta) {
            $filename .= '_' . $is_kta;
            $filter = ['is_kta' => $is_kta];
        }

        if ($status) {
            $status = explode(',', $status);
            //            dd($status);
            //            $filename .= '_'.$status;
            //            $filter = ['status' => $status];
        }

        $dataUser = $this->userService->getUserList($nik, $name, $unlat, $status, $is_kta);
        // echo "<pre>";
        // print_r($dataUser);
        // die();
        // return Excel::download(new ReportOrder($dataReport, $filter ), "$filename.xlsx");
        return Excel::download(new UserList($dataUser, $filter), "$filename.xlsx");

        //        $this->reportorderService->generateReportUsage($dataReport);
        //        return Excel::download(new ReportLimitUsage($dataReport), "$filename.xlsx");

    }
}
