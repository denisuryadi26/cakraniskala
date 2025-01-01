<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Service;


use App\Models\Group;
use App\Models\User;
use App\Models\Agama;
use App\Models\Generator\SequenceCode;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function getUserList($nik = null, $name = null, $unlat = null, $status = null, $is_kta = null)
    {

        $data = User::withoutTrashed()->with(['group', 'agama', 'sabuk', 'unlat', 'kategori'])
            ->orderBy('code', 'DESC'); // Add orderBy here

        if ($nik) {
            $data->where(DB::raw('nik'), $nik);
        }

        if ($name) {
            $data->where(DB::raw('name'), $name);
        }

        if ($unlat) {
            $data->where(DB::raw('unlat_id'), $unlat);
        }

        if ($status) {
            $data->whereIn('status', $status);
        }

        if ($is_kta) {
            $data->where(DB::raw('is_kta'), $is_kta);
        }

        // dd($data->get());
        return $data->get();
    }

    public function generateUserCode(array $param)
    {
        $row = SequenceCode::withoutTrashed()->where($param)->first();
        if (empty($row)) return null;

        return generateCode($row);
    }

    public function countAll()
    {
        return User::whereDoesntHave('group', function ($query) {
            $query->where('code', 'SPRADM');
        })
            ->count();
    }

    public function countActif()
    {
        return User::where('status', '1')
            ->whereDoesntHave('group', function ($query) {
                $query->where('code', 'SPRADM');
            })
            ->count();
    }

    public function countInactif()
    {
        return User::where('status', '0')->count();
    }

    public function find($id, $relation = null)
    {
        return $this->userRepository->find($id, $relation);
    }

    public function loadDataTable($access, $filter = null)
    {
        // dd($filter);
        $model = User::withoutTrashed()->with(['group', 'agama', 'sabuk', 'unlat', 'kategori'])
            ->orderBy('code', 'DESC'); // Add orderBy here

        if (isset($filter) && $filter['nik']) {
            $model->where(['nik' => $filter['nik']]);
        }
        if (isset($filter) && $filter['name']) {
            $model->where('fullname', 'like', '%' . $filter['name'] . '%');
        }
        if (isset($filter['status']) && $filter['status'] !== null) {
            $model->where(['status' => $filter['status']]);
        }
        if (isset($filter) && $filter['unlat']) {
            $model->where(['unlat_id' => $filter['unlat']]);
        }
        if (isset($filter['is_kta']) && $filter['is_kta'] !== null) {
            $model->where(['is_kta' => $filter['is_kta']]);
        }

        $data = DataTables::of($model)->addIndexColumn()

            ->addColumn('action', function ($model) use ($access) {
                $delete_btn = '';
                $update_btn = '';
                $view_btn = '';
                $biodata_btn = '';
                $code = $model->code;
                $parent_id = null;

                if ($model->parent) {
                    $parent_id = $model->parent->id;
                }
                $adminName = Auth::user()->fullname;

                if ($access->is_viewable == true) {
                    $view_btn = "<button class='btn btn-icon btn-info btn-glow mr-1 mb-1 view'
                             data-toggle='tooltip' data-placement='top' title='View Data' id='view' data-parent_id='$parent_id' data-code='$model->code' data-id='$model->id' style='margin:3px'>
                                <i class='tf-icons ti ti-eye'></i>
                        </button>";
                }

                if ($access->is_deletable == true) {
                    $model->name = ($model->name ? $model->name : ($model->username ? $model->username : $model->parameter));
                    $delete_btn = "<button class='btn btn-icon btn-danger btn-glow mr-1 mb-1 delete'
                             data-toggle='tooltip' data-placement='top' title='Delete Data' data-parent_id='$parent_id' id='delete' data-name='$model->name' style='margin:3px' data-code='$model->code' data-id='$model->id'>
                                <i class='tf-icons ti ti-trash'></i>
                           </button>";
                }
                if ($access->is_editable == true) {
                    $update_btn = "<button class='btn btn-icon btn-warning btn-glow mr-1 mb-1 update'
                             data-toggle='tooltip' data-placement='top' title='Edit Data' data-name='$model->name' style='margin:3px' data-code='$model->code' data-id='$model->id'>
                                <i class='tf-icons ti ti-pencil'></i>
                           </button>";
                }

                if (!is_null($model->code)) {
                    $biodata_btn = "<a href='" . route('biodata', ['id' => $model->code]) . "' target='_blank'
                                                class='btn btn-icon btn-secondary btn-glow mr-1 mb-1' data-toggle='tooltip'
                                                data-placement='top' title='Open Biodata' style='margin:3px'>
                                                    <i class='tf-icons ti ti-users'></i>
                                                </a>";
                }

                $action = $view_btn . $update_btn . $delete_btn . $biodata_btn;
                return $action;
            })
            ->make(true);
        return $data;
    }



    public function getSequence()
    {
        $model = SequenceCode::withoutTrashed()->select('sequence', 'sequence_digit')->where('type', 'CN')->get();
        // dd($model[0]['sequence']);
        $sequence = $model[0]['sequence'];
        $sequence_digit = $model[0]['sequence_digit'];
        $model['sequence'] = $sequence;
        $sequence = strval($sequence);
        $sequence_digit = intval($sequence_digit);
        return str_pad($sequence, $sequence_digit, '0', STR_PAD_LEFT);
    }

    public function updateSequence($updateSequence)
    {
        // dd($updateSequence);

        // $order_code = $order_code + 1;
        // dd($value);
        $data =
            array(
                'sequence' => $updateSequence
            );
        // echo "<pre>";
        // print_r($data);die();
        DB::table('tbl_sequencecode')
            ->where('type', 'CN')
            ->update($data);

        return $data;
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

        if ($request->hasFile('kta')) {
            $file = $request['kta'];
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
