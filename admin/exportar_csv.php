<?php
  if (isset($_POST['exportar'])) {
    $where = $_POST['where'];
    include "../config/Conn.php";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="datos.csv"');
    $output = fopen('php://output', 'wb');
    fputcsv($output, array("Asesoria No.", "ID Alumno", "Nombre", "idAsesor", "Asesor", "Fecha", "Motivo", "Dinamica", "Observaciones"));
    $query = 
    "SELECT 
        Asesoria.idAsesoria AS idAsesoria 
        , Alumno.idAlumno AS id 
        , CONCAT(Alumno.nombre,' ',Alumno.apellido) AS Alumno
        , Asesor.idAsesor AS idAsesor
        , Asesor.nombre AS Asesor
        , DATE_FORMAT(Asesoria.fecha, '%d-%m-%Y') AS Fecha 
        , Motivo.motivo AS Motivo
        , Integrantes.descripcion AS Dinamica 
        , Asesoria.observaciones AS Observaciones
    FROM Asesoria 
    JOIN Alumno on Alumno.idAlumno = Asesoria.idAlumno 
    JOIN Asesor on Asesor.idAsesor = Asesoria.idAsesor 
    JOIN Motivo on Motivo.idMotivo = Asesoria.idMotivo 
    JOIN Integrantes on Integrantes.idIntegrantes = Asesoria.idIntegrantes
    $where
    ORDER BY Asesoria.idAsesoria DESC";

    $result = $conn->query($query);

    if ($result) {
      while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
      }
    }

    fclose($output);
  }
