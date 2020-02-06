DELIMITER //


CREATE PROCEDURE EliminarLista (IN id INT, IN inNombre VARCHAR(100), IN inNumero INT, IN inTurno CHAR) 
BEGIN 
    DELETE FROM Asesoria
    WHERE idAlumno = ANY(SELECT idAlumno FROM Alumno WHERE idGrupo = id);

    DELETE FROM Alumno
    WHERE idGrupo = id;

END //

DELIMITER ;