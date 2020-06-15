<?php include 'navbar_admin.php';?>

<?php
if (isset($_POST['subir'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $nolista = $_POST['nolista'];
    $escuela = $_POST['escuela'];
    $grado = $_POST['grado'];
    $grupo = $_POST['grupo'];
    $turno = $_POST['turno'];
    $asesor = $_POST['asesor'];

    include '../config/Conn.php';
    $query = "SELECT e.nombre AS Escuela, ga.numero AS Grado,
    gu.grupo AS Grupo, gu.idGrupo AS idGrupo, ase.nombre AS NAsesor, t.descripcion AS Turno
    FROM Grupo as gu JOIN Grado as ga
    ON gu.idGrado = ga.idGrado
    JOIN Turno as t
    ON ga.idTurno = t.idTurno
    JOIN Escuela as e
    ON t.idEscuela = e.idEscuela
    JOIN Localidad as l
    on l.idLocalidad = e.idLocalidad
    JOIN Asesor as ase
    ON t.idAsesor = ase.idAsesor
    WHERE gu.grupo = '" . $grupo . "' AND ga.numero = $grado AND t.descripcion = '" . $turno . "'
    AND e.idEscuela = $escuela  AND ase.nombre = '" . $asesor . "'";
    $resultado = $conn->query($query);
    if(!$resultado->fetch_array()) {
        $message = "Los datos ingresados no son válidos. Por favor ingresa una combinación permitida.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else if ($resultado) {
        $resultado->data_seek(0);
        $origin = $resultado->fetch_assoc();
        $idGrupo = $origin['idGrupo'];
        $query = "INSERT INTO Alumno (noLista, nombre, apellido, idGrupo)
        VALUES ($nolista, '" . $nombres . "', '" . $apellidos . "', $idGrupo)";
        if ($conn->query($query) === TRUE) {
            $message = "Cambios guardados con éxito";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script type='text/javascript'> document.location = 'admin_alumnos.php'; </script>";
        } else {
            $message = "Error: " . $query . "<br>" . $conn->error;
        echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $message = "Error: " . $query . "<br>" . $conn->error;
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    $conn->close();
}
?>

  <div class="container">
  <h4 class="display-4 text-center">Datos del nuevo alumno:</h4>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <form method="post" action="" id="insertForm" onsubmit="return validateForm()">
        <div class="row my-4">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <label for="input-nombre">Nombre(s)</label>
            <input type="input-nombre" class="form-control" name="nombres" placeholder="Nombres">
            <label for="input-apellidos">Apellido(s)</label>
            <input type="input-apellidos" class="form-control" name="apellidos" placeholder="Apellidos">
            <label for="input-nlista">Número de Lista</label>
            <input type="input-nlista" class="form-control" name="nolista" placeholder="Número de Lista">
            <label for="input-escuela">Escuela</label>
            <select id="escuela" class="form-control" name="escuela">
                <option value="" selected></option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT idEscuela, nombre FROM Escuela");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                    $escuelas = $fila['nombre'];
                    $idEscuela = $fila['idEscuela'];
                    ?>
                    <option value="<?php echo $idEscuela; ?>"><?php echo $escuelas; ?></option>
                    <?php
                }
                $conn->close();
                ?>
            </select>
            <label for="input-grado">Grado</label>
            <select id="grado" class="form-control" name="grado">
                <option value="" selected></option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT DISTINCT(numero) AS Numero FROM Grado");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                    $grado = $fila['Numero'];
                    ?>
                    <option value="<?php echo $grado; ?>"><?php echo $grado; ?></option>
                    <?php
                }
                $conn->close();
                ?>
            </select>
            <label for="input-grupo">Grupo</label>
            <select id="grupo" class="form-control" name="grupo">
                <option value="" selected></option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT DISTINCT(grupo) AS grupos FROM Grupo");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                    $grupo = $fila['grupos'];
                    ?>
                    <option value="<?php echo $grupo; ?>"><?php echo $grupo; ?></option>
                    <?php
                }
                $conn->close();
                ?>
            </select>
            <label for="input-turno">Turno</label>
            <select id="turno" class="form-control" name="turno">
                <option value="" selected></option>
                <?php
                include '../config/Conn.php';
                $resultado = $conn->query("SELECT DISTINCT(descripcion) AS turno FROM Turno");
                $resultado->data_seek(0);
                while ($fila = $resultado->fetch_assoc()) {
                    $turno = $fila['turno'];
                    ?>
                    <option value="<?php echo $turno; ?>"><?php echo $turno; ?></option>
                    <?php
                }
                $conn->close();
                ?>
            </select>
            <label for="input-asesor">Facilitador</label>
            <select id="asesor" class="form-control" name="asesor">
                <option value="" selected></option>
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
        </div>
        </form>
        <div class="row my-4 justify-content-center">
          <div class="col-sm-3">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase" name="subir" form="insertForm">Crear alumno</button>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='admin_alumnos.php'">Cancelar</button>
          </div>
        </div>
    </div>
  </div>
</body>
</html>