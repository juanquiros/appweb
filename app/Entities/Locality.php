<?php
namespace App\Entities;
use CodeIgniter\Entity;

class Locality extends Entity{

    public function getProvince(){
        $model = model('ProvinceModel');
        return $model->where('id', $this->attributes['id_provincia'])->first();
    }
    public function getCountry(){
        $model = model('CountryModel');
        $province = $this->getProvince();
        return $model->where('id', $province->id_pais)->first();
    }

}