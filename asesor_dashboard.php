<?php include 'asesor_navbar.php'; ?>
<div class="container p-5">
  <div class="row p-2">
    <div class="col-md-6">
      <button class="btn-b peach-gradient btn-block p-3" onclick="window.location.href='registro_aseso.php'">Registrar Asesoría</button>
    </div>
    <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3">Historial</button><br>
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
        <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_asesorias.php'">VER TODAS</button>
      </div>
  </div>
  <?php include 'asesor_check.php'; ?>
  </body>