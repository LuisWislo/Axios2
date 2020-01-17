<?php include 'asesor_navbar.php';
    $where = "";
    $idAsesor = (int)$_GET['idAsesor'];
    $idAlumno = (int)$_GET['idAlumno'];
    include 'Conn.php';
    $queryId = "SELECT correo FROM Asesor WHERE idAsesor = '$idAsesor'";
    $resultadoId = $conn->query($queryId);
    $resultadoId->data_seek(0);
    $filaId = $resultadoId->fetch_assoc();
    $mail = $filaId['correo'];
    $conn->close();
?>

  <br>
  <div class="container">
  <h4 class="display-4 text-center">Asesoria cargada con éxito</h4>
  <br>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="row">
            <button class="btn-b blue-gradient btn-block p-3" onclick="window.location.href='asesor_dashboard.php?inputMail=<?php echo $usuario; ?>'">Regresar al menu principal</button><br>
        </div>
      </div>
    </div>
  </div>
</body>
</html>