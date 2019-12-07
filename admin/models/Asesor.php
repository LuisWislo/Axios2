<?php

class Asesor {

  // DB
  private $conn;
  private $table = 'asesor';

  // Propiedades
  public $id;
  public $nombre_asesor;
  // public $correo;
  public $turno_tipo;
  public $turno_desc;
  public $escuela;

  // Constructor
  public function __construct($db) {
    $this->conn = $db;
  }

  // Get Asesores
  public function read() {
    // Create query
    $query = 'SELECT 
          a.nombre as nombre_asesor,
          a.idAsesor,
          t.tipo as turno,
          t.descripcion as turno_desc,
          e.nombre as escuela
        FROM
          ' . $this->table . ' a
        JOIN 
          turno t ON a.idTurno = t.idTurno
        JOIN
          escuela e ON t.idEscuela = e.idEscuela
        ORDER BY
          a.nombre';
    
    // prepare statement
    $stmt = $this->conn->prepare($query);

    // execute
    $stmt->execute();

    return $stmt;

  }

  // get single post
  public function read_single() {
    
  }

}