<?php
ob_start();
require_once 'cnn.php';
require_once 'cdn.html';
session_start();
?>

<?php
$ncuenta = $_POST['ncuenta'];
$query = $cnnPDO->prepare('SELECT * from usuarios WHERE ncuenta =:ncuenta');
$query->bindParam(':ncuenta', $ncuenta);
$query->execute();
$campo = $query->fetch();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>cotizacion</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

<body id="fondo" background="img/rojo.jpg">

  <div class="container">
    <div class="row">

      <div class="col-2">

      </div>

      <div class="col-8">
        <br>
        <h2 class="text-center text-white">Depositos.</h2>
        <!-- icons-->
        <br>

        <div class="gris" class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <i class="fas fa-key">Depositar</i>
          </span>
        </div>

        <!-- FORM-->
        <form id="loginform" method="POST" action="">
          <br>
          <!-- NUMERO DE CUENTA-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Numero de cuenta
            </label>
            <input class="form-control" name="ncuenta" id="exampleFormControlInput2" readonly type="text" value="<?php echo $campo['ncuenta'] ?>">

          </div>



          <!-- NOMBRE-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Nombre
            </label>
            <input class="form-control" name="nombre" id="exampleFormControlInput2" readonly type="text" value="<?php echo $campo['nombre'] ?>">


          </div>
          <!-- NOMBRE-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Tipo de cuenta
            </label>
            <input class="form-control" name="tcuenta" id="exampleFormControlInput2" readonly type="text" value="<?php echo $campo['tcuenta'] ?>">


          </div>

          <!-- NOMBRE-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Saldo
            </label>
            <input class="form-control" name="saldo" id="exampleFormControlInput2" readonly type="text" value="<?php echo $campo['saldo'] ?>.00">


          </div>


          <!-- PASSWORD-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Deposito
            </label>
            <input class="form-control" name="deposito" id="deposito" placeholder="" type="number">
            </input>

            <br>
          </div>




          <!-- BOTON CREAR-->
          <div class=" offset-5 col-3">
            <input type="submit" class="btn btn-outline-danger" name="enviar" id="enviar" value="Depositar">
          </div>

          <br>
          <div class=" offset-5 col-3">
            <a href="admin.php">
              <button type="button" class="btn btn-outline-danger px-3 me-2">
                Cancelar
              </button>
            </a>
          </div>

        </form><!-- FORM-->

      </div><!-- COL-6-->
    </div>
  </div>
  <br>
  <br>
  <br>
</body>
<!-- Footer -->
<footer class="fondof" class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4">
    <!-- Section: Social media -->
    <section class="mb-4 text-center text-black">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>




      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
    </section>
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