<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1) Alterar o nome da classe abaixo, referente a tabela.

class Livros extends Model {

    public $timestamps = false;

    // 2) Definir os campos da tabela

    // nome da tabela
    protected $table = 'livros';

    // chave primária
    protected $primaryKey = 'id_livros'; // chave primária

    // outros campos
    protected $fillable = [
          'nome_livros', 
          'ano_livros',
          'id_autores'
    ];

    // relacionamentos ['nome_da_tabela_1', 'nome_da_tabela_2']
    protected $with = ['categorias', 'autores'];

    public $relacionamentos = [
        'categorias' => [
            'classe'           => Categorias::class,
            'chaveEstrangeira' => 'id_livros',
            'chaveLocal'       => 'id_categorias',
            'tabelaGerada'     => 'categorias_livros',
            'tipo'             => 'muitosParaMuitos'
        ],
       'autores' => [
            'classe'           => Autores::class,
            'chaveEstrangeira' => 'id_autores',
            'chaveLocal'       => 'id_autores',
            'tabelaGerada'     => '',
            'tipo'             => 'muitosParaUm'
        ]
    ];
    
    // função para cada relacionamento

    public function categorias(){
        return $this->relacionamento('categorias');
    }

    public function autores(){
        return $this->relacionamento('autores');
    }

    // se possuir relacionamentos muitos para muitos
    protected $hidden = ['pivot'];

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

    public function relacionamento($tabela){
        if($this->relacionamentos[$tabela]['tipo'] == 'umParaUm') // (1-1)
            return $this->hasOne($this->relacionamentos[$tabela]['classe']);

        else if($this->relacionamentos[$tabela]['tipo'] == 'muitosParaUm') // (M-1, 1-1)
            return $this->belongsTo($this->relacionamentos[$tabela]['classe'], $this->relacionamentos[$tabela]['chaveEstrangeira'], $this->relacionamentos[$tabela]['chaveLocal']);

        if($this->relacionamentos[$tabela]['tipo'] == 'umParaMuitos') // (1-M)
            return $this->hasMany($this->relacionamentos[$tabela]['classe'], $this->relacionamentos[$tabela]['chaveEstrangeira']);

        else if($this->relacionamentos[$tabela]['tipo'] == 'muitosParaMuitos') // (M-M)
            return $this->belongsToMany($this->relacionamentos[$tabela]['classe'], $this->relacionamentos[$tabela]['tabelaGerada'], $this->relacionamentos[$tabela]['chaveEstrangeira'], $this->relacionamentos[$tabela]['chaveLocal']);
    }

}
