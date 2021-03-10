<?php

require('base.php');

$nomeDaTabela = 'area_conhecimento';
$nomeCrud = 'Area Conhecimento';
$valorInputs = [
  [
    'campo'      => 'nome_area_conhecimento', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ]
];
$relacionamentos = [];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);