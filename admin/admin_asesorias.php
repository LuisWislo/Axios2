<?php
include 'navbar_admin.php';
?>

<div class="container">
  <div class="row">
    <h5>ASESORIAS</h5>
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
                    ORDER BY Asesores.fecha DESC";

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
        <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_dashboard.php'">BACK</button><br>
      </div>
  </div>
  <?php include 'admin_check.php'; ?>
  </body>