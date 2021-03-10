<?php
  class Base {

    public function __construct($nomeDaTabela, $nomeCrud, $valorInputs, $relacionamentos){
    
    $urlApi = "http://localhost:8001/api/";
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $nomeCrud; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <style>
    .btn-opcoes-edicao {
      margin-right: 5%;
    }
    .fa-wrench {
      color: orange;
    }
    .fa-trash-alt {
      color: red;
    }
    .table {
      text-align: center;
    }
    .btn-modal {
      float: right;
    }
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('http://i.imgur.com/zAD2y29.gif') 50% 50% no-repeat white;
    }
    .sessao {
      font-size: 14px;
      color: #c6c19b;
    }
  </style>
</head>
<div id="loader" class="loader"></div>
<div style="display:none" id="tudo_page">
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  <!-- Slidebar -->
  <?php 
    $url = $urlApi . $nomeDaTabela;

    include('slidebar.html');

    if($nomeCrud[strlen($nomeCrud) - 1] == 's' || $nomeCrud[strlen($nomeCrud) - 1] == 'S')
      $nameCrud = substr($nomeCrud, 0, -1);

    else if($nomeDaTabela[strlen($nomeDaTabela) - 1] == 's' || $nomeDaTabela[strlen($nomeDaTabela) - 1] == 'S')
      $nameCrud = substr($nomeDaTabela, 0, -1);
      
    else
      $nameCrud = $nomeCrud;
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $nomeCrud; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Início</a></li>
              <li class="breadcrumb-item active"><?php echo $nomeCrud; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            

            <!-- Modal -->
            <div class="modal fade" id="<?php echo "modal-" . $nomeDaTabela; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $nameCrud; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <?php 

                    $count = count($valorInputs);

                    for($i=0; $i<$count; $i++){                       
                      if($valorInputs[$i]['tipo'] == 'password'){
                      ?> 
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['campo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="password" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>" placeholder="<?php echo $valorInputs[$i]['titulo']; ?>">
                        </div>
                        
                      <?php   
                      } else if($valorInputs[$i]['tipo'] == 'string'){
                      ?> 
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['campo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="text" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>" placeholder="<?php echo $valorInputs[$i]['titulo']; ?>">
                        </div>
                        <?php   
                      } else if($valorInputs[$i]['tipo'] == 'number'){
                      ?> 
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['campo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="number" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>" placeholder="<?php echo $valorInputs[$i]['titulo']; ?>">
                        </div>
                          
                      <?php   
                      } else if($valorInputs[$i]['tipo'] == 'date'){
                      ?>  
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['titulo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="date" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>">
                        </div>
                        
                      <?php   
                      }
                    }

                    $count = count($relacionamentos);

                    if($count){
                      for($i=0; $i<$count; $i++){                       
                        if($relacionamentos[$i]['tipo'] == 'muitosParaUm'){
                        ?> 

                          <div class="form-group">
                            <label for="<?php echo $relacionamentos[$i]['tabela']; ?>"><?php echo $relacionamentos[$i]['titulo']; ?></label>
                            <select class="form-control" id="<?php echo $relacionamentos[$i]['tabela'] . '-input-select'; ?>"></select>
                          </div>

                      <?php 
                        }
                        else if($relacionamentos[$i]['tipo'] == 'muitosParaMuitos'){
                      ?> 

                        <label for="<?php echo $relacionamentos[$i]['tabela']; ?>"><?php echo $relacionamentos[$i]['titulo']; ?></label>
                        <div id="<?php echo $relacionamentos[$i]['tabela'] . '-form-checkbox'; ?>"></div>

                    <?php 
                        }
                      }
                    }
                  ?>
                  </div>
                  <div class="modal-footer">
                  <div onclick="postAPI()" class="btn btn-primary">Gravar</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Edição -->
            <div class="modal fade" id="<?php echo "modal-edicao-" . $nomeDaTabela; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo 'Edição ' . $nameCrud; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <input type="hidden" id="<?php echo 'id_' . $nomeDaTabela . '-input-edicao'; ?>" name="<?php echo 'id_' . $nomeDaTabela; ?>">

                  <?php 

                    $count = count($valorInputs);

                    for($i=0; $i<$count; $i++){                       
                      if($valorInputs[$i]['tipo'] == 'password'){
                      ?> 
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['campo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="password" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input-edicao'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>" placeholder="<?php echo $valorInputs[$i]['titulo']; ?>">
                        </div>
                        
                      <?php   
                      } else if($valorInputs[$i]['tipo'] == 'string'){
                      ?> 
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['campo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="text" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input-edicao'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>" placeholder="<?php echo $valorInputs[$i]['titulo']; ?>">
                        </div>
                        <?php   
                      } else if($valorInputs[$i]['tipo'] == 'number'){
                      ?> 
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['campo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="number" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input-edicao'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>" placeholder="<?php echo $valorInputs[$i]['titulo']; ?>">
                        </div>
                          
                      <?php   
                      } else if($valorInputs[$i]['tipo'] == 'date'){
                      ?>  
                        
                        <div class="form-group">
                          <label for="<?php echo $valorInputs[$i]['titulo']; ?>"><?php echo $valorInputs[$i]['titulo']; ?></label>
                          <input type="date" class="form-control" id="<?php echo $valorInputs[$i]['campo'] . '-input-edicao'; ?>" name="<?php echo $valorInputs[$i]['campo']; ?>">
                        </div>
                        
                      <?php   
                      }
                    }
                    $count = count($relacionamentos);

                    if($count){
                      for($i=0; $i<$count; $i++){                       
                        if($relacionamentos[$i]['tipo'] == 'muitosParaUm'){
                        ?> 

                          <div class="form-group">
                            <label for="<?php echo $relacionamentos[$i]['tabela']; ?>"><?php echo $relacionamentos[$i]['titulo']; ?></label>
                            <select class="form-control" id="<?php echo $relacionamentos[$i]['tabela'] . '-input-edicao-select'; ?>"></select>
                          </div>

                      <?php 
                        }
                        else if($relacionamentos[$i]['tipo'] == 'muitosParaMuitos'){
                      ?> 

                          <label for="<?php echo $relacionamentos[$i]['tabela']; ?>"><?php echo $relacionamentos[$i]['titulo']; ?></label>
                          <div id="<?php echo $relacionamentos[$i]['tabela'] . '-form-edicao-checkbox'; ?>"></div>

                    <?php 
                        }
                      }
                    }
                  ?>
                  </div>
                  <div class="modal-footer">
                  <div onclick="updateAPI()" class="btn btn-primary">Salvar</div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de <?php echo $nomeCrud; ?></h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-modal" data-toggle="modal" data-target="<?php echo "#modal-" . $nomeDaTabela; ?>">
                  <?php echo "Cadastrar " . $nameCrud; ?>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="<?php echo "table-" . $nomeDaTabela; ?>" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <?php
                        $count = count($valorInputs);

                        for($i=0; $i<$count; $i++){ 
                          if($valorInputs[$i]['visualizar']){
                        ?>
                        <th><?php echo $valorInputs[$i]['titulo']; ?></th>
                        <?php
                            }
                        }
                        $count = count($relacionamentos);

                        if($count){
                          for($i=0; $i<$count; $i++){ 
                          ?>
                            <th><?php echo $relacionamentos[$i]['titulo']; ?></th>
                          <?php
                          }
                        }
                    ?>
                      <th>Opções</th>
                    </tr>
                  </thead>
                  <tbody id="<?php echo "tbody-" . $nomeDaTabela; ?>"></tbody>
                  <tfoot>
                    <tr>
                      <?php
                        $count = count($valorInputs);

                        for($i=0; $i<$count; $i++){ 
                          if($valorInputs[$i]['visualizar']){
                        ?>
                          <th><?php echo $valorInputs[$i]['titulo']; ?></th>
                        <?php
                          }
                        }
                        $count = count($relacionamentos);

                        if($count){
                          for($i=0; $i<$count; $i++){ 
                          ?>
                            <th><?php echo $relacionamentos[$i]['titulo']; ?></th>
                          <?php
                          }
                        }
                    ?>
                      <th>Opções</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Versão</b> 1.0
    </div>
    <strong>&copy; 2020 CAMPUS MUZAMBINHO.</strong> Todos os direitos reservados.</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<div>

<script>
  const data = window.localStorage.getItem('expires_in');
  document.querySelector('#timeSession').innerHTML = 'Sessão expira em: ' + new Date(data).toLocaleString();
  document.querySelector('#usuarioLogado').innerHTML = 'Logado: ' + window.localStorage.getItem('user_cpf');

  const token = window.localStorage.getItem('access_token');
  const apiURL = "<?php echo $url; ?>";
  const apiURLAll = "<?php echo $urlApi; ?>";
  const nomeTabela = "<?php echo $nomeDaTabela; ?>";
  const id_tbody = "<?php echo "#tbody-" . $nomeDaTabela; ?>";
  const tbody = document.querySelector(id_tbody);
  const valorGet = getAPI();

  let optControle = [];
  let checkControle = [];
  let optControleEdit = [];
  let checkControleEdit = [];

  let dataValue = {};
  let dataValueEdit = {};

  valorGet.then(async resultado => {
    //console.log(resultado);
    let values = [];

    <?php

      $countAux = count($relacionamentos);

      if($countAux){
        for($j=0; $j<$countAux; $j++){ 

          ?>

            var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
            var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";
          
            var val = await get_api_all(tabela);

            values[tabela] = [ ...val ];

          <?php
            if($relacionamentos[$j]['tipo'] == 'muitosParaUm'){
          ?>

              var input = "<?php echo $relacionamentos[$j]['tabela'] . '-input-select'; ?>";
              var select = document.querySelector(`#${input}`);

              for(let j = 0; j < values[tabela].length; j++){
                let opt = document.createElement("option");
                opt.value = values[tabela][j][`id_${tabela}`];
                opt.text = values[tabela][j][campo];

                if(optControle[values[tabela][j][campo]]) continue;

                select.add(opt, select.options[j]);
                optControle[values[tabela][j][campo]] = true;
              }
            
          <?php
            }
            else if($relacionamentos[$j]['tipo'] == 'muitosParaMuitos'){
          ?>

              var formCheck = "<?php echo $relacionamentos[$j]['tabela'] . '-form-checkbox'; ?>";
              let formCheckbox = document.querySelector(`#${formCheck}`);

              for(let j = 0; j < values[tabela].length; j++){
                let div = document.createElement('div');
                div.className = 'form-check form-check-inline';

                let input = document.createElement('input');
                input.className = 'form-input-check';
                input.type = 'checkbox';
                input.id = tabela;
                input.value = values[tabela][j][`id_${tabela}`];

                let label = document.createElement('label');
                label.className = 'form-check-label';
                label.for = tabela;
                label.innerText = values[tabela][j][campo];

                if(checkControle[values[tabela][j][campo]]) continue;

                checkControle[values[tabela][j][campo]] = true;       

                div.appendChild(input);
                div.appendChild(label);
                
                formCheckbox.appendChild(div);               
              }

          <?php
            }
        }
      }

    ?>

    //console.log(values);

    if(resultado.status && (resultado.status == 'O token está expirado' || resultado.status == 'Token é inválido' || resultado.status == 'Token de autorização não encontrado'))
      autenticacaoInvalida();

    resultado.forEach(async value => {
      //console.log(value);

      dataValue = value;

      const tr = document.createElement('tr');
      let tds = '';

      <?php
        $countAux = count($valorInputs);

        for($j=0; $j<$countAux; $j++){ 
          if($valorInputs[$j]['visualizar']){
        ?>

            var campo = "<?php echo $valorInputs[$j]['campo']; ?>";

            tds += `<td>${value[campo]}</td>`; 
         
        <?php
          }
        }

        $countAux = count($relacionamentos);

        if($countAux){
          for($j=0; $j<$countAux; $j++){ 
            if($relacionamentos[$j]['tipo'] == 'muitosParaUm'){
          ?>
              var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
              var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

              tds += `<td>${value[tabela][campo]}</td>`;
            
          <?php
            }
            else if($relacionamentos[$j]['tipo'] == 'muitosParaMuitos'){
          ?>
              var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
              var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

              let concatena = '';
              const tam = value[tabela].length;

              for(let i = 0; i < tam; i++){
                concatena += value[tabela][i][campo];

                if((tam > 1) && (i < tam - 1)) concatena += ', ';
              }

              tds += `<td>${concatena}</td>`;
            
          <?php
            }
          }
        }

        $countAux = count($valorInputs);
        
        ?>

        tr.innerHTML += tds;

        const tdOpcoes = document.createElement('td');
        const divOpcoes = document.createElement('div');
        const botaoEditar = document.createElement('i');
        const botaoExcluir = document.createElement('i');

        botaoEditar.className = 'fas fa-wrench btn-opcoes-edicao';
        botaoEditar.title = "<?php echo "Alterar " . $nameCrud; ?>";
        botaoEditar.setAttribute('data-toggle', 'modal');
        botaoEditar.setAttribute('data-target', "<?php echo "#modal-edicao-" . $nomeDaTabela; ?>");

        botaoExcluir.className = 'fas fa-trash-alt btn-opcoes-delete';
        botaoExcluir.title = "<?php echo "Deletar " . $nameCrud; ?>";

        divOpcoes.appendChild(botaoEditar);
        divOpcoes.appendChild(botaoExcluir);
      
        botaoEditar.onclick = async () => {
          dataValueEdit = value;

          const nomeInputId = "<?php echo 'id_' . $nomeDaTabela; ?>";
          document.querySelector(`#${nomeInputId}-input-edicao`).value = value[nomeInputId];

          <?php
            for($i=0; $i<$countAux; $i++){ 
          ?>
              var nomeInput = "<?php echo $valorInputs[$i]['campo']; ?>";
              document.querySelector(`#${nomeInput}-input-edicao`).value = value[nomeInput];
          <?php  
            }

            $countAux = count($relacionamentos);

            if($countAux){
              for($j=0; $j<$countAux; $j++){ 
                if($relacionamentos[$j]['tipo'] == 'muitosParaUm'){
              ?>
                  var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
                  var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

                  var input = "<?php echo $relacionamentos[$j]['tabela'] . '-input-edicao-select'; ?>";
                  var select = document.querySelector(`#${input}`);

                  for(let j = 0; j < values[tabela].length; j++){
                    let opt = document.createElement("option");
                    opt.value = values[tabela][j][`id_${tabela}`];
                    opt.text = values[tabela][j][campo];

                    if(!optControleEdit[values[tabela][j][campo]]){
                      select.add(opt, select.options[j]);
                      optControleEdit[values[tabela][j][campo]] = true;
                    }

                    [].forEach.call(select.children, function(el) {
                      if(value[tabela][`id_${tabela}`] == el.value){
                        el.selected = true;
                      }
                    });
                  }
                
              <?php
                }
                else if($relacionamentos[$j]['tipo'] == 'muitosParaMuitos'){
              ?>
                  var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
                  var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

                  var formCheck = "<?php echo $relacionamentos[$j]['tabela'] . '-form-edicao-checkbox'; ?>";
                  let formCheckbox = document.querySelector(`#${formCheck}`);

                  for(let j = 0; j < values[tabela].length; j++){
                    let div = document.createElement('div');
                    div.className = 'form-check form-check-inline';

                    let input = document.createElement('input');
                    input.className = 'form-input-check';
                    input.type = 'checkbox';
                    input.id = tabela;
                    input.value = values[tabela][j][`id_${tabela}`];

                    let label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.for = tabela;
                    label.innerText = values[tabela][j][campo];

                    if(checkControleEdit[values[tabela][j][campo]]) continue;

                    checkControleEdit[values[tabela][j][campo]] = true;       

                    div.appendChild(input);
                    div.appendChild(label);
                    
                    formCheckbox.appendChild(div);               
                  }

                  [].forEach.call(formCheckbox.children, function(el) {
                    el.children[0].checked = false;

                    for(let i = 0; i < value[tabela].length; i++){
                      if(value[tabela][i][`id_${tabela}`] == el.children[0].value){
                        el.children[0].checked = true;
                      }
                    }
                  });
                
              <?php
                }
              }
            }
          ?>
        }

        botaoExcluir.onclick = async () => {
          let valuesDelete = {};

          <?php  

          $countAux = count($relacionamentos);

          if($countAux){
            for($j=0; $j<$countAux; $j++){ 
              if($relacionamentos[$j]['tipo'] == 'muitosParaMuitos'){
                ?>

                  var tabelaRel = "<?php echo $relacionamentos[$j]['tabela']; ?>";
                  var campoRel  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

                  let remover = [];                 

                  for(let i = 0; i < value[tabelaRel].length; i++){
                    remover.push(value[tabelaRel][i][`id_${tabelaRel}`]);
                  }

                  valuesDelete[`ids_${tabelaRel}`] = { 'adicionar': [], 'remover': remover };

                  //console.log(valuesDelete);

                <?php
              }
            }
          } 
          ?>

          if(confirm('Deseja realmente deletar o elemento?')){
            try {
              if(valuesDelete) await delete_api(value[`id_${nomeTabela}`], valuesDelete);
              else await delete_api(value[`id_${nomeTabela}`]);
          
              alert('Valor excluído!');

              document.location.reload(true);
            } catch (error) {
              console.log(error);
            }
          }
        }

        tdOpcoes.appendChild(divOpcoes);
        tr.appendChild(tdOpcoes);
        tbody.appendChild(tr);
    });
  });

  function autenticacaoInvalida(){
    window.localStorage.setItem('access_token', '');
    window.localStorage.setItem('user_cpf', '');
    window.location.href = 'login.html';
  }

  async function getAPI(){
    try {
      const chamada = await get_api();

      return chamada;
    } catch (error) {
      console.log(error);
    }
  }

  async function postAPI(){
    let valuesCreate = {};
    
    <?php
      $count = count($valorInputs);

        for($i=0; $i<$count; $i++){ 
  ?>
          var nomeInput = "<?php echo $valorInputs[$i]['campo']; ?>";
          var dadosInput = document.querySelector(`#${nomeInput}-input`).value;
  
          if(!dadosInput){
            alert('Campo <?php echo $valorInputs[$i]['campo']; ?> vazio!');
            return;
          }
          
          valuesCreate[nomeInput] = dadosInput;
          
    <?php 
        }

        $countAux = count($relacionamentos);

        if($countAux){
          for($j=0; $j<$countAux; $j++){ 
            if($relacionamentos[$j]['tipo'] == 'muitosParaUm'){
          ?>
              var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
              var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

              var input = "<?php echo $relacionamentos[$j]['tabela'] . '-input-select'; ?>";
              var select = document.querySelectorAll(`#${input}`);

              for(let i = 0; i < select.length; i++){
                if(select[i].value){
                  valuesCreate[`id_${tabela}`] = select[i].value;
                }
              }

          <?php
            }
            else if($relacionamentos[$j]['tipo'] == 'muitosParaMuitos'){
          ?>
              var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
              var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

              let checkboxs = document.querySelectorAll('.form-input-check');

              let adicionar = [];

              for(let i = 0; i < checkboxs.length; i++){
                if(checkboxs[i].checked){
                  adicionar.push(checkboxs[i].value);
                } 
              }

              valuesCreate[`ids_${tabela}`] = { 'adicionar': adicionar, 'remover': [] };
            
          <?php
            }
          }
        }
    ?>     
    
      //console.log(valuesCreate);
    
      try {
        const valor = await create_api(valuesCreate);
    
        alert('Valor criado!');

        document.location.reload(true);
      } catch (error) {
        console.log(error);
      }
  }

  async function updateAPI(){
    let valuesUpdate = {};

    const nomeInputId = "<?php echo 'id_' . $nomeDaTabela; ?>";
    valuesUpdate[nomeInputId] = Number(document.querySelector(`#${nomeInputId}-input-edicao`).value);
    
    <?php
      $count = count($valorInputs);

      $num = false;

      for($i=0; $i<$count; $i++){ 
        if($valorInputs[$i]['tipo'] == 'number')
          $num = true;
    ?>
        var num = "<?php echo $num; ?>";
        var nomeInput = "<?php echo $valorInputs[$i]['campo']; ?>";
        valuesUpdate[nomeInput] = document.querySelector(`#${nomeInput}-input-edicao`).value;

        if(num)
          valuesUpdate[nomeInput] = Number(valuesUpdate[nomeInput]);

        if(!valuesUpdate[nomeInput]){
          alert('Campo <?php echo $valorInputs[$i]['campo']; ?> vazio!');
          return;
        }
    <?php        
      }
      $countAux = count($relacionamentos);

      if($countAux){
        for($j=0; $j<$countAux; $j++){ 
          if($relacionamentos[$j]['tipo'] == 'muitosParaUm'){
        ?>
            var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
            var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

            var input = "<?php echo $relacionamentos[$j]['tabela'] . '-input-edicao-select'; ?>";
            var select = document.querySelector(`#${input}`);

            [].forEach.call(select.children, function(el) {
              if(el.selected)
                valuesUpdate[`id_${tabela}`] = Number(el.value);
            });
            
        <?php 
        } else if($relacionamentos[$j]['tipo'] == 'muitosParaMuitos'){
          ?>
            var tabela = "<?php echo $relacionamentos[$j]['tabela']; ?>";
            var campo  = "<?php echo $relacionamentos[$j]['visualizar']; ?>";

            var formCheck = "<?php echo $relacionamentos[$j]['tabela'] . '-form-edicao-checkbox'; ?>";
            let formCheckbox = document.querySelector(`#${formCheck}`);

            let checkboxs = {
              'adicionar': [],
              'remover': []
            };

            [].forEach.call(formCheckbox.children, function(el) {
              let ok = true;
              
              if(el.children[0].checked){
                for(let i = 0; i < dataValueEdit[tabela].length; i++){
                  if(dataValueEdit[tabela][i][`id_${tabela}`] == el.children[0].value)
                    ok = false;
                }
              } else {
                ok = false;
                checkboxs['remover'].push(Number(el.children[0].value));
              }

              if(ok){
                checkboxs['adicionar'].push(Number(el.children[0].value));
              }
            });

            valuesUpdate[`ids_${tabela}`] = {...checkboxs};
          
        <?php
          }
        }
      }
    ?>   

    //console.log(dataValueEdit);
    //console.log(valuesUpdate);  
    
    try {

      const valor = await update_api(valuesUpdate[nomeInputId], valuesUpdate);
  
      alert('Valor alterado!');

      document.location.reload(true);
    } catch (error) {
      console.log(error);
    }
  }

  function chamadaLogout(){
    if(confirm('Tem certeza que deseja deslogar-se?')){
      autenticacaoInvalida();
    }
  }

  function get_api(id) {
    return new Promise(async (next, reject) => {
      try {
        const chamada = await fetch(`${apiURL}/${id ? `/${id}` : ''}`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });
        const dados = await chamada.json();
    
        next(dados);
      } catch(error) {
        console.log(error);
      }
    });
  }

  function get_api_all(tabela, id) {
    return new Promise(async (next, reject) => {
      try {
        const chamada = await fetch(`${apiURLAll}${tabela}/${id ? `/${id}` : ''}`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });
        const dados = await chamada.json();
    
        next(dados);
      } catch(error) {
        console.log(error);
      }
    });
  }
  
  function create_api(dadosParaCadastro){
    return new Promise(async (next, reject) => {
      const body = JSON.stringify(dadosParaCadastro);

      try {
        const chamada = await fetch(apiURL, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
          },
          body
        });

        const dados = await chamada.json();

        next(dados);
      } catch(error) {
        console.log(error);
      }
    });
  }

  function update_api(id, dadosParaEdicao){
    return new Promise(async (next, reject) => {
      
      const body = JSON.stringify(dadosParaEdicao);

      try {
        const chamada = await fetch(`${apiURL}/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
          },
          body
        });

        const dados = await chamada.json();

        next(dados);
      } catch(error) {
        console.log(error);
      }
    });
  }
  
  function delete_api(id, dadosParaExclusao){
    return new Promise(async (next, reject) => {

      try {
        if(dadosParaExclusao){
          const body = JSON.stringify(dadosParaExclusao);

          const chamada = await fetch(`${apiURL}/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'Authorization': `Bearer ${token}`
            },
            body
          });

          const dados = await chamada.json();
        } else {
          const chamada = await fetch(`${apiURL}/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'Authorization': `Bearer ${token}`
            }
          });

          const dados = await chamada.json();
        }

        next();
      } catch(error) {
        console.log(error);
      }
    });
  }
</script>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript">
setInterval(function(){
  document.querySelector('#loader').style['display'] = 'none';
  document.querySelector('#tudo_page').style['display'] = '';
}, 2000);
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>

<?php
    }
  }
?>