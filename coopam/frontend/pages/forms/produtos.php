<?php

require('base.php');

$nomeDaTabela = 'produtos';
$nomeCrud = 'Produtos';
$valorInputs = [
  [
    'campo'      => 'nome_produtos', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ], 
  [
    'campo'      => 'preco_produtos', 
    'tipo'       => 'number', 
    'titulo'     => 'Preço',
    'visualizar' => true
  ]
];
$relacionamentos = [
  [
    'tabela'      => 'tipo_produtos', 
    'tipo'        => 'muitosParaUm',
    'titulo'      => 'Tipo Produtos',
    'visualizar'  => 'nome_tipo_produtos'
  ]
];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);
