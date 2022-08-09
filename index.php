<?php
ob_start();
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
?><div class="alert alert-danger alert-dismissible fade show" role="alert">
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
<?php
//Validar que el usuario hizo clik en el Boton enviar 
if (isset($_POST['enviar1'])) {
  //Trae datos del formulario
  $ncuenta = $_POST['ncuenta'];
  $nombre = $_POST['nombre'];
  $tcuenta = $_POST['tcuenta'];
  $password = $_POST['password'];
  $status = "Activo";




  //Validar que las cajas no esten vacias
  if (!empty($ncuenta) && !empty($nombre) && !empty($tcuenta) && !empty($password) && !empty($status)) {
    //Insertar datos en la tabla de la db  
    $sql = $cnnPDO->prepare("INSERT INTO usuarios
                (ncuenta, nombre, tcuenta, password,saldo,status) VALUES (:ncuenta, :nombre, :tcuenta, :password,00,:Activo )");

    //Asignar las variables a los campos de la tabla
    $sql->bindParam(':ncuenta', $ncuenta);
    $sql->bindParam(':nombre', $nombre);
    $sql->bindParam(':tcuenta', $tcuenta);
    $sql->bindParam(':password', $password);
    $sql->bindParam(':Activo', $status);



    //Ejecutar la variable $sql
    $sql->execute();
    unset($sql);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Anton|Dosis:400,800" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <title>index</title>
  <link rel="icon" href="img/logoh.png" />
  <script type="text/javascript">
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>


</head>

<body>
  <!-- Navbar -->

  <nav id="naz" class="navbar navbar-expand-lg  ">
    <!-- Container wrapper -->

    <div class="container">
      <a class="navbar-brand me-2" href="img/logo.png">
        <img src="img/hsbc.png" height="46" alt="MDB Logo" loading="lazy" style="margin-top: -1px;" />
      </a>
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i>
      </button>
    </div>
    <!-- Left links -->
    <main class="container  ">
      <div class="row offset-11">
        <div class=" col-8">
          <a href="" class="btn btn-outline-danger px-3 me-3" data-toggle="modal" data-target="#modal">
            Iniciar Sesión
          </a>
          <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Iniciar Sesión</h4>
                </div>
                <div class="modal-body">
                  <!-- FORM-->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off" class="form-horizontal" id="loginfor" method="POST" role="form"><br>
                    <!-- NUMERO DE CUENTA-->


                    <!--EMAIL-->
                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">
                        <i class="fas fa-user prefix grey-text"></i>
                      </span>
                      <input aria-describedby="addon-wrapping" aria-label="Username" name="ncuenta" id="ncuenta" class="form-control" placeholder="Numero de cuenta" type="text" />
                    </div>
                    <br>

                    <!--NOMBRE-->
                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">
                        <i class="fas fa-lock prefix grey-text"></i>
                      </span>
                      <input aria-describedby="addon-wrapping" aria-label="Username" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña" type="text" />
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-3 offset-4 ">
                        <div>
                          <button type="submit" name="enviar" id="enviar" class="btn btn-danger">
                            Continuar
                          </button>
                        </div>
                      </div>
                    </div>
                </div>

                </form><!-- FORM-->
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
    <main class="container  ">
      <div class="row offset-3">
        <div class=" col-8">
          <a href="" class="btn btn-outline-danger px-3 me-3" data-toggle="modal" data-target="#modal1">
            Registrarse
          </a>

          <div id="modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Registro</h4>
                </div>
                <div class="modal-body">
                  <!-- FORM-->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" id="loginfor" method="POST" class=" needs-validation " novalidate>
                    <br>
                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">
                        <i class="fas fa-university"></i>
                      </span>
                      <input aria-describedby="addon-wrapping" aria-label="Username" name="ncuenta" required="" id="ncuenta" class="form-control" placeholder="Numero de cuenta" type="text" />
                      <div class="invalid-feedback">
                        Por favor, Escriba el numero de cuenta
                      </div>
                    </div>
                    <br>
                    <!-- NUMERO DE CUENTA-->

                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">
                        <i class="fas fa-user prefix grey-text"></i>
                      </span>
                      <input aria-describedby="addon-wrapping" aria-label="Username" name="nombre" required="" id="nombre" class="form-control" placeholder="Nombre completo" type="text" />
                      <div class="invalid-feedback">
                        Por favor, Escriba Su nombre completo
                      </div>
                    </div>
                    <br>




                    <!-- TIPO DE CUENTA-->


                    <label class="form-label" for="validationCustom03">
                      Tipo de cuenta
                    </label>
                    <select aria-label="Default select example" name="tcuenta" class="form-select" id="validationCustom03" required="">
                      <option selected="">
                      </option>
                      <option value="Debito">
                        Debito
                      </option>
                      <option value="Ahorro">
                        Ahorro
                      </option>
                      <option value="Credito">
                        Credito
                      </option>
                    </select>
                    <div class="invalid-feedback">
                      Por favor, indique el tipo de cuenta
                    </div>
                    <br>


                    <div class="input-group flex-nowrap">
                      <span class="input-group-text" id="addon-wrapping">
                        <i class="fas fa-lock prefix grey-text"></i>
                      </span>
                      <input aria-describedby="addon-wrapping" aria-label="Username" name="password" required="" id="password" class="form-control" placeholder="Ingrese su contraseña" type="password">
                      </input>
                      <div class="invalid-feedback">
                        Por favor, Escriba Su Contraseña
                      </div>
                    </div>
                    <br>



                    <div class="row">
                      <div class="col-3 offset-5 ">
                        <div class="modal-footer">
                          <input type="submit" name="enviar1" id="enviar1" placeholder="enviar" class="btn btn-danger ">

                        </div>
                      </div>
                    </div>

                  </form><!-- FORM-->
                </div>


              </div>

            </div>
          </div>
        </div>
      </div>
    </main>
  </nav><!-- Navbar -->




  <!--inicio carousel-->
  <div class="carousel slide" data-ride="carousel" id="slider">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img-fluid d-block " src="img/aa.png " />
      </div>
      <div class="carousel-item">
        <img class="img-fluid d-block " src="img/bb.png" />
      </div>
    </div>
    <!--Flechas con funcion hacia atras adelante-->
    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
  <!--fin -->


  <div class="container">
    <br>


    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/tt.png" alt=""></a>
    <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;<img src="img/t.png" alt=""></a>
  </div>
  <script src="js/jquery.slim.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/scripts.js"></script>
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