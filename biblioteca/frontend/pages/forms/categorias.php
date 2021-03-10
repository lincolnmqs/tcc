<?php

require('base.php');

$nomeDaTabela = 'categorias';
$nomeCrud = 'Categorias';
$valorInputs = [
  [
    'campo'      => 'nome_categorias', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ]
];
$relacionamentos = [];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);