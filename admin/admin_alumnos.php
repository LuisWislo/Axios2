<?php
include 'navbar_admin.php';

$where = "WHERE TRUE";

$asesor = !empty($_POST['asesor']) ? $_POST['asesor'] : "";
$sede = !empty($_POST['sede']) ? $_POST['sede'] : "";
$escuela = !empty($_POST['escuela']) ? $_POST['escuela'] : "";

if (isset($_POST['filtrar'])) {
  if ($asesor) $where .= " AND ase.nombre = '" . $asesor . "' ";
  if ($sede) $where .= " AND l.idLocalidad = " . $sede . " ";
  if ($escuela) $where .= " AND e.idEscuela = " . $escuela . " ";
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h5 class="display-4 text-center">Alumnos</h5>
        </div>
    </div>
    <br>
  <br>
  <div class="row">
    <form method="POST">
        <div class="row mb-3 justify-content-center">
            <div class="col-sm-12 text-center">
                <h5>FILTROS</h5>
            </div>
            <div class="col-sm-3">
            <select id="filtroAsesor" class="form-control" name="asesor">
                <option value="" selected>Facilitador</option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT nombre FROM Asesor");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                $nombreAsesor = $fila['nombre'];
                ?>
                <option value="<?php echo $nombreAsesor; ?>"><?php echo $nombreAsesor; ?></option>
                <?php
                }
                $conn->close();
                ?>
            </select>
            </div>
            <div class="col-sm-3">
            <select id="filtroSede" class="form-control" name="sede">
                <option value="" selected>Sede</option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT idLocalidad, nombre FROM Localidad");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                $idLocalidad = $fila['idLocalidad'];
                $nombreSede = $fila['nombre'];
                ?>
                <option value="<?php echo $idLocalidad; ?>"><?php echo $nombreSede; ?></option>
                <?php
                }
                $conn->close();
                ?>
            </select>
            </div>
            <div class="col-sm-3">
            <select id="filtroEscuela" class="form-control" name="escuela">
                <option value="" selected>Escuela</option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT idEscuela, nombre FROM Escuela");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                $idEscuela = $fila['idEscuela'];
                $nombreEscuela = $fila['nombre'];
                ?>
                <option value="<?php echo $idEscuela; ?>"><?=$nombreEscuela?></option>
                <?php
                }
                $conn->close();
                ?>
            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <button name="filtrar" type="submit" class="btn btn-success">FILTRAR</button>
            </div>
        </div>
    </form>
  </div>
</div>

<div class="container">
  <br>
  <h4 class="text-center">Escriba el nombre del alumno</h4>
  <center>
      <input id="search" type="text" size="50" style="text-align:center;" placeholder="Escriba aquí">
  </center>
  <br>
  <div class="row justify-content-center">
    <div class="row my-12 justify-content-center">
        <div class="col-sm-7">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_registrar_alumno.php'">Nuevo alumno</button>
        </div>
        <div class="col-sm-5">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_dashboard.php'">Cancelar</button>
        </div>
    </div>
  </div>
  <br>
  <div class="row justify-content-center">
    <div class="col-md-10">
        <table id="houdini" class="table table-striped table-dark table-sm table-bordered">
          <thead>
            <th scope="col">Alumno</th>
            <th scope="col">Escuela</th>
            <th scope="col">Grado</th>
            <th scope="col">Grupo</th>
          </thead>
          <tbody id="filter"> 
            <?php
            include '../config/Conn.php';
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
            JOIN Localidad as l
            on l.idLocalidad = e.idLocalidad
            LEFT JOIN Asesor as ase
            ON t.idAsesor = ase.idAsesor
            $where
            ORDER BY Alumno ASC";

            $resultado = $conn->query($query);

            if (!$resultado) {
              echo "ERROR: " . $conn->error;
            }
            if (!$resultado->fetch_array()) {
                echo "<tr><td colspan='7'>NO SE ENCONTRÓ EL ALUMNO</td></tr>";
            } else {
            $resultado->data_seek(0);
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td data-href="admin_datos_alumno.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
                    <td class="align-middle"><?php echo $fila['Escuela']; ?></td>
                    <td class="align-middle"><?php echo $fila['Grado']; ?></td>
                    <td class="align-middle"><?php echo $fila['Grupo']; ?></td>
                </tr>
            <?php
                }
            }
            $conn->close();
            ?>
          </tbody> 
        </table> 
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
            window.location.href = this.dataset.href + "?idAlumno=" + this.dataset.id;
        });
    });
</script>
</body>
</html>