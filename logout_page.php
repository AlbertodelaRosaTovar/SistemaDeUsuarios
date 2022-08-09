<?php
session_start();
session_destroy();
require_once 'cnn.php';
require_once 'cdn.html';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8-" name="viewport" content="width=device-width, initial-scale=1" />
</head>
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
    background-color: #fff;
    border: .8px solid #ccc;
    box-shadow: 0px 2px .5px 1px #ccc;
  }
</style>

<body id="fondo" background="img/banner.png">


  <div class="container">
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-6">
        <br><br><br><br><br>
        <div id="container" class="loginform">
          <div class="gris" class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">
              <i class="far fa-address-card">&nbsp;Lo Sentimos</i>
            </span>
          </div>
          <h2>
            <hr style="border-top:1px dotted #ccc;" />
            <center>
              <h3>Se ha cerrado su sesión por Inactividad</h3>
            </center>
            <hr>
            <a href="index.php">
              <center> <button type="button" class="btn btn-outline-danger px-3 me-2">
                  Volver a acceder &nbsp;
                </button></center>
            </a>
        </div>
      </div>
      <br>



    </div><!-- ROW -->
  </div><!-- Containerr -->

</body>

</html>