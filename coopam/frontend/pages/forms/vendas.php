<?php

require('base.php');

$nomeDaTabela = 'vendas';
$nomeCrud = 'Vendas';
$valorInputs = [
  [
    'campo'      => 'preco_total_vendas', 
    'tipo'       => 'string', 
    'titulo'     => 'Preco Total',
    'visualizar' => true
  ], 
  [
    'campo'      => 'cpf_aluno_vendas', 
    'tipo'       => 'string', 
    'titulo'     => 'CPF Aluno',
    'visualizar' => true
  ],
  [
    'campo'      => 'data_venda', 
    'tipo'       => 'date', 
    'titulo'     => 'Data da Venda',
    'visualizar' => true
  ]
];
$relacionamentos = [
  [
    'tabela'      => 'produtos', 
    'tipo'        => 'muitosParaMuitos',
    'titulo'      => 'Produtos',
    'visualizar'  => 'nome_produtos'
  ],
  [
    'tabela'      => 'pagamentos', 
    'tipo'        => 'muitosParaUm',
    'titulo'      => 'Pagamentos',
    'visualizar'  => 'tipo_pagamentos'
  ]
];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);
