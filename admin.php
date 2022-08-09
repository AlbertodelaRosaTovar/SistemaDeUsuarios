<?php
ob_start();
require_once 'cnn.php';
require_once 'cdn.html';
session_start();


?>
<?php
if (isset($_POST["depositar"])) {

  $ncuenta = $_POST['cuenta'];
  $sql = $cnnPDO->prepare("SELECT * FROM  usuarios WHERE ncuenta = :ncuenta ");
  $sql->bindParam(':ncuenta', $ncuenta);
  $sql->execute();
  $count = $query->rowCount();
  $campo = $query->fetch();
  header("locaton:depositar.php");
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

    .loginform {
      background-image: url(img/3.jpg);
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
  </nav><!-- Navbar -->
</head>
<br>
<br>
<br>

<body id="fondo" background="img/rojo.jpg">
  <div class="container">
    <div class="row">
      <div class="col-4">

      </div>
      <div class="offset-1 col-10">
        <!-- icons-->
        <br>
        <br>
        <div class="gris" class="input-group flex-nowrap">
          <span class="input-group-text" id="addon-wrapping">
            <i class="fas fa-key">Administrador</i>
          </span>
        </div>
        <!-- FORM-->
        <div id="container" class="loginform">
          <br>
          <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
              <?php

              $sql = "SELECT * FROM usuarios WHERE ncuenta != 'administrador'";
              $stmt = $cnnPDO->prepare($sql);
              $stmt->execute();

              while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <div class="col-md-4 mb-3 mb-md-0" style="margin-top: 2%;" data-aos="fade-up">
                  <div class="card py-4 h-100" style=" background-color: #F7BEC0; font-size: 20px;">
                    <div class="card-body">
                      <form method="post" action="depositar.php">
                        <div class="small text-black">Número de cuenta: <b><?php echo $campo['ncuenta']; ?></b></div>
                        <div class="small text-black">Nombre del cliente: <b><?php echo $campo['nombre']; ?></b></div>
                        <div class="small text-black">Tipo de cuenta: <b><?php echo $campo['tcuenta']; ?></b></div>
                        <div class="small text-black">Saldo Actual: $ <b><?php echo $campo['saldo']; ?>.00</b></div>
                        <div class="small text-black">Estatus: <b>
                            <font color="red"><?php echo $campo['status']; ?></font>
                          </b></div><br>
                        <input type="hidden" name="ncuenta" id="cuenta" value="<?php echo $campo['ncuenta']; ?>">
                        <center><input type="submit" name="depositar" id="depositar" class="btn btn-dark" value="Depositar"></center>
                      </form>
                    </div>
                  </div>
                </div>
              <?php }
              ?>
            </div>
            <br>
          </div>
          <br>
        </div>
      </div><!-- COL-6-->
    </div>
  </div>

  <div style="width:100%;margin:0 auto; margin-top:134px;">
    <footer>
      <img src="img/foot.png" alt="">
  </div>
  </footer>
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