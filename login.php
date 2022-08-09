<?php
require_once 'cnn.php';
require_once 'cdn.html';
session_start();
if (!isset($_SESSION['ncuenta'])) {
  header('location: logout_page.php');
} else {
  if ((time() - $_SESSION['time']) > 10) {
    header('location: logout_page.php');
  }

?>
  <?php

  //se guarda en las variables$us y $ps
  $nombre = $_SESSION['nombre'];
  //Query de consulta
  $query = $cnnPDO->prepare('SELECT * from usuarios WHERE nombre =:nombre  ');
  $query->bindParam(':nombre', $nombre);
  $query->execute();
  $count = $query->rowCount();
  $campo = $query->fetch();
  unset($query);
  unset($cnnPDO);
  if ($count) {


    $_SESSION['ncuenta'] = $campo['ncuenta'];
    $_SESSION['nombre'] = $campo['nombre'];
    $_SESSION['tcuenta'] = $campo['tcuenta'];
    $_SESSION['password'] = $campo['password'];
    $_SESSION['saldo'] = $campo['saldo'];
  }

  ?>




  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cotizacion</title>
    <link rel="icon" href="img/logoh.png" />
    <link rel="stylesheet" href="styles.css">

    <style>
      #naz {
        background-color: #fff;
      }

      #fondo {
        background-color: #fafbfd;
      }

      .fondof {
        background-color: #ffcecf;
      }

      .gris {
        background-color: #ffcecf;
        text-decoration-color: white;

      }

      #loginform {
        background-color: #fff;
        border: .8px solid #ccc;
        box-shadow: 0px 2px .5px 1px #ccc;
      }
    </style>

    <!-- Navbar -->
    <nav id="naz" class="navbar navbar-expand-lg fixed-top ">
      <!-- Container wrapper -->
      <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="img/logo.png">
          <img src="img/hsbc.png" height="46" alt="MDB Logo" loading="lazy" style="margin-top: -1px;" />
        </a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>


        </button>
        <!-- Left links -->
        <div class="d-flex align-items-center">
          <?php
          date_default_timezone_set("America/Mexico_City");
          echo date("d-m-Y h:i a"); ?>&nbsp;&nbsp;&nbsp;
          <a href="cerrar.php">
            <button type="button" class="btn btn-outline-danger px-3 me-2">
              Cerrar Sesión <i class="ace-icon fa fa-power-off"></i>
            </button>
          </a>
          <a href="eliminar.php">
            <button type="submit" id="eliminar" name="eliminar" class="btn btn-outline-danger px-3 me-2">
              Desactivar cuenta&nbsp;<i class="fas fa-trash-alt"></i>
            </button>
          </a>
        </div>

      </div><!-- Collapsible wrapper -->
      </div><!-- Container wrapper -->
    </nav><!-- Navbar -->
  </head>
  <br>
  <br>
  <br>

  <body id="fondo" background="img/4.jpg">

    <div class="container">
      <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6">
          <br>
          <br>
          <br>
          <form id="loginform">
            <!-- INICIO SESION-->
            <div class="gris" class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">
                <i class="far fa-address-card">&nbsp;Inicio</i>
              </span>
            </div>
            <h2>Bienvenido, <?php echo ucwords($_SESSION['nombre']); ?>.
              <hr>Numero de cuenta: <?php echo ucwords($_SESSION['ncuenta']); ?>.
              <hr>Tipo de cuenta: <?php echo ucwords($_SESSION['tcuenta']); ?>.
              <hr>Saldo: $ <?php echo ucwords($_SESSION['saldo']); ?>.00
        </div>
        </form>
        <br>



      </div><!-- ROW -->
    </div><!-- Containerr -->




  </body>
  <br>
  <div style="width:100%;margin:0 auto; margin-top:134px;">
    <!-- Footer -->
    <footer class="fondof" class="bg-dark text-center text-white">
      <!-- Grid container -->
      <div class="container p-4">
        <!-- Section: Social media -->

        <!-- Section: Text -->
        <section class="mb-4">

          <p class="text-center">
            Somos una empresa de calidad, dedacos a la seguridad y transacciones en todo el mundo, ven y conocenos!
          </p>
        </section>
        <!-- Section: Text -->

        <!-- Section: Links -->

        <!-- Section: Links -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Alberto De La Rosa
        <a class="text-white" href="https://mdbootstrap.com/"></a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->

  </html>
<?php
}
?>