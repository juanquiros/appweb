<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Video;
class VideoModel extends Model
{
    protected $table = 'videos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_busqueda','id_video','titulo','created_at','updated_at'];
    protected $returnType = Video::class;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $validationRules    = [
        'id_busqueda'     => 'required|is_not_unique[busquedas.id]',
        'id_video'=> 'required',
        'titulo'=> 'required'
    ];
}