<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Service\Generator;


use App\Models\Generator\Sabuk;
use App\Repository\Generator\SabukRepository;
use Illuminate\Support\Facades\Validator;
use App\Service\CoreService;

class SabukService extends CoreService
{
    protected $sabukRepository;

    public function __construct(SabukRepository $sabukRepository)
    {
        $this->sabukRepository = $sabukRepository;
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

        if($validator->fails()){
            return [
                'status'=> 'error',
                'message' => $messages
            ];
        }
        return 0;
    }

    public function all()
    {
        return $this->sabukRepository->all();
    }

    public function find($id, $relation = null)
    {
        return $this->sabukRepository->find($id, $relation);
    }

    public function loadDataTable($access){
        $model = Sabuk::withoutTrashed()->get();
        return $this->privilageBtnDatatable($model, $access);
    }
}
