<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Service\Generator;


use App\Models\Generator\Unlat;
use App\Repository\Generator\UnlatRepository;
use Illuminate\Support\Facades\Validator;
use App\Service\CoreService;

class UnlatService extends CoreService
{
    protected $unlatRepository;

    public function __construct(UnlatRepository $unlatRepository)
    {
        $this->unlatRepository = $unlatRepository;
    }

    public function formValidate($request)
    {
        $rules = [
            //            'email' => 'required|min:1|unique:conf_users,email,NULL,id,deleted_at,NULL'
        ];
        $messages = [
            'email.unique' => 'Email sudah terdaftar.',
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message' => $messages
            ];
        }
        return 0;
    }

    public function all()
    {
        return $this->unlatRepository->all();
    }

    public function count()
    {
        return $this->unlatRepository->count();
    }

    public function find($id, $relation = null)
    {
        return $this->unlatRepository->find($id, $relation);
    }

    public function loadDataTable($access)
    {
        $model = Unlat::withoutTrashed()->get();
        return $this->privilageBtnDatatable($model, $access);
    }
}
