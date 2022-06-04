<?php

namespace App\Controllers;
use App\Models\SearchModel;
use App\Models\VideoModel;
class Videos extends BaseController
{
    public function getVideos($id_busqueda)
    {        
        $model= new VideoModel;
        $data = array();
        $videos = $model->where("id_busqueda",$id_busqueda)->findAll();
        $code = 404;
        if(isset($videos) && !empty($videos)){
            $data+= ['videos' => $videos];
            $code = 200;
        }else{
            $data+= ['message' =>'No existe la busqueda id= ' . $id_busqueda,'code'=> $code];
        }       
        return $this->response->setStatusCode( $code)->setJSON($data);
    }
    public function insertar()
    {
        $video = json_decode( $this->request->getPost('video'),true);       
        $model = model(VideoModel::class); 
        
        $insert = $model->save($video);     
        if ($insert === false) {
            return $this->response->setStatusCode( 400)->setJSON(['errors' => $model->errors()]);            
        }else{
            return $this->response->setStatusCode( 200)->setJSON([
                'status' => 'success',
                'message' => 'Video registrado con éxito',
                'id' => $model->getInsertID(),
                'code' => 200]);
        }
    }
    public function borrar($id_busqueda,$id_video)
    {
        $session = session();
        
        $Searchmodel = model(SearchModel::class);
        $Videomodel = model(VideoModel::class);    
        $search = $Searchmodel->find($id_busqueda);
        if($search->id_usuario == $session->get('user')->id){
            $video = $Videomodel->where("id_busqueda",$search->id)->where("id",$id_video)->find();
            if(isset($video)&& !empty($video)){
                $delete = $Videomodel->delete($id_video);     
                if ($delete === false) {
                    return $this->response->setStatusCode( 400)->setJSON(['errors' => $model->errors()]);            
                }else{
                    return $this->response->setStatusCode( 200)->setJSON([
                        'status' => 'success',
                        'message' => 'Video borrado con éxito',
                        'code' => 200]);
                }
            }else{
                return $this->response->setStatusCode( 200)->setJSON([
                    'status' => 'error',
                    'message' => 'No se borro el video',
                    'code' => 400]);
            }
        }else{
            return $this->response->setStatusCode( 200)->setJSON([
                'status' => 'error',
                'message' => 'No se borro el video',
                'code' => 400]);
        }
        
    }
}