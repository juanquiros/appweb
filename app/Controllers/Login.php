<?php

namespace App\Controllers;
class Login extends BaseController
{
    public function index()
    {
      $data['title'] = "Login";
      return view('view_login',$data);
    }

    public function logout(){
      $data['title'] = "Login";      
      $data['sub'] = true;
      $session = session();
      $data['nombre'] = $session->get('user')->nombre;
      if(isset($session) && !empty($session)){
          $session->destroy();            
      }

      return view('view_logout',$data);
    }

}
