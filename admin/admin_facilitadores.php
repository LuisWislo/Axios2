<?php include 'navbar_admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h5 class="display-4 text-center">FACILITADORES</h5>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <a role="button" href="registro_usuarios.php" class="btn btn-success">AÑADIR FACILITADOR</a>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-sm table-bordered">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Asesorias</th>
                    <th scope="col">Editar</th>
                </thead>
                <tbody>
                    <?php
                    include 'conexion_admin.php';

                    $resultado = $conn->query("SELECT * FROM Asesor");

                    $resultado->data_seek(0);
                    while ($fila = $resultado->fetch_assoc()) {
                        $nombreAsesor = $fila['nombre'];
                        $idAsesor = $fila['idAsesor'];
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $fila['idAsesor']; ?></td>
                            <td class="align-middle"><?php echo $fila['nombre']; ?></td>
                            <td class="align-middle"><?php echo $fila['correo']; ?></td>
                            <td class="align-middle"><a role="button" href="asesorias_facilitador.php?id=<?php echo $idAsesor; ?>" class=" btn btn-primary">Historial</a></td>
                            <td class="align-middle"><a role="button" href="editar_facilitador.php?id=<?php echo $idAsesor; ?>" class=" btn btn-danger">Editar</a></td>
                        </tr>
                    <?php
                    }
                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>