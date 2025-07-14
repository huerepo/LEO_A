<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>EADV∑ Verificator 1.2</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    body,
    html {
      font-family: Lato, sans-serif;
      font-weight: 400;
      font-style: normal;
      line-height: 1.25;
      padding: 20px;
      background-color: #e3dfd4
    }

    .table {
      table-layout: fixed
    }

    td {
      color: #011730 !important
    }

    .codex {
      font-size: 7px;
      text-align: justify;
      word-wrap: break-word;
      padding: 10px
    }

    .table {
      font-size: 14px
    }
  </style>


  <?php
  require 'con.php';

  $idcourse = $_GET['idc'];
  $context = context_course::instance($idcourse);
  if (has_capability('moodle/course:manageactivities', $context)) {
    $sql = "SELECT ms.sl_id, mc.fullname, CONCAT (mu.firstname, mu.lastname) AS docente, ms.sl_fecha, ms.sl_hora, ms.sl_prophet, ms.sl_codex FROM mdl_slink ms, mdl_course mc, mdl_user mu WHERE ms.sl_course = ? AND mc.id = ? AND mu.id = ms.sl_docente";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $idcourse, $idcourse);
    mysqli_stmt_execute($stmt);
  ?>
 
 <div style="text-align:right"><img src="img/logoCol.png" height="100px">&nbsp;&nbsp; <img src="img/very.svg" height="100px">
      <h2 style="text-align:right">Maestría en Seguridad Nacional Promoción LVIII<h2>
          <p style="font-size:14px;text-align:right">Verificador de actas emitidas</p>
    </div><span>&nbsp;</span>
    <?php
    $num = 1;
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <table class="table">
        <tbody>
          <tr>
            <th>#</th>
            <th>Id</th>
            <th>Asignatura</th>
            <th>Docente</th>
            <th>Fecha de impresión</th>
            <th>Hora de impresión</th>
            <th>Impreso por</th>
          </tr>
          <?php
          echo "<tr><td  style='width: 20px; border-right:1px solid'>" . $num . "</td>";
          echo "<td data-label='ID' style='border-right:1px solid'>" . $row['sl_id'] . "</td>";
          echo "<td data-label='CURSO' >" . $row['fullname'] . "</td>";
          echo "<td data-label='DOCENTE'>" . $row['docente'] . "</td>";
          echo "<td data-label='FECHA'  >" . $row['sl_fecha'] . "</td>";
          echo "<td data-label='HORA' >" . $row['sl_hora'] . "</td>";
          echo "<td data-label='PROPHET' >" . $row['sl_prophet'] . "</td></tr>";
          echo "<tr style='background-color:#fff!important;'><td data-label='PROPHET' colspan='7' class='codex' ><b><h5>CODEX</h5></b>" . $row['sl_codex'] . "<br>&nbsp;</td></tr>";
          $num++;
          echo "</tbody></table>";
    }
  } else {
    header("Refresh: 10; url=https://ead.cesnav.edu.mx");

    ?>
        <h1>Error</h1>
        <p>Usted no tiene autorizado acceder a este apartado.</p>
        <p id="countdown">Redirigiendo en<span id="seconds">10</span>segundos...</p>
        <script>let seconds = 10;
          const countdownEl = document.getElementById('seconds');
          const countdown = setInterval(() => {
            seconds--;
            countdownEl.textContent = seconds;
            if (seconds <= 0) {
              clearInterval(countdown);
            }
          }, 1000);</script>
        <?php
  }
     ?>
<body>