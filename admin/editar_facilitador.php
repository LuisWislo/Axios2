<?php include 'navbar_admin.php';
    $idAsesor = (int)$_GET['idAsesor'];
?>

<?php
if (isset($_POST['subir'])) {
  include '../config/Conn.php';
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $password = $_POST['pass'];
  $query = "UPDATE Asesor SET nombre = $nombre, correo = $correo, password = PASSWORD($password) WHERE Asesor.idAsesor = $idAsesor";
  if ($conn->query($query) === TRUE) {
    ob_start();
    $url = 'http://facilitadoresaxios.com/admin_facilitadores.php';

    while (ob_get_status()) {
      ob_end_clean();
    }
    header("Location: $url");
  } else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }

  $conn->close();
}
?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <?php
        include '../config/Conn.php';
        $query = "SELECT ass.nombre AS Asesor, ass.correo AS Correo, PASSWORD(ass.password) AS Pass,
        FROM Asesor as ass
        WHERE ass.idAsesor = $idAsesor";
        $resultado = $conn->query($query);
        if ($resultado) {
          $resultado->data_seek(0);
          $fila = $resultado->fetch_assoc()
        ?>
          <h1>Editando:</h1>
          <br>
          <h2><?php echo $fila['Asesor']; ?></h2>
          <br>
          <form method="post" action="" id="insertForm" onsubmit="return validateForm()">

          <div class="row my-4">
            <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <label for="input-nombre">Nombre</label>
                <input type="input-nombre" class="form-control" name="asesor" placeholder="<?php echo $fila['Asesor']; ?>">
                <label for="input-correo">Correo</label>
                <input type="input-correo" class="form-control" name="correo" placeholder="<?php echo $fila['Correo']; ?>" >
                <label for="input-contraseña">Contraseña</label>
                <input type="input-contraseña" class="form-control" name="pass" placeholder="<?php echo $fila['Pass']; ?>" >
              </div>
              <?php
        } else {
          echo "ERROR: " . $conn->error . "ON: \n";
          echo $query;
        }
              $conn->close();
              ?>
              <div class="col-sm-2"></div>
            </div>
          </form>
        
        
        <div class="row my-4 justify-content-center">
          <div class="col-sm-3">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase" name="subir" form="insertForm" >Aceptar</button>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_facilitadores.php'">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>