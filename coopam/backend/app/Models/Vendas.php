<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1) Alterar o nome da classe abaixo, referente a tabela.

class Vendas extends Model {

    public $timestamps = false;

    // 2) Definir os campos da tabela

    // nome da tabela
    protected $table = 'vendas';

    // chave primária
    protected $primaryKey = 'id_vendas'; // chave primária

    // outros campos
    protected $fillable = [
          'preco_total_vendas', 
          'cpf_aluno_vendas',
          'data_venda',
          'id_pagamentos'
    ];

    // relacionamentos ['nome_da_tabela_1', 'nome_da_tabela_2']
    protected $with = ['pagamentos', 'produtos'];

    public $relacionamentos = [
        'produtos' => [
            'classe'           => Produtos::class,
            'chaveEstrangeira' => 'id_vendas',
            'chaveLocal'       => 'id_produtos',
            'tabelaGerada'     => 'vendas_produtos',
            'tipo'             => 'muitosParaMuitos'
        ],
       'pagamentos' => [
            'classe'           => Pagamentos::class,
            'chaveEstrangeira' => 'id_pagamentos',
            'chaveLocal'       => 'id_pagamentos',
            'tabelaGerada'     => '',
            'tipo'             => 'muitosParaUm'
        ]
    ];

    // função para cada relacionamento

    public function pagamentos(){
        return $this->relacionamento('pagamentos');
    }

    public function produtos(){
        return $this->relacionamento('produtos');
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
