<?php include 'asesor_navbar.php';
    $where = "";
    $idAsesor = (int)$_GET['idAsesor'];
    $idAlumno = (int)$_GET['idAlumno'];
    include 'config/Conn.php';
    $queryId = "SELECT correo FROM Asesor WHERE idAsesor = '$idAsesor'";
    $resultadoId = $conn->query($queryId);
    $resultadoId->data_seek(0);
    $filaId = $resultadoId->fetch_assoc();
    $mail = $filaId['correo'];
    $conn->close();
?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <?php
        include 'config/Conn.php';
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
          <form onsubmit="return validateForm()">
        <?php
        $conn->close();
        ?>
          <div class="row my-4">
            <div class="col-sm-2"></div>
              <div class="col-sm-4">
                <label for="input-tipo">Tipo de Asesoría</label>
                <select id="tipoAsesoria" class="form-control">
                <?php
                include 'config/Conn.php';
                $query = "SELECT t.idTipoAsesoria AS id, t.tipoAsesoria AS tipo
                FROM TipoAsesoria as t";
                $resultado = $conn->query($query);

                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $fila['id']; ?>"><?php echo utf8_encode($fila['tipo']); ?></option>
                <?php } ?>
                
                </select>
                <?php
                $conn->close();
                ?>
              </div>
              <div class="col-sm-2"></div>
            </div>
          </form>
        
        
        <div class="row my-4 justify-content-center">
          <div class="col-sm-3">
            <button data-href="motivo_asesoria.php" class="btn btn-success btn-lg btn-primary btn-block text-uppercase">Aceptar</button>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='asesor_dashboard.php?inputMail=<?php echo $mail; ?>'">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function () {
        $(document.body).on("click", "button[data-href]", function () {
            window.location.href = this.dataset.href
                                 + "?idAsesor=" + <?php echo(json_encode($idAsesor)); ?>
                                 + "&idAlumno=" + <?php echo(json_encode($idAlumno)); ?>
                                 + "&idTipoAsesoria=" + document.getElementById('tipoAsesoria').value;
        });
    });
</script>
</body>
</html>