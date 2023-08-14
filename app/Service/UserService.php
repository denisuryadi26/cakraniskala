<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Service;


use App\Models\Group;
use App\Models\User;
use App\Models\Agama;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class UserService extends CoreService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function formValidate($request)
    {
        // dd($request['nik']);
        $rules = [
            //            'email' => 'required|min:1|unique:conf_users,email,NULL,id,deleted_at,NULL'
            'nik' => 'required|unique:conf_users'
        ];
        // dd($rules);
        $messages = [
            'nik.unique' => 'Nik sudah terdaftar.',
        ];
        // $validator = Validator::make($request, $rules, $messages);
        if ($request['id']) {
            // dd('ada idnya');
            return 0;
        } else {
            $cek = User::where('nik', $request['nik'])->first();
            // dd($cek);

            if ($cek) {
                return [
                    'status' => 'error',
                    'message' => $messages
                ];
            }
        }
        return 0;
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function countActif()
    {
        return User::where('status', '1')->count();
    }

    public function countInactif()
    {
        return User::where('status', '0')->count();
    }

    public function find($id, $relation = null)
    {
        return $this->userRepository->find($id, $relation);
    }

    public function loadDataTable($access)
    {
        $model = User::withoutTrashed()->with(['group', 'agama', 'sabuk', 'unlat', 'kategori'])->get();
        // dd($model);
        return $this->privilageBtnDatatable($model, $access);
    }



    public function insertFiles(
        $uploadHandler,
        User $user,
        Request $request,
        $directory = null,
        $userId = null
    ) {
        if ($userId) {
        } else {
        }

        if ($request->hasFile('fileUpload')) {
            $file = $request['fileUpload'];
            $filename = $directory . '/' . $this->random_string(20) . '.' . $file->extension();
            $file->storeAs("public/images/", $filename);
            return $filename;
        };

        if ($request->hasFile('profile_picture')) {
            $file = $request['profile_picture'];
            $filename = $directory . '/' . $this->random_string(20) . '.' . $file->extension();
            $file->storeAs("public/images/", $filename);
            return $filename;
        };

        if ($request->hasFile('dokument')) {
            $file = $request['dokument'];
            $filename = $directory . '/' . $this->random_string(20) . '.' . $file->extension();
            $file->storeAs("public/images/", $filename);
            return $filename;
        };
        return $user;
    }

    public function deleteFile($path)
    {
        if (\File::exists("storage/images/$path")) {
            \File::delete("storage/images/$path");
        } else {
            dd('File does not exists.');
        }
    }
}
