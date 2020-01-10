-- todos los alumnos de un asesor que han tomado al menos una asesoria
-- utilizamos el id de turno asociado al asesor
DELIMITER //


CREATE PROCEDURE MostrarAlumnosEnAsesoriaDeAsesor (IN id INT) 
BEGIN 
  SELECT 
    alumno.idAlumno,
    alumno.noLista,
    CONCAT(alumno.nombre, " ", alumno.apellido) as "nombre completo",
    grup.grupo,
    t.tipo as turno,
    aseso.fecha as "fecha de asesoria",
    mot.motivo
  FROM
    Alumno alumno
  JOIN
    Asesoria aseso ON aseso.idAlumno = alumno.idAlumno
  JOIN
    Motivo mot ON mot.idMotivo = aseso.idMotivo
  JOIN 
    Grupo grup ON grup.idGrupo = alumno.idGrupo
  JOIN
    Grado grad ON grad.idGrado = grup.idGrado
  JOIN
    Turno t ON t.idTurno = grad.idTurno
  WHERE
    t.idTurno = id;
END //

DELIMITER ;