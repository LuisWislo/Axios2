<?php

  class Escuela {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    // Get all escuelas
    public function getEscuelas() {
      $this->db->query('SELECT * FROM Escuela');

      $results = $this->db->resultSet();

      return $results;
    }

    // Get escuela name by id
    public function getEscuela($idEscuela) {
      $this->db->query('SELECT nombre FROM Escuela WHERE idEscuela = :idEscuela');

      // Bind value
      $this->db->bind(':idEscuela', $idEscuela);

      // Execute
      return $this->db->single();
      
    }
  }