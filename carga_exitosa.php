<?php include 'asesor_navbar.php';
    $where = "";
    $idAsesor = (int)$_GET['idAsesor'];
    include 'Conn.php';
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
          <form onsubmit="return validateForm()">
   
        <?php
        $conn->close();
        ?>
          <div class="row my-4">
            <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <h1>Asesoria cargada con éxito</h1>
              </div>
              <div class="col-sm-2"></div>
            </div>
          </form>
        
        <br>
        <div class="row">
            <button class="btn-b blue-gradient btn-block p-3" onclick="window.location.href='asesor_dashboard.php'">Regresar al menu principal</button><br>
        </div>
      </div>
    </div>
  </div>
<?php include 'asesor_check.php'; ?>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

</body>