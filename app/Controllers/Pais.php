<?php

namespace App\Controllers;
use App\Models\CountryModel;
use CodeIgniter\API\ResponseTrait;
class Pais extends BaseController
{
    use ResponseTrait;
    public function getProvinces($id_pais)
    {
        //  return view('view_registro');
        $model= new CountryModel;
        $data = array();
        $country = $model->find($id_pais);
        $code = 404;
        if(isset($country) && !empty($country)){
            $data+= ['country' => $country];
            $data+= ['provinces' =>  $data['country']->getProvinces()];
            $code = 200;
        }else{
            $data+= ['message' =>'No existe el pais id= ' . $id_pais,'code'=> $code];
        }
        
        
        return $this->response->setStatusCode( $code)->setJSON($data);
    }
    public function index(){
        $model = new CountryModel;
        $countries = $model->findAll();
        $code = 200;
        if(!isset($countries) || empty($countries)){
            $countries =['provinces' => 'No se encontraron paises'];
             $code = 404;
        }
        return $this->response->setStatusCode($code)->setJSON($countries); 
    }
}
