<?php
session_start();
require_once 'cnn.php';
require_once 'cdn.html';
?>
<?php


if (isset($_POST['enviar'])) {
  # Se guarda el contendio de las cajas de texto en las variables $us y $ps

  $us = $_POST['ncuenta'];
  $password = $_POST['password'];

  # Se valida que las variables no esten vacias o nulas
  if (!empty($us) &&  !empty($password)) {
    $query = $cnnPDO->prepare('SELECT nombre,ncuenta  from usuarios WHERE ncuenta =:ncuenta and password = :password  and status = "Activo" ');

    //Manejo de parámetros

    $query->bindParam(':ncuenta', $us);
    $query->bindParam(':password', $password);


    //Execución del query
    $query->execute();
    //$count=$query->rowCount();
    $count = $query->rowCount();
    //Asigna los datos del registro a la variable $campo
    $campo = $query->fetch();

    if ($count) {
      if ($campo['ncuenta'] == "administrador" and $campo['password'] == $ps) {
        $_SESSION['nombre'] = $campo['nombre'];
        $_SESSION['saldo'] = $campo['saldo'];
        $_SESSION['status'] = $campo['status'];
        header("location:admin.php");
      } else {
        $_SESSION['nombre'] = $campo['nombre'];
        $_SESSION['ncuenta'] = $campo['ncuenta'];
        $_SESSION['tcuenta'] = $campo['tcuenta'];
        $_SESSION['saldo'] = $campo['saldo'];
        $_SESSION['time'] = time();
        header("location:login.php");
      }
    } else {
?><br><br><br>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR de datos!</strong> Verifique La Dirección de correo electrónico
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<?php
    }
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
        <a href="registro.php">
          <button type="button" class="btn btn-outline-danger px-3 me-2">
            Registrarse
          </button>
        </a>
        <a href="index.php">
          <button type="button" class="btn btn-outline-danger px-3 me-2">
            Regresar &nbsp;<i class="fas fa-long-arrow-alt-right"></i>
          </button>
        </a>
      </div>
  </nav><!-- Navbar -->
</head>
<br>
<br>
<br>

<body id="fondo" background="img/banner.png">

  <div class="container">
    <div class="row">

      <div class="col-2">

      </div>

      <div class="col-8">
        <br>
        <h2 class="text-center text-white">Bienvenido de nuevo.</h2>
        <!-- icons-->
        <br>

        <div class="gris" class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <i class="fas fa-key">Iniciar Sesión</i>
          </span>
        </div>

        <!-- FORM-->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off" class="form-horizontal" id="loginform" method="POST" role="form">
          <br>
          <!-- NUMERO DE CUENTA-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Numero de cuenta
            </label>
            <input class="form-control" name="ncuenta" id="ncuenta" type="text">
            </input>
            <br>
          </div>
          <!-- PASSWORD-->
          <div class=" offset-3 col-7">

            <label class="form-label" for="exampleFormControlInput2">
              Contraseña
            </label>
            <input class="form-control" name="password" id="password" placeholder="" type="password">
            </input>
            <br>
          </div>




          <!-- BOTON CREAR-->
          <div class=" offset-5 col-3">
            <input type="submit" class="btn btn-outline-danger" name="enviar" value="continuar">
          </div>

          <br>

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