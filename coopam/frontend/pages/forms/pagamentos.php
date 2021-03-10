<?php

require('base.php');

$nomeDaTabela = 'pagamentos';
$nomeCrud = 'Pagamentos';
$valorInputs = [
  [
    'campo'      => 'tipo_pagamentos', 
    'tipo'       => 'string', 
    'titulo'     => 'Tipo Pagamentos',
    'visualizar' => true
  ]
];
$relacionamentos = [];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);