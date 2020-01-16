SELECT 
    asesoria.idAsesoria AS Asesoria 
    , alumno.idAlumno AS id 
    , CONCAT(alumno.nombre,' ',alumno.apellido) AS Alumno
    , asesor.nombre AS Asesor
    , DATE_FORMAT(asesoria.fecha, '%d-%m-%Y') AS Fecha 
    , motivo.motivo AS Motivo
    , integrantes.descripcion AS Dinamica 
    , asesoria.observaciones AS Observaciones
FROM asesoria 
JOIN alumno on alumno.idAlumno = asesoria.idAlumno 
JOIN asesor on asesor.idAsesor = asesoria.idAsesor 
JOIN motivo on motivo.idMotivo = asesoria.idMotivo 
JOIN integrantes on integrantes.idIntegrantes = asesoria.idIntegrantes
-- ORDER BY asesoria.idAsesoria DESC
-- LIMIT 5