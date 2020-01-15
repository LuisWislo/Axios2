<?php
include 'asesor_navbar.php';

$idAsesor = (int)$_GET['id'];
include 'config/Conn.php';
$queryId = "SELECT correo FROM Asesor WHERE idAsesor = '$idAsesor'";
$resultadoId = $conn->query($queryId);
$resultadoId->data_seek(0);
$filaId = $resultadoId->fetch_assoc();
$mail = $filaId['correo'];
$conn->close();

$where = "WHERE Asesores.idAsesor = $idAsesor";
// $asesor = $_POST['asesor'];
// $mes = $_POST['mes'];

if(isset($_POST['filtrar'])){
    if(!empty($_POST['mes'])){
         $where = "WHERE Asesores.idAsesor = $idAsesor AND MONTH(Asesores.fecha) = " . $mes . "";
    }else{
        $where = "WHERE Asesores.idAsesor = $idAsesor";
    }
}

?>
<div class="container">
    <div class="row">
        <form action="accion.php" method="POST">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4>FILTROS</h4>
                </div>
                
                <div class="col-sm-4">
                    
                    <select id="motivoAsesoria" class="form-control" name="mes">
                        <option value="0" selected>Mes</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <button name="filtrar" type="submit" class="btn btn-success">FILTRAR</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <h5>ASESORIAS</h5>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-sm table-bordered">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Observaciones</th>
                </thead>
                <tbody id="pagination">
                    <?php
                    include 'config/Conn.php';
                    $query = "SELECT Asesores.idAsesoria AS Asesoria, Alumno.idAlumno AS id, CONCAT(Alumno.nombre,' ', Alumno.apellidos) AS Alumno, 
                    Asesores.fecha AS Fecha, Asesores.Motivo AS Motivo, Asesores.observacion AS Observaciones
                    FROM (	
                        SELECT * FROM Asesor 
                        NATURAL JOIN (
                            SELECT *
                            FROM Motivo_Asesoria 
                            NATURAL JOIN Asesoria
                        ) as Motivos 
                    ) AS Asesores
                    INNER JOIN Alumno
                    ON Asesores.idAlumno = Alumno.idAlumno  
                    $where
                    ORDER BY Asesores.fecha DESC";
                    $resultado = $conn->query($query);
                    if(!$resultado) {
                        echo "ERROR: " . $conn->error;
                    }
                    if(!$resultado->fetch_array()){
                        echo "<tr><td colspan='5'>AUN NO HAY ASESORIAS REGISTRADAS</td></tr>";
                    }else{
                    $resultado->data_seek(0);
                    while ($fila = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $fila['Asesoria']; ?></td>
                            <td data-href="alumno_historial.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
                            <td class="align-middle"><?php echo $fila['Fecha']; ?></td>
                            <td class="align-middle"><?php echo $fila['Motivo']; ?></td>
                            <td class="align-middle"><?php echo $fila['Observaciones']; ?></td>
                        </tr>
                    <?php
                    }
                }
                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-12 text-center">
        <ul class="pagination pagination-lg pager" id="pagination_page"></ul>
        </div>

        <div class="row">
            <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='asesor_dashboard.php?inputMail=<?php echo $mail; ?>'">REGRESAR</button><br>
        </div>
    </div>
</div>
<script src="paginacion/bootstrap-table-pagination.js"></script>
<script src="paginacion/pagination.js"></script>

<script>
    $(document).ready(function () {
        $(document.body).on("click", "td[data-href]", function () {
            window.location.href = this.dataset.href + "?id="+ this.dataset.id;
        });
    });
</script>

</body>
</html>