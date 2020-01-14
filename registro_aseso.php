<?php include 'asesor_navbar.php';
    $where = "";
    $idAsesor = (int)$_GET['id'];
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
      <h1>Registro de nueva asesoria</h1>
      <b>Escriba nombre de alumno</b>
        <div class="row">
          <div class="col-md-12">
            <input id="search" type="text" placeholder="Escriba aquí">
          </div>
      </div>
        <br> 
        <br> 
        <table id="houdini" class="table table-striped table-dark table-sm table-bordered">
          <thead>
            <th scope="col">Alumno</th>
            <th scope="col">Escuela</th>
            <th scope="col">Grado</th>
            <th scope="col">Grupo</th>
          </thead>
          <tbody id="filter"> 
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
            WHERE ase.idAsesor = $idAsesor
            ORDER BY Alumno ASC
            LIMIT 15";
            $resultado = $conn->query($query);

            if (!$resultado) {
              echo "ERROR: " . $conn->error;
            }
            $resultado->data_seek(0);
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td data-href="datos_alumno.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
                    <td class="align-middle"><?php echo $fila['Escuela']; ?></td>
                    <td class="align-middle"><?php echo $fila['Grado']; ?></td>
                    <td class="align-middle"><?php echo $fila['Grupo']; ?></td>
                </tr>
            <?php
            }
            $conn->close();

            ?>
          </tbody> 
        </table> 
      
      <!--</div>-->
      <div class="row my-4 justify-content-center">
        <div class="col-sm-3">
          <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='asesor_dashboard.php?inputMail=<?php echo $mail; ?>'">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
  
<script> 
  document.getElementById("houdini").style.visibility = "hidden";
  $(document).ready(function() { 
      $("#search").on("keyup", function() {
         var value = $(this).val().toLowerCase();
         if(value === "") {
          document.getElementById("houdini").style.visibility = "hidden";
         } else {
          document.getElementById("houdini").style.visibility = "visible";
          $("#filter tr").filter(function() { 
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1) 
          }); 
        }
      }); 
  }); 
</script>

<script>
    $(document).ready(function () {
        $(document.body).on("click", "td[data-href]", function () {
            window.location.href = this.dataset.href + "?idAsesor=" + <?php echo(json_encode($idAsesor)); ?> + "&idAlumno=" + this.dataset.id;
        });
    });
</script>
</body>
</html>