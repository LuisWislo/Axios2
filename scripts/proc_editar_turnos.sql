-- editar (agregar o quitar) turnos por escuela

DELIMITER //


CREATE PROCEDURE ModificarTurnos (IN id INT, IN inNombre VARCHAR(100), IN inNumero INT, IN inTurno CHAR) 
BEGIN 
    UPDATE escuela
    SET 
        nombre = inNombre,
        numero = inNumero,
        turno = inTurno
    WHERE
        idEscuela = id;

END //

DELIMITER ;