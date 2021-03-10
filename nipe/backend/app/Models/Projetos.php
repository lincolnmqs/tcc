<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1) Alterar o nome da classe abaixo, referente a tabela.

class Projetos extends Model {

    public $timestamps = false;

    // 2) Definir os campos da tabela

    // nome da tabela
    protected $table = 'projetos';

    // chave primária
    protected $primaryKey = 'id_projetos'; // chave primária

    // outros campos
    protected $fillable = [
          'protocolo_projetos', 
          'data_hora_registro_projetos',
          'titulo_projetos',
          'resumo_projetos',
          'palavras_chave_projetos',
          'id_area_conhecimento',
          'id_unidades'
    ];

    // relacionamentos ['nome_da_tabela_1', 'nome_da_tabela_2']
    protected $with = ['alunos', 'area_conhecimento', 'unidades'];

    public $relacionamentos = [
        'alunos' => [
            'classe'           => Alunos::class,
            'chaveEstrangeira' => 'id_projetos',
            'chaveLocal'       => 'id_alunos',
            'tabelaGerada'     => 'projetos_alunos',
            'tipo'             => 'muitosParaMuitos'
        ],
       'unidades' => [
            'classe'           => Unidades::class,
            'chaveEstrangeira' => 'id_unidades',
            'chaveLocal'       => 'id_unidades',
            'tabelaGerada'     => '',
            'tipo'             => 'muitosParaUm'
        ],
        'area_conhecimento' => [
             'classe'           => Area_Conhecimento::class,
             'chaveEstrangeira' => 'id_area_conhecimento',
             'chaveLocal'       => 'id_area_conhecimento',
             'tabelaGerada'     => '',
             'tipo'             => 'muitosParaUm'
         ]
    ];

    // função para cada relacionamento

    public function alunos(){
        return $this->relacionamento('alunos');
    }

    public function unidades(){
        return $this->relacionamento('unidades');
    }

    public function area_conhecimento(){
        return $this->relacionamento('area_conhecimento');
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
