<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="views/img/templates/icono-negro.png">
<!--=================================
  =            Plugins CSS            =
  ==================================-->
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css"> 
  
  <!-- icheck -->
  <link rel="stylesheet" href="views/plugins/iCheck/all.css">
  
  <!-- Daterange picker
<link rel="stylesheet" href="views/bower_components/daterangepicker-master/daterangepicker.css">
   -->
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  
  <!--====  End of Plugins CSS  ====-->
  
  <!--========================================
  =            plugins javascript            =
  =========================================-->
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

  <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <!-- <script src="views/bower_components/daterangepicker-master/moment.min.js"></script>
  <script src="views/bower_components/daterangepicker-master/daterangepicker.js"></script> -->

  <!-- jQuery 3 -->
  <!-- <script src="views/bower_components/jquery/dist/jquery.min.js"></script> -->

    <!-- InputMask -->
<script src="views/plugins/input-mask/jquery.inputmask.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- JqueryNumber -->
  <script src="views/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- sweet alert -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- icheck -->
  <script src="views/plugins/iCheck/icheck.min.js"></script>



  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

<?php

if(isset($_SESSION["homeSession"]) && $_SESSION["homeSession"] == "ok") {

echo  "<div class='wrapper'>";

 include("modules/header.php");
 include("modules/menu.php");
//  include("modules/content.php");

 if(isset($_GET["page"])) {

  if($_GET["page"] == "home" || 
    $_GET["page"] == "users" || 
    $_GET["page"] == "category" ||
    $_GET["page"] == "product" ||
    $_GET["page"] == "client" ||
    $_GET["page"] == "sale" ||
    $_GET["page"] == "create-sale" ||
    $_GET["page"] == "edit-sale" ||
    $_GET["page"] == "logout" ||
    $_GET["page"] == "report" ) {
    include "modules/".$_GET["page"].".php";
  } else {
    include "modules/404.php";
  }
 } else {
   include ("modules/home.php");
 }

 include("modules/footer.php");
 echo "</div>";
} else {
  include("modules/login.php");
}

?>
<!-- ./wrapper -->

<script src="views/js/template.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/category.js"></script>
<script src="views/js/product.js"></script>
<script src="views/js/client.js"></script>
<script src="views/js/sale.js"></script>

</body>
</html>
