<?php

namespace App\Controllers;
use App\Models\SearchModel;
class Busquedas extends BaseController
{
    public function index()
    {        
       
    }
    public function insertar()
    {
        $busqueda = json_decode( $this->request->getPost('busqueda'),true);       
        $model = model(SearchModel::class);  
        $insert = $model->save($busqueda);     
        if ($insert === false) {
            return $this->response->setStatusCode( 400)->setJSON(['errors' => $model->errors()]);            
        }else{
            return $this->response->setStatusCode( 200)->setJSON([
                'status' => 'success',
                'message' => 'Busqueda registrada con éxito',
                'id_busqueda' => $model->getInsertID(),
                'code' => 200]);
        }
    }

    public function getBusquedas()
    {
        $session = session();
        $model= new SearchModel;
        $data = array();
        $busqueda = $model->where("id_usuario",$session->get('user')->id)->findAll();
        $code = 404;
        if(isset($busqueda) && !empty($busqueda)){
            $data+= ['busquedas' => $busqueda];
            $code = 200;
        }else{
            $data+= ['message' =>'No existen busquedas ' . $session->get('user')->id,'code'=> $code];
        }
        
        
        return $this->response->setStatusCode( $code)->setJSON($data);
    }
}