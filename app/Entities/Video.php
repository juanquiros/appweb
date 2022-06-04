<?php
namespace App\Entities;
use CodeIgniter\Entity;

class Video extends Entity{
    public function getSearch(){
        $model = model('SearchModel');
        return $model->find($this->attributes['id_busqueda']);
    }
}