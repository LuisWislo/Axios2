<?php

class Asesor {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAsesores() {
        return $this->db->query("SELECT idAsesor, nombre FROM Asesor");  
        
    }
}