<?php

require('base.php');

$nomeDaTabela = 'autores';
$nomeCrud = 'Autores';
$valorInputs = [
  [
    'campo'      => 'nome_autores', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ]
];
$relacionamentos = [];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);