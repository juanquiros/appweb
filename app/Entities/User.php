<?php
namespace App\Entities;
use CodeIgniter\Entity;

class User extends Entity{



    public function getLocalities(){
        $model = model('LocalityModel');
        return $model->find($this->attributes['id_localidad']);
    }
    public function getCountry(){
        $model = model('CountryModel');
        return $model->find($this->attributes['id_pais']);
    }
    public function getProvince(){
        $model = model('ProvinceModel');
        return $model->find($this->attributes['id_provincia']);
    }
}