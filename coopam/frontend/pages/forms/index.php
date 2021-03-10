<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Início</title>
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
    include('slidebar.html');
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Início</h1>
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

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Informações</h3>
            </div>

            <div class="card-body">
              VAZIO
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <!-- /.content-wrapper -->
 <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Versão</b> 1.0
    </div>
    <strong>&copy; 2020 NIPE - CAMPUS MUZAMBINHO.</strong> Todos os direitos reservados.</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
const data = window.localStorage.getItem('expires_in');
document.querySelector('#timeSession').innerHTML = 'Sessão expira em: ' + new Date(data).toLocaleString();
document.querySelector('#usuarioLogado').innerHTML = 'Logado: ' + window.localStorage.getItem('user_cpf');

setInterval(function(){
  document.querySelector('#loader').style['display'] = 'none';
  document.querySelector('#tudo_page').style['display'] = '';
}, 1000);
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

</body>
</html>