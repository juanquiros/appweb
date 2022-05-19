<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Country;
class CountryModel extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id';
    protected $returnType = Country::class;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
/*
    protected $validationRules    = [
        'username'     => 'required|alpha_numeric_space|min_length[3]',
        'email'        => 'required|valid_email|is_unique[users.email]',
        'password'     => 'required|min_length[8]',
        'pass_confirm' => 'required_with[password]|matches[password]',
    ];

    protected $validationMessages = [
        'email'        => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
    ]*/

}