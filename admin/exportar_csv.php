<?php
  if (isset($_POST['exportar'])) {
    include "../config/Conn.php";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="datos.csv"');
    $output = fopen('php://output', 'wb');
    fputcsv($output, array("Asesoria No.", "ID Alumno", "Nombre", "idAsesor", "Asesor", "Fecha", "Motivo", "Dinamica", "Observaciones"));
    $query = 
    "SELECT 
        asesoria.idAsesoria AS idAsesoria 
        , alumno.idAlumno AS id 
        , CONCAT(alumno.nombre,' ',alumno.apellido) AS Alumno
        , asesor.idAsesor AS idAsesor
        , asesor.nombre AS Asesor
        , DATE_FORMAT(asesoria.fecha, '%d-%m-%Y') AS Fecha 
        , motivo.motivo AS Motivo
        , integrantes.descripcion AS Dinamica 
        , asesoria.observaciones AS Observaciones
    FROM asesoria 
    JOIN alumno on alumno.idAlumno = asesoria.idAlumno 
    JOIN asesor on asesor.idAsesor = asesoria.idAsesor 
    JOIN motivo on motivo.idMotivo = asesoria.idMotivo 
    JOIN integrantes on integrantes.idIntegrantes = asesoria.idIntegrantes " . 
    $_POST['where'] .
    " ORDER BY asesoria.idAsesoria DESC";

    $result = $conn->query($query);

    if ($result) {
      while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
      }
    }

    fclose($output);
  }
?>