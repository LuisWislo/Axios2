CREATE DATABASE facilit1_axios_dev_db_test
USE facilit1_axios_dev_db_test

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

CREATE TABLE Turno (
  idTurno INT NOT NULL AUTO_INCREMENT,
  tipo CHAR,
  descripcion VARCHAR(50),
  idEscuela INT,
  PRIMARY KEY (idTurno),
  FOREIGN KEY (idEscuela) REFERENCES Escuela (idEscuela)
);

CREATE TABLE Asesor (
  idAsesor INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100),
  correo VARCHAR(100),
  idTurno INT,
  PRIMARY KEY (idAsesor),
  FOREIGN KEY (idTurno) REFERENCES Turno(idTurno)
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




