<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Locality;
class LocalityModel extends Model
{
    protected $table = 'localidades';
    protected $returnType = Locality::class;
}