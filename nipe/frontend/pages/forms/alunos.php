<?php

require('base.php');

$nomeDaTabela = 'alunos';
$nomeCrud = 'Alunos';
$valorInputs = [
  [
    'campo'      => 'nome_alunos', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ],
  [
    'campo'      => 'cpf_alunos', 
    'tipo'       => 'string', 
    'titulo'     => 'CPF',
    'visualizar' => true
  ]
];
$relacionamentos = [];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);