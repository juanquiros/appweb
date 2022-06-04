<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Search;
class SearchModel extends Model
{
    protected $table = 'busquedas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_usuario','titulo','terminos_busqueda','created_at','updated_at'];
    protected $returnType = Search::class;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $validationRules    = [
        'titulo'     => 'required|alpha_numeric_space|min_length[3]',
        'terminos_busqueda'     => 'required',
        'id_usuario'=> 'required|is_not_unique[usuarios.id]'
    ];
}