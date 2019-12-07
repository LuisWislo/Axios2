<?php

class Database {

  // DB parameters
  private $host = 'localhost';
  private $dbname = 'facilit1_axios_dev_db_test';
  private $username = 'root';
  private $password = '';
  private $conn;

  // DB connect
  public function conectarse() {
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8',  
      $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;

  }

}

// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "facilit1_axios_dev_db_test";

// try {
//   $con = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
// } 
// catch (PDOException $exception) {
//   echo "Connection error: " . $exception->getMessage();
// }

?>