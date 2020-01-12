<style>
    td[data-href] {
        cursor: pointer;  
    }
    td[data-href]:hover {
        background-color: #33a652;
    }
</style> 

<?php include 'asesor_navbar.php';
    $where = "";
    $mail = $_GET['inputMail'];
    include 'Conn.php';
    $queryId = "SELECT idAsesor FROM Asesor WHERE correo = '$mail'";
    $resultadoId = $conn->query($queryId);
    $resultadoId->data_seek(0);
    $filaId = $resultadoId->fetch_assoc();
    $idAsesor = $filaId['idAsesor'];
    $conn->close();
?>

<div class="container p-5">
  <div class="row p-2">
    <div class="col-md-6">
      <button class="btn-b peach-gradient btn-block p-3" onclick="window.location.href='registro_aseso.php?id=<?php echo $idAsesor; ?>'">Registrar Asesoría</button>
    </div>
    <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3" onclick="window.location.href='asesor_historial.php?id=<?php echo $idAsesor; ?>'">Historial</button><br>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <h5>ULTIMAS ASESORIAS</h5>
      <div class="table-responsive">
          <table class="table table-striped table-dark table-sm table-bordered">
              <thead>
                  <th scope="col">ID</th>
                  <th scope="col">Alumno</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Motivo</th>
                  <th scope="col">Observaciones</th>
              </thead>
              <tbody>
                <?php
                  include 'Conn.php';
                  $query = "SELECT Asesores.idAsesoria AS Asesoria, Alumno.idAlumno AS id, CONCAT(Alumno.nombre,' ', Alumno.apellido) AS Alumno, 
                  Asesores.fecha AS Fecha, Asesores.Motivo AS Motivo, Asesores.observaciones AS Observaciones
                  FROM (	
                      SELECT * FROM Asesor 
                      NATURAL JOIN (
                          SELECT *
                          FROM Motivo 
                          NATURAL JOIN Asesoria
                      ) as Motivos 
                  ) AS Asesores
                  INNER JOIN Alumno
                  ON Asesores.idAlumno = Alumno.idAlumno  
                  WHERE Asesores.idAsesor = $idAsesor
                  ORDER BY Asesores.idAsesoria DESC
                  LIMIT 5";
                  $resultado = $conn->query($query);
                  if(!$resultado->fetch_array()){
                      echo "<tr><td colspan='5'>AUN NO HAY ASESORIAS REGISTRADAS</td></tr>";
                  }else{
                      
                  $resultado->data_seek(0);
                  
                  while ($fila = $resultado->fetch_assoc()) {
                      ?>
                      <tr>
                          <td class="align-middle"><?php echo $fila['Asesoria']; ?></td>
                          <td data-href="alumno_historial.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
                          <td class="align-middle"><?php echo $fila['Fecha']; ?></td>
                          <td class="align-middle"><?php echo $fila['Motivo']; ?></td>
                          <td class="align-middle"><?php echo $fila['Observaciones']; ?></td>
                      </tr>
                  <?php
                  }
                }
                    $conn->close();
                ?>
              </tbody>
          </table>
      </div>
      <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='asesor_historial.php?id=<?php echo $idAsesor; ?>'">VER TODAS</button>
    
  </div>
  <?php include 'asesor_check.php'; ?>
  </body>