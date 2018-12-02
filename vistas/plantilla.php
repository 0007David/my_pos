<!DOCTYPE html>

<html>

<head>

      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <title>Sistema de Ventas</title>

      <!--=============================================
      =            Plugins CSS                        =
      =============================================-->
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="vistas/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

          <!--=============================================
         =            Plugins javascript            =
         =============================================-->
        <!-- jQuery 3 -->
        <script src="vistas/bower_components/jquery/dist/jquery.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.js"></script>
        <!-- DataTables -->
        <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.js"></script>
        <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>

        
        <!-- AdminLTE App interaccion js-->
        <script src="vistas/dist/js/adminlte.min.js"></script>
        <!-- SweetAlert2-->
        <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
        <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>


        
        

</head>

<body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">


                <?php
                    require_once('modulos/header.php');
                    require_once('modulos/sidebar.php');
                ?>

          
              <!-- Content Wrapper. Contains page content -->
              <div class="content-wrapper">

                <?php

                    if(isset($_GET["ruta"])) {

                      if($_GET["ruta"]=="inicio" ||
                         $_GET["ruta"]=="empleado" ||
                         $_GET["ruta"]=="estadistica" ||
                         $_GET["ruta"]=="cliente" ||
                         $_GET["ruta"]=="usuario" ||
                         $_GET["ruta"]=="proveedor") {

                        include "vistas/modulos/".$_GET["ruta"].".php";

                      }


                    }
                    else {

                        include "vistas/modulos/inicio.php";
                        
                      }

                    echo "</div>";

                    require_once('modulos/footer.php');      

                 ?>
      
      </div>
      <!-- ./wrapper -->
         


          <script src="vistas/js/plantilla.js"></script>
          <script src="vistas/js/cliente.js"></script>
          <script src="vistas/js/empleado.js"></script>
          <script src="vistas/js/usuario.js"></script>

          
</body>

</html>