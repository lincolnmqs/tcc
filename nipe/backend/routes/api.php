<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

// INÍCIO

// insira no array abaixo o nome referente a tabela

new Rotas([
    // 'nome_da_tabela', 
    'area_conhecimento',
    'unidades',
    'alunos',
    'projetos'
]);

//
//
//
//
//
//
//
//
//
//

// FIM

class Rotas {
    public function __construct($rotas){
        $this->rotas = $rotas;
        $this->count = count($this->rotas);

        Route::post('auth/login', 'App\Http\Controllers\Api\AuthController@login');

        Route::namespace('App\Http\Controllers\Api')->middleware(['apiJwt'])->group(function(){
            Route::prefix('auth')->group(function(){
                Route::post('logout', 'App\Http\Controllers\Api\AuthController@logout');
                Route::post('refresh', 'App\Http\Controllers\Api\AuthController@refresh');
                Route::post('me', 'App\Http\Controllers\Api\AuthController@me');
            });

            for($this->i=0; $this->i<$this->count; $this->i++){  
                $this->controller = $this->rotas[$this->i];
                $this->controller[0] = strtoupper($this->controller[0]);
                
                Route::prefix($this->rotas[$this->i])->group(function(){
                    Route::get('/', $this->controller.'Controller@index');
                    Route::get('/{id_'.$this->rotas[$this->i].'}', $this->controller.'Controller@show');

                    Route::post('/', $this->controller.'Controller@store');

                    Route::put('/{id_'.$this->rotas[$this->i].'}', $this->controller.'Controller@update');

                    Route::delete('/{id_'.$this->rotas[$this->i].'}', $this->controller.'Controller@delete');
                });
            }

        });
	}
}