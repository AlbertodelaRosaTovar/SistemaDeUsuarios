<?php
session_start();
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


  if (isset($_POST['eliminar'])) {
    $status = "Inactivo";
    $ncuenta = $_POST['ncuenta']; {
      $sql = $cnnPDO->prepare('UPDATE usuarios SET  status = :status  WHERE ncuenta= :ncuenta');
      //Asignar las variables a los campos de la tabla

      $sql->bindParam(':status', $status);
      $sql->bindParam(':ncuenta', $ncuenta);

      //Ejecutar la variable $sql
      $sql->execute();
      unset($sql);
      unset($cnnPDO);
      header("location: index.php");
    }
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
          <form action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off" class="form-horizontal" id="loginform" method="POST" role="form">
            <div class="gris" class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping"><i class="far fa-address-card">&nbsp;Inicio</i></span>
            </div>
            <?php
            include 'cnn.php';
            ?>
            <tr>
              <td> <input type="text" hidden id="nombre" name="nombre" value=" <?php echo ucwords($_SESSION['nombre']); ?>"></td>

              <td> <input type="text" hidden id="ncuenta" name="ncuenta" value="<?php echo $_SESSION['ncuenta'] ?>" readonly></td>

              <td> <input type="text" hidden id="tcuenta" name="tcuenta" value="<?php echo $_SESSION['tcuenta'] ?>" readonly></td>
              <td> <input type="text" hidden id="saldo" name="saldo" value="<?php echo $_SESSION['saldo'] ?>" readonly></td>



            </tr>
            <h2>Bienvenido, <?php echo ucwords($_SESSION['nombre']); ?>.
              <hr>Numero de cuenta: <?php echo ucwords($_SESSION['ncuenta']); ?>.
              <hr>Tipo de cuenta: <?php echo ucwords($_SESSION['tcuenta']); ?>.
              <hr>Saldo: $ <?php echo ucwords($_SESSION['saldo']); ?>.00
              <hr> Estas seguro que quieres desactivar tu cuenta?
              <br>
            </h2>
            <div class=" offset-3 col-7">
              <button type="submit" id="eliminar" name="eliminar" class="btn btn-outline-danger   ">Desactivar</button>
              <a href="login.php">
                <button type="button" class="btn btn-outline-danger px-3 me-2">
                  Volver
                </button>
              </a>
            </div>
          </form>
        </div>
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