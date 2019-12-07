<?php

$q = intval($_GET['q']);

$servername = "localhost";
$username = "facilit1_admin";
$password = "ALPQD3CbBmtUzjV";
$dbname = "facilit1_axios_dev_db";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$sql = "SELECT * FROM Alumno WHERE CONCAT(nombre,' ', apellido) LIKE ''".$q."%'";
$result =  mysqli_query($con, $sql);



?>