<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\Perguruan;
use App\Service\Generator\PerguruanService;
use App\Repository\CoreRepository;

class PerguruanRepository extends CoreRepository
{
    protected $perguruan;

    public function __construct(Perguruan $perguruan)
    {
        $this->setModel($perguruan);
        $this->perguruan = $perguruan;
    }

    public function findWith($id, $relation)
    {
        return $this->perguruan->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->perguruan->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new PerguruanService($this);
        return $data->loadDataTable($access);
    }

}
