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

$assql = "INSERT INTO Alumno (idAlumno, nombre, apellido, idGrupo)
VALUES ('3','Dan','Schneider','1')";

if ($conn->query($assql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

/*if ($result = $mysqli->query("SELECT * FROM Alumno")) {
    printf("Select returned %d rows.\n", $result->num_rows);
    echo "DID IT!";
    $result->close();
}*/
?>