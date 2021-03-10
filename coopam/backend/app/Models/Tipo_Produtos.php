<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1) Alterar o nome da classe abaixo, referente a tabela

class Tipo_Produtos extends Model {

    public $timestamps = false;

    // 2) Definir os campos da tabela

    // nome da tabela
    protected $table = 'tipo_produtos';

    // chave primária
    protected $primaryKey = 'id_tipo_produtos'; 

    // outros campos
    protected $fillable = [
        'nome_tipo_produtos'
    ];

    // se possuir relacionamento(s), coloque dentro do vetor o nome da tabela relacionada

    //protected $with = ['nome_tabela_relacionada_1', 'nome_tabela_relacionada_2'];

    // se possuir relacionamento(s), defina as informações e descomente a variável abaixo
    
    /*
    public $relacionamentos = [
        'nome_tabela_relacionada_1' => [
            'classe'           => Classe_Tabela_Relacionada_1::class,
            'chaveEstrangeira' => 'id_tabela_relacionada_1',
            'chaveLocal'       => 'id_tabela_relacionada_1',
            'tabelaGerada'     => 'nome_tabela_gerada_muitosParaMuitos',
            'tipo'             => 'muitosParaMuitos' // (M-M)
        ],
       'nome_tabela_relacionada_2' => [
            'classe'           => Classe_Tabela_Relacionada_2::class,
            'chaveEstrangeira' => 'id_tabela_relacionada_2',
            'chaveLocal'       => 'id_tabela_relacionada_2',
            'tabelaGerada'     => '',
            'tipo'             => 'muitosParaUm' // (M-M)
        ]
    ];*/

    // se possuir relacionamento(s) muitos para muitos (M-M) descomente a linha abaixo
    //protected $hidden = ['pivot'];

    // se possuir relacionamento(s) crie uma função para cada relacionamento
    // com o mesmo nome da tabela e valor inserido dentro do método 'relacionamento"
    /*
    public function nome_tabela_relacionada(){
        return $this->relacionamento('nome_tabela_relacionada');
    }*/

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