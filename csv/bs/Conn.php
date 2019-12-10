<?php

//  DATOS DEL SERVIDOR
$servername = "localhost";
$username = "facilit1_admin";
$password = "ALPQD3CbBmtUzjV";
$dbname = "facilit1_axios_dev_db";

//  CONEXION AL SERVIDOR
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}else{
    echo "Conexión exitosa\n";
    mysqli_select_db($conn, "facilit1_axios_dev_db");
    if ($result = mysqli_query($conn, "SELECT DATABASE()")) {
        $row = mysqli_fetch_row($result);
        printf("Default database is %s.\n", $row[0]);
        mysqli_free_result($result);
    }else{
        echo "Error al conectarse a la base de datos";
    }
}

$json = file_get_contents('php://input');
$data = json_decode($json,true);

//$idGrupo = parseInt($data[0],10);
/*$noLista = $data[1][0];
$apellido = $data[1][1];
$nombre = $data[1][2];

$assql = "INSERT INTO Alumno (noLista, nombre, apellido, idGrupo)
        VALUES ('$noLista','$nombre','$apellido','3')";

    if ($conn->query($assql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
*/
$idGrupo = $data[0];

for ($i = 1; $i <count($data); $i++) {
    $noLista = $data[$i][0];
    $apellido = $data[$i][1];
    $nombre = $data[$i][2];

    $assql = "INSERT INTO Alumno (noLista, nombre, apellido, idGrupo)
        VALUES ('$noLista','$nombre','$apellido','$idGrupo')";

    if ($conn->query($assql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

/*if ($result = $mysqli->query("SELECT * FROM Alumno")) {
    printf("Select returned %d rows.\n", $result->num_rows);
    echo "DID IT!";
    $result->close();
}*/

function console_log( $data ){
    echo '<p>';
    echo 'into the unknown';
    echo '</p>';
  }

?>
