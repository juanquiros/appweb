<?php
namespace App\Entities;
use CodeIgniter\Entity;

class Search extends Entity{



    public function getUser(){
        $model = model('UserModel');
        return $model->find($this->attributes['id_usuario']);
    }
}