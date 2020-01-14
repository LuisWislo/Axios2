CREATE DATABASE facilit1_axios_dev_db
USE facilit1_axios_dev_db

CREATE TABLE Localidad (
  idLocalidad INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100),
  PRIMARY KEY (idLocalidad)
);

CREATE TABLE Escuela (
  idEscuela INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100),
  numero INT,
  turno CHAR,
  idLocalidad INT,
  PRIMARY KEY (idEscuela),
  FOREIGN KEY (idLocalidad) REFERENCES Localidad(idLocalidad)
);

CREATE TABLE Asesor (
  idAsesor INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100),
  correo VARCHAR(100),
  contra VARCHAR(100),
  PRIMARY KEY (idAsesor)
);

CREATE TABLE Turno (
  idTurno INT NOT NULL AUTO_INCREMENT,
  tipo CHAR,
  descripcion VARCHAR(50),
  idEscuela INT,
  idAsesor INT,
  PRIMARY KEY (idTurno),
  FOREIGN KEY (idEscuela) REFERENCES Escuela (idEscuela),
  FOREIGN KEY (idAsesor) REFERENCES Asesor (idAsesor)
);


CREATE TABLE Grado (
  idGrado INT NOT NULL AUTO_INCREMENT,
  numero INT,
  idTurno INT,
  PRIMARY KEY (idGrado),
  FOREIGN KEY (idTurno) REFERENCES Turno (idTurno)
);

CREATE TABLE Grupo (
  idGrupo INT NOT NULL AUTO_INCREMENT,
  grupo VARCHAR(2),
  idGrado INT,
  PRIMARY KEY(idGrupo),
  FOREIGN KEY (idGrado) REFERENCES Grado (idGrado)
);

CREATE TABLE Alumno (
  idAlumno INT NOT NULL AUTO_INCREMENT,
  noLista INT,
  nombre VARCHAR(100),
  apellidos VARCHAR(100),
  idGrupo INT,
  PRIMARY KEY (idAlumno),
  FOREIGN KEY (idGrupo) REFERENCES Grupo (idGrupo)
);

CREATE TABLE TipoAsesoria(
  idTipoAsesoria INT NOT NULL AUTO_INCREMENT,
  tipoAsesoria VARCHAR(50),
  PRIMARY KEY (idTipoAsesoria)
);

CREATE TABLE MotivoAsesoria (
  idMotivo INT NOT NULL AUTO_INCREMENT,
  motivo VARCHAR(150),
  idTipoASesoria INT,
  PRIMARY KEY (idMotivo),
  FOREIGN KEY (idTipoAsesoria) REFERENCES TipoAsesoria (idTipoAsesoria)
);

CREATE TABLE Asesoria (
  idAsesoria INT NOT NULL AUTO_INCREMENT,
  fecha DATE,
  observacion VARCHAR(150),
  idAlumno INT,
  idAsesor INT,
  idMotivo INT,
  PRIMARY KEY (idAsesoria),
  FOREIGN KEY (idAlumno) REFERENCES Alumno (idAlumno),
  FOREIGN KEY (idAsesor) REFERENCES Asesor (idAsesor),
  FOREIGN KEY (idMotivo) REFERENCES MotivoAsesoria (idMotivo)
);




