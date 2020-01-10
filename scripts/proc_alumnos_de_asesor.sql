-- todos los alumnos de un asesor
-- utilizamos el id de turno asociado al asesor
DELIMITER //


CREATE PROCEDURE MostrarAlumnosDeAsesor (IN id INT) 
BEGIN 
  SELECT 
    a.idAlumno,
    a.noLista,
    CONCAT(a.nombre, " ", a.apellido) as "nombre completo",
    grup.grupo,
    t.tipo as turno
  FROM
    Alumno a
  JOIN 
    Grupo grup ON grup.idGrupo = a.idGrupo
  JOIN
    Grado grad ON grad.idGrado = grup.idGrado
  JOIN
    Turno t ON t.idTurno = grad.idTurno
  WHERE
    t.idTurno = id;
END //

DELIMITER ;