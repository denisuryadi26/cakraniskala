<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Service\Generator;


use App\Models\Generator\Agama;
use App\Repository\Generator\AgamaRepository;
use Illuminate\Support\Facades\Validator;
use App\Service\CoreService;

class AgamaService extends CoreService
{
    protected $agamaRepository;

    public function __construct(AgamaRepository $agamaRepository)
    {
        $this->agamaRepository = $agamaRepository;
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
        return $this->agamaRepository->all();
    }

    public function find($id, $relation = null)
    {
        return $this->agamaRepository->find($id, $relation);
    }

    public function loadDataTable($access){
        $model = Agama::withoutTrashed()->get();
        return $this->privilageBtnDatatable($model, $access);
    }
}
