<?php include 'navbar_admin.php'; 
$idSede = (int)$_GET['idSede']
?>

<?php

$oldNombre = "";

include '../config/Conn.php';
    $query = "SELECT l.nombre as Nombre
    FROM Localidad as l
    WHERE l.idLocalidad = $idSede";
    $resultado = $conn->query($query);
    if ($resultado) {
        $resultado->data_seek(0);
        $origin = $resultado->fetch_assoc();

        $oldNombre = $origin['Nombre'];
    } else {
      $message = "Error: " . $query . "<br>" . $conn->error;
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    $conn->close();
?>

<?php

if (isset($_POST['subir'])) {
  $nombre = $_POST['nombre'];
  $noChanges = 0;

  if($nombre === $oldNombre || $nombre === "") {
    $nombre = $oldNombre;
    $noChanges++;
  }

  if($noChanges == 1) {
    $message = "No se realizaron cambios a los datos de la localidad";
    echo "<script type='text/javascript'>alert('$message');</script>";
  } else {
    include '../config/Conn.php';
    $query = "UPDATE Localidad SET nombre='" . $nombre . "' WHERE idLocalidad = $idSede";
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
    $query = "SELECT l.nombre as Nombre
    FROM Localidad as l
    WHERE l.idLocalidad = $idSede";
    $resultado = $conn->query($query);
    if ($resultado) {
    $resultado->data_seek(0);
    $origin = $resultado->fetch_assoc();
    $rNombre = str_replace('"', "&quot;", $origin['Nombre']);
  ?>
  <h4 class="display-4 text-center">Datos de la localidad:</h4>
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