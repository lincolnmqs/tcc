<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1) Alterar o nome da classe abaixo, referente a tabela.

class Produtos extends Model {

    public $timestamps = false;

    // 2) Definir os campos da tabela

    // nome da tabela
    protected $table = 'produtos';

    // chave primária
    protected $primaryKey = 'id_produtos'; // chave primária

    // outros campos
    protected $fillable = [
          'nome_produtos', 
          'preco_produtos',
          'id_tipo_produtos'
    ];

    // relacionamentos ['nome_da_tabela_1', 'nome_da_tabela_2']
    protected $with = ['tipo_produtos'];

    public $relacionamentos = [
       'tipo_produtos' => [
            'classe'           => Tipo_Produtos::class,
            'chaveEstrangeira' => 'id_tipo_produtos',
            'chaveLocal'       => 'id_tipo_produtos',
            'tabelaGerada'     => '',
            'tipo'             => 'muitosParaUm'
        ]
    ];

    // função para cada relacionamento

    public function tipo_produtos(){
        return $this->relacionamento('tipo_produtos');
    }
    
    // se possuir relacionamentos muitos para muitos
    //protected $hidden = ['pivot'];

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
