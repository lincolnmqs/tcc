<?php

require('base.php');

$nomeDaTabela = 'projetos';
$nomeCrud = 'Projetos';
$valorInputs = [
  [
    'campo'      => 'protocolo_projetos', 
    'tipo'       => 'string', 
    'titulo'     => 'Protocolo',
    'visualizar' => true
  ], 
  [
    'campo'      => 'data_hora_registro_projetos', 
    'tipo'       => 'date', 
    'titulo'     => 'Data',
    'visualizar' => true
  ],
  [
    'campo'      => 'titulo_projetos', 
    'tipo'       => 'string', 
    'titulo'     => 'Título',
    'visualizar' => true
  ],
  [
    'campo'      => 'resumo_projetos', 
    'tipo'       => 'string', 
    'titulo'     => 'Resumo',
    'visualizar' => false
  ],
  [
    'campo'      => 'palavras_chave_projetos', 
    'tipo'       => 'string', 
    'titulo'     => 'Palavras-chaves',
    'visualizar' => false
  ]
];
$relacionamentos = [
  [
    'tabela'      => 'alunos', 
    'tipo'        => 'muitosParaMuitos',
    'titulo'      => 'Alunos',
    'visualizar'  => 'cpf_alunos'
  ],
  [
    'tabela'      => 'area_conhecimento', 
    'tipo'        => 'muitosParaUm',
    'titulo'      => 'Area Conhecimento',
    'visualizar'  => 'nome_area_conhecimento'
  ],
  [
    'tabela'      => 'unidades', 
    'tipo'        => 'muitosParaUm',
    'titulo'      => 'Unidade',
    'visualizar'  => 'nome_unidades'
  ]
];

new Base($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos);
