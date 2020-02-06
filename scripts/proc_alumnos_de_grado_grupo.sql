SELECT 
    A.noLista,
    A.nombre,
    A.apellido,
    grup.idGrupo,
    grup.grupo,
    t.tipo,
    ase.nombre,
    e.nombre,

    l.nombre

FROM Alumno A
JOIN Grupo grup on grup.idGrupo = A.idGrupo
JOIN Grado grad on grad.idGrado = grup.idGrado
JOIN Turno t on t.idTurno = grad.idTurno
JOIN Asesor ase on ase.idAsesor = t.idAsesor
JOIN Escuela e on e.idEscuela = t.idEscuela
JOIN Localidad l on l.idLocalidad = e.idLocalidad

WHERE e.numero = 25
    AND t.tipo = 'M'
    AND l.nombre LIKE "%San Miguel%"
    AND grup.grupo = "3A"


ORDER BY A.idAlumno