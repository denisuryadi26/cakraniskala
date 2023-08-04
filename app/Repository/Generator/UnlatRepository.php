<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\Unlat;
use App\Service\Generator\UnlatService;
use App\Repository\CoreRepository;

class UnlatRepository extends CoreRepository
{
    protected $unlat;

    public function __construct(Unlat $unlat)
    {
        $this->setModel($unlat);
        $this->unlat = $unlat;
    }

    public function findWith($id, $relation)
    {
        return $this->unlat->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->unlat->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new UnlatService($this);
        return $data->loadDataTable($access);
    }

}
