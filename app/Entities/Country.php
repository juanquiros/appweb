<?php
namespace App\Entities;
use CodeIgniter\Entity;

class Country extends Entity{

    public function getProvinces(){
        $model = model('ProvinceModel');
        return $model->where('id_pais', $this->attributes['id'])->findAll();
    }

}