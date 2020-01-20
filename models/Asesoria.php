<?php
class Asesoria {
  // From DB
  private $conn;

  // Asesoria Properties
  public $idAsesoria;
  public $idAlumno;
  public $alumno;
  public $idFacilitador;
  public $facilitador;
  public $fecha;
  public $motivo;
  public $dinamica;
  public $observaciones;

  public $idAsesor;
  public $idMotivo;
  public $idIntegrantes;

  // Constructor with db: a method that runs automatically whenever we instantiate
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // leer todas las asesorias de admin
  public function adminReadAll();

  public function adminReadLastest();

  public function facilitadorReadAll();

  public function create();
}
