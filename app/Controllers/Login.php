<?php

namespace App\Controllers;
class Login extends BaseController
{
    public function index()
    {
      
      return view('view_login');
    }

    public function logout(){
        echo "Log Out";
    }

}
