<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject {

    use Notifiable;

    // nome da tabela
    protected $table = 'pessoas';

    // chave primária
    protected $primaryKey = 'id_pessoas'; // chave primária

    // outros campos
    protected $fillable = [
          'cpf_pessoas', 
          'senha_pessoas'
    ];

    // esconder campos
    protected $hidden = [
        'senha_pessoas'
    ];

    // nome do campo da senha do usuário igual da tabela
    public function getAuthPassword(){
        return $this->senha_pessoas; 
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

}