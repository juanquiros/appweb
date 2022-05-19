<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Province;
class ProvinceModel extends Model
{
    protected $table = 'provincias';
    protected $primaryKey = 'id';
    protected $returnType = Province::class;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
  
    
    
}