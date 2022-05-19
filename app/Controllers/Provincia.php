<?php

namespace App\Controllers;
use App\Models\ProvinceModel;
use CodeIgniter\API\ResponseTrait;
class Provincia extends BaseController
{
    use ResponseTrait;
    public function getProvince($id_provincia)
    {
        
        $model= new ProvinceModel;
        $data = array();
        $province = $model->find($id_provincia);
        $code = 404;
        if(isset( $province) && !empty( $province)){
            $data+= ['province' =>$province ];
            $data+= ["country" => $data['province']->getCountry()];
            $data+= ["localities" =>  $data['province']->getLocalities()];
            $code = 200;
        }else{
            $data+= ['message' => 'no se encontro la provincia con id='. $id_provincia ,'code'=> $code];
        }    
        return $this->response->setStatusCode( $code)->setJSON($data);
         
    }
    
}
