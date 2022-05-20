<?php

namespace App\Controllers;
use App\Models\CountryModel;
class Registro extends BaseController
{
    public function index()
    {
      //  
      $model= new CountryModel;
      $data['countries']  = $model->findAll();
      $data['title'] = "Registro";
      return view('view_registro', $data);
    }
    public function email_available(){
      $data = [
        'status' => 'error',
        'message' =>'error en parametro post',
        'email_available' => false,
        'code'=> 400];
        $emailConsulta = $this->request->getPost('json');
      if(!empty($emailConsulta)){
          $email = json_decode( $emailConsulta,true);
          $model = model(UserModel::class);
          $user = $model->select('email')->where('email',$email)->first();
          $data['status'] = 'success';
          $data['message'] = 'El email esta disponible';
          $data['email_available'] = true;
          $data['code'] = 200; 
          if(isset($user->email) && !empty($user->email)){
              $data['message'] = 'El email ya existe y esta asignado a un usuario';
              $data['email_available'] = false;
          }
      }                
      return $this->response->setStatusCode($data['code'])->setJSON($data);
    }
}
