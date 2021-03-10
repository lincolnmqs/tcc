<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1) Alterar o nome da classe abaixo, referente a tabela

class Reservas extends Model {

    public $timestamps = false;

    // 2) Definir os campos da tabela

    // nome da tabela
    protected $table = 'reservas';

    // chave primária
    protected $primaryKey = 'id_reservas'; 

    // outros campos
    protected $fillable = [
        'cpf_aluno_reservas',
        'data_inicial',
        'data_final'
    ];

    // se possuir relacionamento(s), coloque dentro do vetor o nome da tabela relacionada

    protected $with = ['livros'];

    // se possuir relacionamento(s), defina as informações e descomente a variável abaixo
    
    public $relacionamentos = [
        'livros' => [
            'classe'           => Livros::class,
            'chaveEstrangeira' => 'id_reservas',
            'chaveLocal'       => 'id_livros',
            'tabelaGerada'     => 'reservas_livros',
            'tipo'             => 'muitosParaMuitos'
        ]
    ];

    // se possuir relacionamento(s) crie uma função para cada relacionamento
    // com o mesmo nome da tabela e valor inserido dentro do método 'relacionamento"
    
    public function livros(){
        return $this->relacionamento('livros');
    }

    // se possuir relacionamento(s) muitos para muitos (M-M) descomente a linha abaixo
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