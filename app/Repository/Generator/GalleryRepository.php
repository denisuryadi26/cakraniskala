<?php
/**
* @author Dodi Priyanto<dodi.priyanto76@gmail.com>
*/

namespace App\Repository\Generator;

use App\Models\Generator\Gallery;
use App\Service\Generator\GalleryService;
use App\Repository\CoreRepository;

class GalleryRepository extends CoreRepository
{
    protected $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->setModel($gallery);
        $this->gallery = $gallery;
    }

    public function findWith($id, $relation)
    {
        return $this->gallery->with("$relation")->find($id);
    }

    public function get_all(){
        return $this->gallery->withTrashed()->get();
    }

    public function dataTable($access)
    {
        $data = new GalleryService($this);
        return $data->loadDataTable($access);
    }

}
