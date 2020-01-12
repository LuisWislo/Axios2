<?php
include 'navbar_admin.php';
?>
<div class="container p-5">
  <div class="row p-2">
    <div class="col-md-6">
      <button class="btn-b peach-gradient btn-block p-3" onclick="window.location.href='admin_sedes.php'">Sedes</button><br>
      <button class="btn-b blue-gradient btn-block p-3" onclick="window.location.href='admin_facilitadores.php'">Facilitadores</button>
    </div>
    <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3">Escuelas</button><br>
      <button class="btn-b aqua-gradient btn-block p-3">---</button>
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
          $query = "SELECT Asesores.idAsesoria, CONCAT(Alumno.nombre,' ', Alumno.apellido) AS Alumno,Asesores.nombre, Asesores.fecha, Asesores.Motivo, Asesores.observaciones
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
                    ORDER BY Asesores.idAsesoria DESC
                    LIMIT 5";

          $resultado = $conn->query($query);

          $resultado->data_seek(0);
          while ($fila = $resultado->fetch_assoc()) {
            ?>
            <tr>
              <td class="align-middle"><?php echo $fila['idAsesoria']; ?></td>
              <td class="align-middle"><?php echo $fila['Alumno']; ?></td>
              <td class="align-middle"><?php echo $fila['nombre']; ?></td>
              <td class="align-middle"><?php echo $fila['fecha']; ?></td>
              <td class="align-middle"><?php echo $fila['motivo']; ?></td>
              <td class="align-middle"><?php echo $fila['observaciones']; ?></td>
            </tr>
          <?php
          }
          $conn->close();

          ?>
        </tbody>
      </table>
    </div>
    <div class="row">
        <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_asesorias.php'">VER TODAS</button><br>
      </div>
  </div>
  <?php include 'admin_check.php'; ?>
  </body>