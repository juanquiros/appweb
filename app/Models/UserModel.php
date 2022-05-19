<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Entities\User;
class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $allowedFields = ['email', 'password', 'nombre', 'apellido','genero','telefono','f_nacimiento','p_web','id_pais','id_provincia','id_localidad','calle','altura','Coordenadas_lat','Coordenadas_long','created_at','updated_at'];
    protected $primaryKey = 'id';
    protected $returnType = User::class;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $validationRules    = [
        'nombre'     => 'required|alpha_numeric_space|min_length[3]',
        'apellido'     => 'required|alpha_numeric_space|min_length[3]',
        'email'        => 'required|valid_email|is_unique[usuarios.email]',
        'password'     => 'required|min_length[8]',
        'genero'     => 'required',
        'telefono'     => 'required|numeric',
        'f_nacimiento' => 'required',
        'id_pais'=> 'required|is_not_unique[paises.id]',
        'id_provincia'=> 'required|is_not_unique[provincias.id]',
        'id_localidad'=> 'required|is_not_unique[localidades.id]',
        'calle' => 'required|string',
        'altura' => 'required|numeric',
        'p_web' => 'permit_empty|valid_url',
        'Coordenadas_lat' => 'required|numeric',
        'Coordenadas_long' => 'required|numeric',
        'pass_confirm' => 'required_with[password]|matches[password]'
    ];
    protected $beforeInsert = ['mayusculas'];
    protected $beforeUpdate = ['mayusculas'];

    function mayusculas(array $data){
        if(isset($data['data']['nombre'])&& ! empty($data['data']['nombre'])){
            $data['data']['nombre']  = $this->capitalize( $data['data']['nombre']);
        }
        if(isset($data['data']['apellido'])&& ! empty($data['data']['apellido'])){
            $data['data']['apellido']  = $this->capitalize( $data['data']['apellido']);
        }
        if(isset($data['data']['p_web'])&& ! empty($data['data']['p_web'])){
            $data['data']['p_web'] = strtolower($data['data']['p_web']);
        }
        if(isset($data['data']['calle'])&& ! empty($data['data']['calle'])){
            $data['data']['calle'] = strtolower($data['data']['calle']);
        }
        if(isset($data['data']['email'])&& ! empty($data['data']['email'])){
            $data['data']['email'] = strtolower($data['data']['email']);
        }
        if(isset($data['data']['genero'])&& ! empty($data['data']['genero'])){
            $data['data']['genero'] = ucfirst($data['data']['genero']);
        }
        if(isset($data['data']['password'])&& ! empty($data['data']['password'])){
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        
       
        return $data;
    }

    function capitalize($str, $encoding = 'UTF-8') {
        $str = strtolower($str); 
        $array = explode(' ', $str);
        $str = '';   
        foreach ($array as &$valor) {
           $str = $str . ' ' . ucfirst($valor);
        }
        return substr($str, 1);
    }
    protected $validationMessages = [
        'email'        => [
            'is_unique' => 'Ya existe el email',
            'required' => 'Campo obligatorio'
        ],
        'nombre'     => [
            'required' => 'Campo obligatorio'
        ],
        'apellido'     => [
            'required' => 'Campo obligatorio'
        ],
        'password'        => [
            'required' => 'Campo obligatorio'
        ],
        'genero'      => [
            'required' => 'Campo obligatorio'
        ],
        'telefono'      => [
            'required' => 'Campo obligatorio'
        ],
        'f_nacimiento' => [
            'required' => 'Campo obligatorio'
        ],
        'id_pais'      => [
            'required' => 'Campo obligatorio'
        ],
        'id_provincia'     => [
            'required' => 'Campo obligatorio'
        ],
        'id_localidad'     => [
            'required' => 'Campo obligatorio'
        ],
        'calle'     => [
            'required' => 'Campo obligatorio'
        ],
        'altura'     => [
            'required' => 'Campo obligatorio'
        ],
        'Coordenadas_lat'     => [
            'required' => 'Campo obligatorio'
        ],
        'Coordenadas_long'     => [
            'required' => 'Campo obligatorio'
        ],
        'pass_confirm'     => [
            'required' => 'Campo obligatorio',
            'matches' => 'Las contraseñas no coinciden'
        ],
    ];
}