<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My ecommerce by pn</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="admin/css/stripe.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<?php
    session_start();
    $accion=$_REQUEST['accion']??'';
    if($accion=='cerrar'){
        session_destroy();
        header("Refresh:0");
    }
?>
</head>

<body>
    <!-- jQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
<?php
include_once "admin/db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                
                <?php
                include_once "header.php";
                $modulo=$_REQUEST['modulo']??'';
                if($modulo=="productos" || $modulo=="" ){
                    include_once "productos.php";
                }
                if( $modulo=="detalleproducto" ){
                    include_once "detalleProducto.php";
                }
                if( $modulo=="carrito" ){
                    include_once "carrito.php";
                }
                if( $modulo=="envio" ){
                    include_once "envio.php";
                }
                if( $modulo=="pasarela" ){
                    include_once "pasarela.php";
                }
                if( $modulo=="factura" ){
                    include_once "factura.php";
                }
                if( $modulo=="blogs" ){
                    include_once "blogs.php";
                }
                if( $modulo=="nosotros" ){
                    include_once "nosotros.php";
                }
                if( $modulo=="contacto" ){
                    include_once "contacto.php";
                }
                if( $modulo=="historial" ){
                    include_once "historial.php";
                }
                if( $modulo=="producto"){
                    include_once "producto.php";
                }
                include_once "footer.php";
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery UI 1.11.4 -->
    <script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- daterangepicker -->
    <script src="admin/plugins/moment/moment.min.js"></script>
    <script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="admin/dist/js/pages/dashboard.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="admin/js/stripe.js"></script>
    <script src="admin/js/ecommerce.js"></script>
    
</body>

</html>