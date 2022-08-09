<?php
//require_once 'cnn.php';
require_once 'cdn.html';
require_once 'cnn.php';
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>cotizacion</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="icon" href="img/logoh.png" />
  <link rel="stylesheet" href="styles.css">
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
        <a href="iniciosesion.php">
          <button type="button" class="btn btn-outline-danger px-3 me-2">
            Iniciar Sesión
          </button>
        </a>
        <a href="index.php">
          <button type="button" class="btn btn-outline-danger px-3 me-2">
            Regresar &nbsp;<i class="fas fa-long-arrow-alt-right"></i>
          </button>
        </a>


      </div><!-- Collapsible wrapper -->
    </div><!-- Container wrapper -->
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
        <h2 class="text-center text-white">Comienza una nueva historia.</h2>
        <!-- icons-->
        <br>

        <div class="gris" class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <i class="fas fa-key">Registrate aqui!</i>
          </span>
        </div>

        <!-- FORM-->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" id="loginform" method="POST" class=" needs-validation " novalidate>
          <br>
          <!-- NUMERO DE CUENTA-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Numero de cuenta
            </label>
            <input class="form-control" name="ncuenta" id="exampleFormControlInput2" placeholder="ej. 12345" required="" type="text">
            </input>
            <div class="invalid-feedback">
              Por favor, Escriba el numero de cuenta
            </div>

          </div>



          <!-- NOMBRE-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Nombre
            </label>
            <input class="form-control" name="nombre" id="exampleFormControlInput2" placeholder="" required="" type="text">
            </input>
            <div class="invalid-feedback">
              Por favor, escriba su nombre
            </div>

          </div>
          <!-- TIPO DE CUENTA-->
          <div class=" offset-3 col-7">
            <br>
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


          </div>


          <!-- PASSWORD-->
          <div class=" offset-3 col-7">
            <br>
            <label class="form-label" for="exampleFormControlInput2">
              Contraseña
            </label>
            <input class="form-control" name="password" id="password" placeholder="" required="" type="password">
            </input>
            <div class="invalid-feedback">
              Por favor, escriba su contraseña
            </div>
            <br>
          </div>

          <!-- PASSWORD2-->
          <div class=" offset-3 col-7">

            <label class="form-label" for="exampleFormControlInput2">
              Confirmar contraseña
            </label>
            <input class="form-control" name="password2" id="password2" placeholder="" type="password">
            </input>
            <br>
          </div>



          <!-- BOTON CREAR-->
          <div class=" offset-5 col-3">
            <input type="submit" class="btn btn-outline-danger" name="enviar" id="enviar" value="Crear Cuenta">
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
<script type="text/javascript">
  $(document).ready(function() {
    let emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    $("#enviar").click(function() {

      if ($("#password2").val() != $("#password").val()) {

        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'error',
          //  Aqui pones el mensaje donde diga tittle
          title: 'Contraseñas diferentes'
        })
        return false;

      }

    });

  });
</script>