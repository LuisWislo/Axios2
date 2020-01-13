-- eliminar un grupo de un grado

DELIMITER //


CREATE PROCEDURE EliminarGrupo (IN id INT) 
BEGIN 
    DELETE FROM Alumno
    WHERE idGrupo = id;

    DELETE FROM Grupo
    WHERE idGrupo = id;

END //

DELIMITER ;