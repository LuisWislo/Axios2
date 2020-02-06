

-- localidad
INSERT INTO Localidad(nombre) VALUES ('Zapopan');
INSERT INTO Localidad(nombre) VALUES ('San Juan de los Lagos');
INSERT INTO Localidad(nombre) VALUES ('San Miguel el Alto');

-- escuela
INSERT INTO Escuela(nombre, numero, turno, idLocalidad) VALUES 
('Mixta #5 "Lic. Juan Manuel Ruvalcaba De la Mora"', 5, 'M', 1),
('General #59 "Francisco Marquez"', 59, 'M', 1),
('General #67 "Juan José Arreola"', 67, 'M', 1),
('General #136 "Alma Rosa Padilla Rodriguez"', 136, 'M', 1),
('General Foránea #25', 25, 'A', 2),
('Técnica #48', 48, 'A', 2),
('Francisco Montes de Oca #122', 122, 'M', 2),
('Técnica #25', 25, 'A', 3),
('Foránea #77 "Juan de Dios Robledo"', 77, 'M', 3);

-- asesores


INSERT INTO Asesor (nombre, correo, contra) VALUES
('Pablo', '', ''),
('Viri', 'viriq@axios.com', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9'),
('Jona', '', ''),
('Mercedes', '', ''),
('Magaly', '', ''),
('Karol', '', ''),
('Yesenia', '', ''),
('Juan', '', ''),
('Isela', '', ''),
('Jessi', '', ''),
('Sandra', '', ''),
('Irma', '', '');

INSERT INTO Asesor (nombre, correo, contra) VALUES
('admin', 'admin@axios.com', '*BCDB46F9759BC3C7C2679D4E81145B53EE616059');

-- turnos
INSERT INTO Turno (tipo, descripcion, idEscuela, idAsesor) VALUES
('M', 'Matutino', 1, 1),
('M', 'Matutino', 2, 2),
('M', 'Matutino', 3, 3),
('M', 'Matutino', 4, 4),
('M', 'Matutino', 5, 5),
('V', 'Vespertino', 5, 6),
('M', 'Matutino', 6, 7),
('V', 'Vespertino', 6, 8),
('M', 'Matutino', 7, 9),
('M', 'Matutino', 8, 10),
('V', 'Vespertino', 8, 11),
('M', 'Matutino', 9, 12);

-- grados
INSERT INTO Grado (numero, idTurno) VALUES
(1, 1), (2, 1), (3, 1),
(1, 2), (2, 2), (3, 2),
(1, 3), (2, 3), (3, 3),
(1, 4), (2, 4), (3, 4),
(1, 5), (2, 5), (3, 5),
(1, 6), (2, 6), (3, 6),
(1, 7), (2, 7), (3, 7),
(1, 8), (2, 8), (3, 8),
(1, 9), (2, 9), (3, 9),
(1, 10), (2, 10), (3, 10),
(1, 11), (2, 11), (3, 11),
(1, 12), (2, 12), (3, 12);

-- grupos
INSERT INTO Grupo (grupo, idGrado) VALUES
-- pablo
('1A', 1), ('1B', 1), ('1C', 1), ('1D', 1),
('2A', 2), ('2B', 2), ('2C', 2), ('2D', 2),
('3A', 3), ('3B', 3), ('3C', 3), ('3D', 3),

-- viri
('1A', 4), ('1B', 4), ('1C', 4), ('1D', 4), ('1E', 4),
('2A', 5), ('2B', 5), ('2C', 5), ('2D', 5), ('2E', 5),
('3A', 6), ('3B', 6), ('3C', 6), ('3D', 6), ('3E', 6),

-- jona
('1A', 7), ('1B', 7), ('1C', 7), ('1D', 7),
('2A', 8), ('2B', 8), ('2C', 8), ('2D', 8),
('3A', 9), ('3B', 9), ('3C', 9), ('3D', 9),

-- mercedes
('1A', 10), ('1B', 10), ('1C', 10), ('1D', 10),
('2A', 11), ('2B', 11), ('2C', 11),
('3A', 12), ('3B', 12), ('3C', 12),

-- magaly
('1A', 13), ('1B', 13), ('1C', 13), ('1D', 13), ('1E', 13),
('2A', 14), ('2B', 14), ('2C', 14), ('2D', 14), ('2E', 14),
('3A', 15), ('3B', 15), ('3C', 15), ('3D', 15), ('3E', 15),

-- karol
('1A', 16), ('1B', 16), ('1C', 16), ('1D', 16),
('2A', 17), ('2B', 17), ('2C', 17), ('2D', 17),
('3A', 18), ('3B', 18), ('3C', 18), ('3D', 18),

-- yesenia
('1A', 19), ('1B', 19), ('1C', 19), ('1D', 19), ('1E', 19), ('1F', 19),
('2A', 20), ('2B', 20), ('2C', 20), ('2D', 20), ('2E', 20), ('2F', 20),
('3A', 21), ('3B', 21), ('3C', 21), ('3D', 21), ('3E', 21), ('3F', 21),

-- juan
('1A', 22), ('1B', 22), ('1C', 22), ('1D', 22), ('1E', 22), ('1F', 22),
('2A', 23), ('2B', 23), ('2C', 23), ('2D', 23), ('2E', 23), ('2F', 23),
('3A', 24), ('3B', 24), ('3C', 24), ('3D', 24), ('3E', 24), ('3F', 24),

-- isela
('1A', 25), ('1B', 25),
('2A', 26), ('2B', 26),
('3A', 27), ('3B', 27),

-- jessi
('1A', 28), ('1B', 28), ('1C', 28), ('1D', 28), ('1E', 28),
('2A', 29), ('2B', 29), ('2C', 29), ('2D', 29), ('2E', 29),
('3A', 30), ('3B', 30), ('3C', 30), ('3D', 30), ('3E', 30),

-- sandra
('1A', 31), ('1B', 31), ('1C', 31), ('1D', 31),
('2A', 32), ('2B', 32), ('2C', 32), ('2D', 32),
('3A', 33), ('3B', 33), ('3C', 33), ('3D', 33),

-- irma
('1A', 34), ('1B', 34),
('2', 35),
('3', 36);

--integrantes
INSERT INTO Integrantes (`descripcion`) VALUES
('Solo alumno'),
('Con padres');

-- tipo asesoria
INSERT INTO tipoasesoria (`tipoAsesoria`) VALUES
('Familiar'), 
('Académico'),
('Emocional'), 
('Relaciones Interpersonales'),
('Sexualidad');

-- motivo asesoria
INSERT INTO motivoasesoria (`motivo`, `idTipoAsesoria`) VALUES
('Separación o divorcio de padres', 1),
('Falta de comunicación', 1),
('Falta de atención, cuidado', 1),
('Maltrato, violencia familiar', 1),
('Pelea con hermanos', 1),
('Peleas entre padres', 1),
('Conflicto con papás', 1),
('Ausencia de padres (física, emocional)', 1),
('Desintegración familiar', 1),
('Adicción de un integrante  de la familia', 1),
('Actividades delictivas al interior de la familia', 1),
('Integrante víctima de un delito (secuestro, homicidio. Abuso o violación)', 1),
('Problemas económicos/alimenticios', 1),
('Falta de un espacio privado en hogar (hacinamiento)', 1),
('Rol familiar que no corresponde con la edad', 1),
('Padres sobreprotectores', 1),
('Hipersexualidad en la familia', 1),
('Enfermedad física o mental en algún familia', 1),
('Dinámica familiar (interacción, relaciones)', 1),
('Derivado por docentes', 2),
('Problemas de conducta', 2),
('Rendimiento escolar', 2),
('Proyecto de vida', 2),
('Deserción escolar', 2),
('Desinterés por el estudio', 2),
('Problemas en la relación alumno-docente', 2),
('Sobreexigencia académica', 2),
('Problemas de aprendizaje', 2),
('Problemas de autoestima', 3),
('Duelos', 3),
('Somatizaciones', 3),
('Trastornos alimenticios', 3),
('Estrés', 3),
('Ansiedad', 3),
('Falta de identificación de emociones', 3),
('Conflicto de indentidad adolescente', 3),
('Depresión', 3),
('Tristeza', 3),
('Sospecha de trastorno de personalidad o psicótico', 3),
('Crisis emocionales', 3),
('Autolesiones', 3),
('Consumo de sustancias', 3),
('Ideación suicida/riesgo suicida', 3),
('Intento suicida', 3),
('Falla en el control de impulsos', 3),
('Problemas en el noviazgo', 4),
('Problemas con amigos', 4),
('Dificultades de adaptación', 4),
('Aislamiento', 4),
('Peleas a golpes dentro y/o fuera de la escuela', 4),
('Violencia: noviazgo, entre iguales', 4),
('Barrios, pandillas (grupos de pertenencia)', 4),
('Acoso escolar', 4),
('Embarazo', 5),
('Abuso sexual', 5),
('Acoso sexual', 5),
('Orientación general sobre sexualidad', 5),
('Vida sexual activa', 5),
('Hipersexualidad', 5),
('Dudas acerca del inicio de vida sexual activa', 5),
('Identidad sexual', 5);







