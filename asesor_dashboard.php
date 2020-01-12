<?php include 'asesor_navbar.php';?>
<div class="container p-5">
  <div class="row p-2">
    <div class="col-md-6">
      <button class="btn-b peach-gradient btn-block p-3" onclick="window.location.href='registro_aseso.php'">Registrar Asesoría</button>
    </div>
    <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3" onclick="window.location.href='asesor_historial.php'">Historial</button><br>
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
          <th scope="col">Asesor</th>
          <th scope="col">Fecha</th>
          <th scope="col">Motivo</th>
          <th scope="col">Observaciones</th>
        </thead>
        <tbody>
          <?php
          include 'conexion_admin.php';
          $query = " SELECT 
          a.idAlumno,
          a.noLista,
          CONCAT(a.nombre, ' '', a.apellido) as 'Nombre completo',
          grup.grupo,
          t.tipo as turno
        FROM
          Alumno a
        JOIN 
          Grupo grup ON grup.idGrupo = a.idGrupo
        JOIN
          Grado grad ON grad.idGrado = grup.idGrado
        JOIN
          Turno t ON t.idTurno = grad.idTurno
        WHERE
          t.idTurno = id;
                    LIMIT 5";

          $resultado = $conn->query($query);

          $resultado->data_seek(0);
          while ($fila = $resultado->fetch_assoc()) {
            ?>
            <tr>
              <td class="align-middle"><?php echo $fila['idAlumno']; ?></td>
              <td class="align-middle"><?php echo $fila['noLista']; ?></td>
              <td class="align-middle"><?php echo $fila['Nombre completo']; ?></td>
              <td class="align-middle"><?php echo $fila['grupo']; ?></td>
              <td class="align-middle"><?php echo $fila['turno']; ?></td>
            </tr>
          <?php
          }
          $conn->close();

          ?>
        </tbody>
      </table>
    </div>
    <div class="row">
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
                  WHERE Asesoria.idAsesor = 
                  ORDER BY Asesoria.idAsesoria DESC
                  LIMIT 5";
                  $resultado = $conn->query($query);

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
                  $conn->close();

                  ?>
              </tbody>
          </table>
      </div>
      <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='asesor_historial.php'">VER TODAS</button>
    </div>
  </div>
  <?php include 'asesor_check.php'; ?>
  </body>