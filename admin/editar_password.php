<?php include 'navbar_admin.php';
    $idUsuario = (int)$_GET['idUsuario'];
?>

<?php
if (isset($_POST['subir'])) {
    $newPassword = $_POST['newPass'];
    $newConPassword = $_POST['newConPass'];
    if($newPassword === "" || $newConPassword === "") {
        $message = "Por favor no dejes los campos vacios";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        if($newPassword === $newConPassword) {
            include '../config/Conn.php';
            $query = "UPDATE Asesor SET password = PASSWORD('$newPassword') WHERE Asesor.idAsesor = $idUsuario";
            if ($conn->query($query) === TRUE) {
            $message = "Cambios guardados con éxito";
            echo "<script type='text/javascript'>alert('$message');</script>";
        
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
        } else {
            $message = "Las contraseñas no coinciden";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <?php
        include '../config/Conn.php';
        $query = "SELECT ass.nombre AS Asesor
        FROM Asesor as ass
        WHERE ass.idAsesor = $idUsuario";
        $resultado = $conn->query($query);
        if ($resultado) {
          $resultado->data_seek(0);
          $fila = $resultado->fetch_assoc()
        ?>
          <br>
          <h4>Editando:&nbsp;<?php echo $fila['Asesor']; ?></h4>
          <br>
          <form method="post" action="" id="insertForm" onsubmit="return validateForm()">

          <div class="row my-4">
            <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <label for="input-nueva-contraseña">Nueva Contraseña</label>
                <input type="input-nueva-contraseña" class="form-control" name="newPass" placeholder="Nueva contraseña">
                <br>
                <label for="input-confirmar-contraseña">Confirmar Contraseña</label>
                <input type="input-confirmar-contraseña" class="form-control" name="newConPass" placeholder="Confirmar contraseña">
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