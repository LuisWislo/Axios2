DELIMITER //


CREATE PROCEDURE EliminarListasAsesor (IN id INT) 
BEGIN 
    START TRANSACTION;
    DELETE
    FROM Alumno
    WHERE idGrupo IN (SELECT idGrupo 
        FROM Grupo grup 
        JOIN Grado grad ON grad.idGrado = grup.idGrado
        JOIN Turno t ON t.idTurno = grad.idTurno
        JOIN Asesor a ON a.idAsesor = t.idAsesor
        WHERE a.idAsesor = 5
    );

    SELECT * FROM Alumno
    WHERE idGrupo IN (SELECT idGrupo 
        FROM Grupo grup 
        JOIN Grado grad ON grad.idGrado = grup.idGrado
        JOIN Turno t ON t.idTurno = grad.idTurno
        JOIN Asesor a ON a.idAsesor = t.idAsesor
        WHERE a.idAsesor = 5
    );

    SELECT * FROM Alumno;

END //

DELIMITER ;