<?php include 'asesor_navbar.php';
$where = "";
$idAsesor = (int) $_GET['idAsesor'];
$idAlumno = (int) $_GET['idAlumno'];
$idTipoAsesoria = (int) $_GET['idTipoAsesoria'];
$idMotivoAsesoria = (int) $_GET['idMotivoAsesoria'];
include 'Conn.php';
$queryId = "SELECT correo FROM Asesor WHERE idAsesor = '$idAsesor'";
$resultadoId = $conn->query($queryId);
$resultadoId->data_seek(0);
$filaId = $resultadoId->fetch_assoc();
$mail = $filaId['correo'];
$conn->close();
?>

<?php
if (isset($_POST['subir'])) {
  include 'Conn.php';
  $fecha = date('Y-m-d', strtotime($_POST['fecha']));
  $observaciones = $_POST['observaciones'];
  echo $fecha;
  echo $observaciones;
  $query = "INSERT INTO Asesoria (idAsesoria, idAlumno, idMotivo, idAsesor, fecha, observaciones) VALUES (NULL, $idAlumno, $idMotivoAsesoria,
                        $idAsesor, $fecha, '$observaciones')";
  if ($conn->query($query) === TRUE) {
    ob_start();
    $url = 'http://facilitadoresaxios.com/carga_exitosa.php';

    while (ob_get_status()) {
      ob_end_clean();
    }
    header("Location: $url");
  } else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }

  $conn->close();
}
?>


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <?php
      include 'Conn.php';
      $query = "SELECT a.idAlumno AS id, CONCAT(a.nombre,' ', a.apellido) AS Alumno, 
            e.nombre AS Escuela, ga.numero AS Grado, gu.grupo AS Grupo
            FROM Alumno as a JOIN Grupo as gu
            ON a.idGrupo = gu.idGrupo
            JOIN Grado as ga
            ON gu.idGrado = ga.idGrado
            JOIN Turno as t
            ON ga.idTurno = t.idTurno
            JOIN Escuela as e
            ON t.idEscuela = e.idEscuela
            LEFT JOIN Asesor as ase
            ON t.idAsesor = ase.idAsesor
            WHERE ase.idAsesor = $idAsesor AND a.idAlumno = $idAlumno";
      $resultado = $conn->query($query);

      $resultado->data_seek(0);
      $fila = $resultado->fetch_assoc()
      ?>
      <h1>Nueva asesoria con:</h1>
      <br>
      <h2><?php echo $fila['Alumno']; ?></h2>
      <br>

      <?php
      $conn->close();
      ?>
      <div class="row my-4">
        <form method="post" action="" id="insertForm">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <h3>Fecha de asesoria</h3>
            <input name="fecha" type="date">
            <br>
            <br>
            <h3>Observaciones</h3>
            <textarea name="observaciones" rows="10" cols="100" placeholder="Escriba aquí"></textarea>
          </div>
          <div class="col-sm-2"></div>
          <div class="row my-4 justify-content-center">
            <div class="col-sm-8">
              <button type="submit" class="btn btn-success btn-lg btn-primary btn-block text-uppercase" name="subir" form="insertForm">Subir asesoria</button>
            </div>
          </div>
      </div>

      <br>

      <div class="row my-4 justify-content-center">
        <div class="col-sm-5">
          <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='asesor_dashboard.php?inputMail=<?php echo $mail; ?>'">Cancelar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $(document.body).on("click", "button[data-href]", function () {
            window.location.href = this.dataset.href
                                 + "?idAsesor=" + <?php echo(json_encode($idAsesor)); ?>
                                 + "&idAlumno=" + <?php echo(json_encode($idAlumno)); ?>
        });
    });
</script>

</body>

</html>