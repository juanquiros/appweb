<?php

namespace App\Controllers;
use App\Models\UserModel;
class Usuario extends BaseController
{
    
    public function insertar()
    {
        $usuario = json_decode( $this->request->getPost('usuario'),true);       
        $model = model(UserModel::class);       
        if ($model->save($usuario) === false) {
            return $this->response->setStatusCode( 400)->setJSON(['errors' => $model->errors()]);            
        }else{
            return $this->response->setStatusCode( 200)->setJSON([
                'status' => 'success',
                'message' => 'Usuario registrado con éxito',
                'code' => 200]);
        }
    }
    public function actualizar()
    {
        
        $usuarioUpdate = json_decode($this->request->getRawInput()["usuario"],true);   
        $session = session();
        $model = model(UserModel::class);
        if($session->get('user')->id == $usuarioUpdate['id'] ){
            
            if ($model->where('id', $session->get('user')->id)->set($usuarioUpdate)->update() === false) {
                return $this->response->setStatusCode(400)->setJSON(['errors' => $model->errors()]);            
            }else{                
                $user = $model->where('id',$session->get('user')->id)->first();
                if(isset($user) && !empty($user)){ 
                        unset( $user->password);
                        $ses_data = [
                                'user' => $user,
                                'isLoggedIn' => TRUE
                            ];
                        $session->set($ses_data);
                }
                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'message' => 'Usuario actualizado con éxito',
                    'code' => 200]);
            }
        }else{
            return $this->response->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'El usuario no se puede actualizar',
                'code' => 401]);
        }
    }
    public function errorM(){
        $data = [
                'status' => 'error',
                'message' =>'Error en la peticion, solo metodo post',
                'code'=> 404];   
        return $this->response->setStatusCode( 404)->setJSON($data);
    }

       
}