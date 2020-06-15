<?php include 'navbar_admin.php'; 
$idEscuela = (int)$_GET['idEscuela']
?>

<?php

$oldNombre = "";
$oldNumero = "";
$oldTurno = "";
$oldLocalidad = "";

include '../config/Conn.php';
    $query = "SELECT e.nombre as Nombre, e.numero as Numero,
    e.turno as Turno, e.idLocalidad as Localidad
    FROM Escuela as e
    WHERE e.idEscuela = $idEscuela";
    $resultado = $conn->query($query);
    if ($resultado) {
        $resultado->data_seek(0);
        $origin = $resultado->fetch_assoc();

        $oldNombre = $origin['Nombre'];
        $oldNumero = $origin['Numero'];
        $oldTurno = $origin['Turno'];
        $oldLocalidad = $origin['Localidad'];
    } else {
      $message = "Error: " . $query . "<br>" . $conn->error;
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    $conn->close();
?>

<?php

if (isset($_POST['subir'])) {
  $nombre = $_POST['nombre'];
  $numero = $_POST['numero'];
  $turno = $_POST['turno'];
  $localidad = $_POST['localidad'];
  $noChanges = 0;

  if($nombre === $oldNombre || $nombre === "") {
    $nombre = $oldNombre;
    $noChanges++;
  }

  if($numero === $oldNumero || $numero === "") {
    $numero = $oldNumero;
    $noChanges++;
  }
  
  if($turno === $oldTurno || $turno === "") {
    $turno = $oldTurno;
    $noChanges++;
  }

  if($localidad === $oldLocalidad || $localidad === "") {
    $localidad = $oldLocalidad;
    $noChanges++;
  }

  if($noChanges == 4) {
    $message = "No se realizaron cambios a los datos de la escuela";
    echo "<script type='text/javascript'>alert('$message');</script>";
  } else {
    include '../config/Conn.php';
    $query = "UPDATE Escuela SET nombre='" . $nombre . "', numero=" . $numero . ", turno='" . $turno . "', idLocalidad=" . $localidad . " WHERE idEscuela = $idEscuela";
    if ($conn->query($query) === TRUE) {
        $message = "Cambios guardados con éxito";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
      $message = "Error: " . $query . "<br>" . $conn->error;
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    $conn->close();
  }
}
?>

  <div class="container">
  <?php
    include '../config/Conn.php';
    $query = "SELECT e.nombre as Nombre, e.numero as Numero,
    e.turno as Turno, e.idLocalidad as idLocalidad, l.nombre as NLocalidad
    FROM Escuela as e JOIN Localidad as l
    ON e.idLocalidad = l.idLocalidad
    WHERE e.idEscuela = $idEscuela";
    $resultado = $conn->query($query);
    if ($resultado) {
    $resultado->data_seek(0);
    $origin = $resultado->fetch_assoc();
    $rNombre = str_replace('"', "&quot;", $origin['Nombre']);
  ?>
  <h4 class="display-4 text-center">Datos de la escuela:</h4>
  <br>
  <h4 class="text-center"><?php echo $origin['Nombre']; ?></h4>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <form method="post" action="" id="insertForm" onsubmit="return validateForm()">
        <div class="row my-4">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <label for="input-nombre">Nombre</label>
            <input type="input-nombre" class="form-control" name="nombre" placeholder="<?php echo $rNombre; ?>">
            <label for="input-numero">Número</label>
            <input type="input-numero" class="form-control" name="numero" placeholder="<?php echo $origin['Numero']; ?>">
            <label for="input-turno">Turno</label>
            <input type="input-turno" class="form-control" name="turno" placeholder="<?php echo $origin['Turno']; ?>">
            <label for="input-localidad">Localidad</label>
            <select id="localidad" class="form-control" name="localidad">
                <option value="" selected="selected"><?php echo $origin['NLocalidad']; ?></option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT idLocalidad, nombre FROM Localidad");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                    $localidades = $fila['nombre'];
                    $idLocalidad = $fila['idLocalidad'];
                    ?>
                    <option value="<?php echo $idLocalidad; ?>"><?php echo $localidades; ?></option>
                    <?php
                }
                $conn->close();
                ?>
            </select>
          </div>
        </div>
        </form>
            <?php
  } else {
    $message = "Error: " . $query . "<br>" . $conn->error;
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
              $conn->close();
              ?>
        <div class="row my-4 justify-content-center">
          <div class="col-sm-3">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase" name="subir" form="insertForm">Aceptar cambios</button>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_sedes.php'">Cancelar</button>
          </div>
        </div>
    </div>
  </div>
</body>
</html>