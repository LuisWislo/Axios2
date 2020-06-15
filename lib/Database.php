<?php
// instance of db
class Database {
    private $conn;

    //  DATOS DEL SERVIDOR
    // private $servername = "localhost";
    // private $username = "facilit1_admin";
    // private $password = "ALPQD3CbBmtUzjV";
    // private $database = "facilit1_axios_dev_db";

    // PRUEBAS EN XAMPP
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "axios";

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database) or 
            die("Conexion fallida: " . $this->conn->connect_error);
    }

    public function query($query) {

        return $this->conn->query($query);
    }

    // Get all alumnos
    public function getAllAlumnos($grupoId) {
        $sql = "SELECT * FROM Alumno WHERE idGrupo = " . $grupoId . " ORDER BY idAlumno";
        $result = $this->conn->query($sql) or die($this->conn->error);

        return $result;
    }

    // Get escuela name by id
    public function getEscuela($idEscuela) {
        $sql = "SELECT nombre FROM Escuela WHERE idEscuela = $idEscuela";
        $result = $this->conn->query($sql) or die($this->conn->error);
        return $result->fetch_assoc()['nombre'];
    }

    // Get information about student group
    public function getDatos($pEscuela, $pTurno, $pGrado, $pGrupo) {
        $sql = "SELECT 
              grup.grupo
              , a.nombre
              , e.nombre as nombreEscuela
              , t.tipo
              , t.descripcion
              , e.numero
              , l.nombre as sede
            FROM Grupo grup 
              JOIN Grado grad on grad.idGrado = grup.idGrado 
              JOIN Turno t on t.idTurno = grad.idTurno 
              JOIN Asesor a on a.idAsesor = t.idAsesor 
              JOIN Escuela e on e.idEscuela = t.idEscuela
              JOIN Localidad l on l.idLocalidad = e.idLocalidad
            WHERE e.idEscuela = '$pEscuela'
            AND t.descripcion = '$pTurno'
            AND grad.numero = '$pGrado'
            AND grup.grupo LIKE '_$pGrupo%' " ;
        
        $result = $this->conn->query($sql) or die($this->conn->error);
        return $result;
    }
    
    // Get grado Id
    public function getGradoId($pEscuela, $pTurno, $pGrado) {
        $sql = "SELECT idGrado FROM Grado
            JOIN Turno ON Grado.idTurno = Turno.idTurno
            JOIN Escuela ON Turno.idEscuela = Escuela.idEscuela
            WHERE Grado.numero = $pGrado 
            AND Turno.descripcion = '$pTurno'
            AND Escuela.idEscuela = $pEscuela
        ";
        echo $sql;
        $result = $this->conn->query($sql);
        return $result->fetch_array()[0];

    }
    
    // Insert group in grado
    public function insertGrado($gradoNombre, $idGrado) {
        
        $sql = "INSERT INTO Grupo(grupo, idGrado) VALUES ('$gradoNombre', $idGrado)";
        echo $sql;
        
        $result = $this->conn->query($sql);
        return $result;
    }

    public function close() {
        $this->conn->close();
    }
}