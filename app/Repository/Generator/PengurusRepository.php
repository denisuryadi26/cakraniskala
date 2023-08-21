<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\Pengurus;
use App\Service\Generator\PengurusService;
use App\Repository\CoreRepository;

class PengurusRepository extends CoreRepository
{
    protected $pengurus;

    public function __construct(Pengurus $pengurus)
    {
        $this->setModel($pengurus);
        $this->pengurus = $pengurus;
    }

    public function findWith($id, $relation)
    {
        return $this->pengurus->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->pengurus->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new PengurusService($this);
        return $data->loadDataTable($access);
    }

}
