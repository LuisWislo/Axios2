<?php
    include '../../config/Conn.php';

    $id = $_GET['id'];
    $query = "SELECT nombre, numero, turno FROM Escuela WHERE idEscuela=" . $id;

    $resultado = $conn->query($query);
    $resultado->data_seek(0);

    $escuela = $resultado->fetch_assoc();
    
    
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Escuela</title>
    <link rel="stylesheet" href="../sauce/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Editar Escuela</h2>
        <form method="post" class="form-group">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="nombre-escuela">Nombre de la escuela:</label>
                    <input id="nombre-escuela"type="text" name="nombre" class="form-control"
                        value="<?=$escuela['nombre']?>">
                </div>
                <div class="col-md-1">
                    <label for="numero-escuela">Número:</label>
                    <input id="numero-escuela"type="text" name="numero" class="form-control text-center"
                        value="<?=$escuela['numero']?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8">
                    Turno:
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="turno" value="M"
                            <?=($escuela['turno'] == 'M')?'checked':''?>>
                        <label class="form-check-label" for="turno">Matutino</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="turno" value="V"
                            <?=($escuela['turno'] == 'V')?'checked':''?>>
                        <label class="form-check-label" for="turno">Vespertino</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="turno" value="A"
                            <?=($escuela['turno'] == 'A')?'checked':''?>>
                        <label class="form-check-label" for="turno">Ambos</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <input type="submit" name="submitButton" class="btn btn-primary" value="Actualizar"></input>
            </div>
        </form>
        <?php 

        if (isset($_POST['submitButton'])) {
            $query = 'UPDATE Escuela SET nombre=\'' . $_POST['nombre'] . '\',numero=' . $_POST['numero']
            . ',turno=\'' . $_POST['turno'] . '\' WHERE idEscuela=' . $id;

            if($conn->query($query) == true) {
                echo "actualizado correctamente";
            }
            else {
                echo "ERROR: " . $conn->error;
            };
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>

