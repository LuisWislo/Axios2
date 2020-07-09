<?php

class Asesor {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function login($email, $pass) {

    $this->db->query('SELECT * FROM Asesor WHERE correo = :correo AND `password` = PASSWORD(:pass)');

    // Bind params
    $this->db->bind(':correo', $email);
    $this->db->bind(':pass', $pass);

    // Execute
    return $this->db->single();
  }

  public function getAsesores() {
    $this->db->query("SELECT * FROM Asesor");
    
    return $this->db->resultSet();
  }

  public function getAsesorByEmail($email) {
    $this->db->query('SELECT * FROM Asesor WHERE correo = :email');

    $this->db->bind(':email', $email);

    return $this->db->single();
  }
}