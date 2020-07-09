<?php

  class Sede {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getSedes() {
      $this->db->query('SELECT * FROM Localidad');

      return $this->db->resultSet();
    }

  }