<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\SequenceCode;
use App\Service\Generator\SequenceCodeService;
use App\Repository\CoreRepository;

class SequenceCodeRepository extends CoreRepository
{
    protected $sequencecode;

    public function __construct(SequenceCode $sequencecode)
    {
        $this->setModel($sequencecode);
        $this->sequencecode = $sequencecode;
    }

    public function findWith($id, $relation)
    {
        return $this->sequencecode->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->sequencecode->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new SequenceCodeService($this);
        return $data->loadDataTable($access);
    }

}
