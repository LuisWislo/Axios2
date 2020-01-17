SELECT 
    asesoria.idAsesoria AS idAsesoria 
    , alumno.idAlumno AS id 
    , CONCAT(alumno.nombre,' ',alumno.apellido) AS Alumno
    , asesor.idAsesor AS idAsesor
    , asesor.nombre AS Asesor
    , DATE_FORMAT(asesoria.fecha, '%d-%m-%Y') AS Fecha 
    , motivo.motivo AS Motivo
    , integrantes.descripcion AS Dinamica 
    , asesoria.observaciones AS Observaciones
    , escuela.nombre AS ESCUELA
    , localidad.nombre AS SEDE
FROM asesoria 
JOIN alumno on alumno.idAlumno = asesoria.idAlumno 
JOIN asesor on asesor.idAsesor = asesoria.idAsesor 
JOIN motivo on motivo.idMotivo = asesoria.idMotivo 
JOIN integrantes on integrantes.idIntegrantes = asesoria.idIntegrantes
JOIN turno on turno.idAsesor = asesor.idAsesor
JOIN escuela on escuela.idEscuela = turno.idEscuela
JOIN localidad on localidad.idLocalidad = escuela.idEscuela;
-- ORDER BY asesoria.idAsesoria DESC
-- LIMIT 5