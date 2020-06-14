<style>
  td[data-href] {
    cursor: pointer;
  }

  td[data-href]:hover {
    background-color: #33a652;
  }
</style>

<?php
include 'navbar_admin.php';

$where = "WHERE TRUE";

$asesor = !empty($_POST['asesor']) ? $_POST['asesor'] : "";
$sede = !empty($_POST['sede']) ? $_POST['sede'] : "";

if (isset($_POST['filtrar'])) {
  if ($asesor) $where .= " AND Asesor.nombre = '" . $asesor . "' ";
  if ($sede) $where .= " AND Localidad.idLocalidad = " . $sede . " ";
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h5 class="display-4 text-center">Escuelas y Localidades </h5>
        </div>
    </div>
    <br>
  <br>
  <div class="row justify-content-center">
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
  <div class="row">
    <div class="table-responsive">
    <table class="table table-striped table-dark table-sm table-bordered" style="table-layout: fixed;">
        <thead>
          <th scope="col">Nombre</th>
          <th scope="col">Número</th>
          <th scope="col">Localidad</th>
        </thead>
        <tbody>
          <?php
          include '../config/Conn.php';
          $query =
            "SELECT Escuela.nombre as Escuela, Escuela.idEscuela as idEscuela,
            Escuela.numero as Numero, Escuela.idLocalidad as idSede, Localidad.nombre as Sede,
            Asesor.nombre as NAsesor
            FROM Escuela JOIN Localidad on Escuela.idLocalidad = Localidad.idLocalidad
            JOIN Turno on  Escuela.idEscuela = Turno.idEscuela
            JOIN Asesor on Turno.idAsesor = Asesor.idAsesor
            $where
            ORDER BY Escuela.nombre ASC";

          $resultado = $conn->query($query);
          if (!$resultado) {
            echo "ERROR: " . $conn->error;
          }
          if (!$resultado->fetch_array()) {
            echo "<tr><td colspan='7'>NO HAY ESCUELAS REGISTRADAS</td></tr>";
          } else {

            $resultado->data_seek(0);

            while ($fila = $resultado->fetch_assoc()) {
          ?>
              <tr>
                <td data-escuela="" data-href="admin_datos_escuela.php" data-id="<?php echo $fila['idEscuela']; ?>" class="align-middle text-truncate"><?php echo $fila['Escuela']; ?></td>
                <td class="align-middle text-truncate"><?php echo $fila['Numero']; ?></td>
                <td data-sede="" data-href="admin_datos_sede.php" data-id="<?php echo $fila['idSede']; ?>" class="align-middle text-truncate"><?php echo $fila['Sede']; ?></td>
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
<div class="row justify-content-center">
    <div class="row my-4">
        <div class="col-sm-4">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_registrar_escuela.php'">Nueva escuela</button>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_registrar_localidad.php'">Nueva Localidad</button>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_dashboard.php'">Cancelar</button>
        </div>
    </div>
  </div>
  <br>
</div>

<script>
    $(document).ready(function () {
        $(document.body).on("click", "td[data-escuela]", function () {
            window.location.href = this.dataset.href + "?idEscuela=" + this.dataset.id;
        });
        $(document.body).on("click", "td[data-sede]", function () {
            window.location.href = this.dataset.href + "?idSede=" + this.dataset.id;
        });
    });
</script>
</body>
</html>