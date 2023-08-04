<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\Sabuk;
use App\Service\Generator\SabukService;
use App\Repository\CoreRepository;

class SabukRepository extends CoreRepository
{
    protected $sabuk;

    public function __construct(Sabuk $sabuk)
    {
        $this->setModel($sabuk);
        $this->sabuk = $sabuk;
    }

    public function findWith($id, $relation)
    {
        return $this->sabuk->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->sabuk->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new SabukService($this);
        return $data->loadDataTable($access);
    }

}
