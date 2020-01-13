DELIMITER //


CREATE PROCEDURE AgregarGrupo () 
BEGIN 
    DELETE FROM Alumno
    WHERE idGrupo = id;

    DELETE FROM Grupo
    WHERE idGrupo = id;

END //

DELIMITER ;