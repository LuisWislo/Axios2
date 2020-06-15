<?php

  function getGrupoId($pEscuela, $pTurno, $pGrado, $pGrupo) {
    $db = $GLOBALS['db'];

    $sql = "SELECT Grupo.idGrupo 
      from Grupo 
      JOIN Grado on Grupo.idGrado = Grado.idGrado 
      JOIN Turno on Grado.idTurno = Turno.idTurno 
      JOIN Escuela on Turno.idEscuela = Escuela.idEscuela 
      WHERE Escuela.idEscuela = '$pEscuela'
      AND Turno.descripcion = '$pTurno' 
      AND Grado.numero = '$pGrado' 
      AND Grupo.grupo LIKE '_$pGrupo%'";
        
    $result = $db->query($sql) or die($conn->error);

    if ($result->num_rows == 0) {
      return 0;
    }

    return $result->fetch_row()[0];
  }

  function getAlumnos($grupoId) {

    $db = $GLOBALS['db'];

    $sql = "SELECT * FROM Alumno WHERE idGrupo = " . $grupoId . " ORDER BY idAlumno";
    $result = $db->query($sql) or die($conn->error);

    return $result;

  }

  // Escuelas
  $escuelas = $db->query("SELECT idEscuela, nombre FROM Escuela");

  // Datos de busqueda
  $busqueda = false;
  $datos = null;

  // Alumnos
  $resultAlumnosSuccess = false;
  
  if (isset($_GET['search'])) {
    $busqueda = true;
    if (!$_GET['escuela'] || !$_GET['turno'] || !$_GET['grado'] || !$_GET['grupo'] ) {
      $_SESSION['message'] = "Error. Por favor completa todos los campos.";
      $badRequest = true;
    } else {
      $pEscuela = $_GET['escuela'];
      $pTurno = $_GET['turno'] == 1 ? "Matutino" : "Vespertino";
      $pGrado = $_GET['grado'];
      $pGrupo = $_GET['grupo'];
      $datos = $db->getDatos($pEscuela, $pTurno, $pGrado, $pGrupo);
      $grupoId = getGrupoId($pEscuela,$pTurno, $pGrado, $pGrupo);
      $alumnos = getAlumnos($grupoId);
      if ($alumnos->num_rows > 0) {
        $resultAlumnosSuccess = true;
      }
    }
  }

  
?>