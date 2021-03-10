<?php

require('base.php');

$nomeDaTabela = 'livros';
$nomeCrud = 'Livros';
$valorInputs = [
  [
    'campo'      => 'nome_livros', 
    'tipo'       => 'string', 
    'titulo'     => 'Nome',
    'visualizar' => true
  ], 
  [
    'campo'      => 'ano_livros', 
    'tipo'       => 'string', 
    'titulo'     => 'Ano',
    'visualizar' => true
  ]
];
$relacionamentos = [
  [
    'tabela'      => 'autores', 
    'tipo'        => 'muitosParaUm',
    'titulo'      => 'Autores',
    'visualizar'  => 'nome_autores'
  ],
  [
    'tabela'      => 'categorias', 
    'tipo'        => 'muitosParaMuitos',
    'titulo'      => 'Categorias',
    'visualizar'  => 'nome_categorias'
  ]
];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);
