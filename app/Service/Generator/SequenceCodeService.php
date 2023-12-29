<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Service\Generator;


use App\Models\Generator\SequenceCode;
use App\Repository\Generator\SequenceCodeRepository;
use Illuminate\Support\Facades\Validator;
use App\Service\CoreService;

class SequenceCodeService extends CoreService
{
    protected $sequencecodeRepository;

    public function __construct(SequenceCodeRepository $sequencecodeRepository)
    {
        $this->sequencecodeRepository = $sequencecodeRepository;
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
        return $this->sequencecodeRepository->all();
    }

    public function find($id, $relation = null)
    {
        return $this->sequencecodeRepository->find($id, $relation);
    }

    public function loadDataTable($access){
        $model = SequenceCode::withoutTrashed()->get();
        return $this->privilageBtnDatatable($model, $access);
    }
}
