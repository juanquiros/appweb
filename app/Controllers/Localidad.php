<?php

namespace App\Controllers;
use App\Models\LocalityModel;
use CodeIgniter\API\ResponseTrait;
class Localidad extends BaseController
{
    use ResponseTrait;
    public function getLocalidad($id_localidad)
    {       
        $model= new LocalityModel;
        $data = array();
        $locality = $model->find($id_localidad);
        $code = 404;
        if(isset( $locality) && !empty( $locality)){
            $data+= ['locality' =>$locality ];
            $data+= ["province" => $data['locality']->getProvince()];
            $data+= ["country" =>  $data['locality']->getCountry()];
            $code = 200;
        }else{
            $data+= ['message' => 'no se encontro la localidad con id='. $id_localidad ,'code'=> $code];
        }    
        return $this->response->setStatusCode( $code)->setJSON($data);
         
    }
    
}