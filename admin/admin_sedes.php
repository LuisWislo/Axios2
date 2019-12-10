<?php include 'navbar_admin.php'; ?>

<div class="container text-center p-5">
    <h7>SEDES</h7>
    <div class="row">
        <?php
        include 'conexion_admin.php';

        $resultado = $conn->query("SELECT * FROM Localidad");
        $resultado->data_seek(0);
        while ($fila = $resultado->fetch_assoc()) {
            $nombreEscuela = $fila['nombre'];
            echo "<button class='btn-b blue-gradient p-3' style='width:30%;'>". $nombreEscuela . "</button>";
            /*
            echo "ESCUELAS <br>";
            $res2 = $conn->prepare(("SELECT * FROM Escuela WHERE idLocalidad = ? "));
            $res2->bind_param("s", $fila['idLocalidad']);
            $res2->execute();
            $datos = $res2->get_result();

            $res2->data_seek(0);
            while ($escuelas = $datos->fetch_assoc()) {
                echo "ID: " . $escuelas['idEscuela'] . "<br>";
                echo "NOMBRE: " . $escuelas['nombre'] . "<br>";
                echo "---------------------------------------------------------------------- <br>";
            }
            echo " ################################################# <br>";
            $res2->close();
            */
        }
        $conn->close();

        ?>

    </div>
</div>


<?php include 'admin_check.php'; ?>
</body>