<?php

namespace App\Controllers;
use App\Models\CountryModel;
class ModificarPerfil extends BaseController
{
    public function index(){      
        $model= new CountryModel;
        $data['countries']  = $model->findAll();
        $data['title'] = "Modificar datos de Usuario";
        return view('view_modificarperfil', $data);
    }

   

}
