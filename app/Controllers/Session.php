<?php

namespace App\Controllers;
use App\Models\UserModel;
class Session extends BaseController
{
    public function login()
    {
        $session = session();
        $data = [
            'status'=>'error',
            'message' =>'Faltan datos en la petición',
            'code'=> 400];       
        if(!empty($this->request->getPost('json'))){            
            $login = json_decode( $this->request->getPost('json'),true);            
            if(isset($login['password']) && !empty($login['password'])){                
                if(isset($login['email']) && !empty($login['email'])){
                    $data = [
                        'status'=>'error',
                        'message' =>'Email o password incorrecto',
                        'code'=> 400];
                    
                    $model = model(UserModel::class);
                    $user = $model->where('email',$login['email'])->first();
                    if(isset($user) && !empty($user)){ 
                        if (password_verify($login['password'],$user->password)) {
                            unset( $user->password);
                            $ses_data = [
                                    'user' => $user,
                                    'isLoggedIn' => TRUE
                                ];
                            $session->set($ses_data);
                            $data = [
                                'status'=>'success',
                                'code'=> 200];
                        }   
                                            
                    }
                    
                }
            }
        }
        return $this->response->setStatusCode( $data['code'])->setJSON($data);
    }

   

}
