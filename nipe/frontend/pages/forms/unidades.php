<?php

require('base.php');

$nomeDaTabela = 'unidades';
$nomeCrud = 'Unidades';
$valorInputs = [
  [
    'campo'      => 'nome_unidades', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ]
];
$relacionamentos = [];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);