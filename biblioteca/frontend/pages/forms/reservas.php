<?php

require('base.php');

$nomeDaTabela = 'reservas';
$nomeCrud = 'Reservas';
$valorInputs = [
  [
    'campo'      => 'cpf_aluno_reservas', 
    'tipo'       => 'string', 
    'titulo'     => 'CPF Aluno',
    'visualizar' => true
  ],
  [
    'campo'      => 'data_inicial', 
    'tipo'       => 'date', 
    'titulo'     => 'Data Inicial',
    'visualizar' => true
  ],
  [
    'campo'      => 'data_final', 
    'tipo'       => 'date', 
    'titulo'     => 'Data Final',
    'visualizar' => true
  ]
];
$relacionamentos = [
  [
    'tabela'      => 'livros', 
    'tipo'        => 'muitosParaMuitos',
    'titulo'      => 'Livros',
    'visualizar'  => 'nome_livros'
  ]
];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);