<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\Agama;
use App\Service\Generator\AgamaService;
use App\Repository\CoreRepository;

class AgamaRepository extends CoreRepository
{
    protected $agama;

    public function __construct(Agama $agama)
    {
        $this->setModel($agama);
        $this->agama = $agama;
    }

    public function findWith($id, $relation)
    {
        return $this->agama->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->agama->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new AgamaService($this);
        return $data->loadDataTable($access);
    }

}
