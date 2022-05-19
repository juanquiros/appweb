<?php
namespace App\Entities;
use CodeIgniter\Entity;

class Province extends Entity{
    public function getLocalities(){
        $model = model('LocalityModel');
        return $model->where('id_provincia', $this->attributes['id'])->findAll();
    }
    public function getCountry(){
        $model = model('CountryModel');
        return $model->find($this->attributes['id_pais']);
    }


}