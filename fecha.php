<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>hola</title>
</head>

<body>
  <script type="text/javascript">
    var timerHour;
    $(document).ready(function() {
      setInterval(function() {
        document.getElementById("H3_Hour").innerHTML = moment().format('DD/MM/yyyy HH:mm:ss');
      }, 1000);
    });
  </script>
  <!-- Fecha y Hora-->
  <div style="background-color: #030020; color: white; position: fixed; z-index: 5000; bottom: 25px; right: 0px; width:280px; padding: 0px 10px 0px 10px;">
    <h3 id="H3_Hour" name="H3_Hour"></h3>
  </div>
</body>

</html>