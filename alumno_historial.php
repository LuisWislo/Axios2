<style>
    td[data-href] {
        cursor: pointer;  
    }
    td[data-href]:hover {
        background-color: #33a652;
    }
</style> 


<?php
include 'asesor_navbar.php';

$idAsesor = (int)$_GET['idAsesor'];
include 'config/Conn.php';
$queryId = "SELECT correo FROM Asesor WHERE idAsesor = '$idAsesor'";
$resultadoId = $conn->query($queryId);
$resultadoId->data_seek(0);
$filaId = $resultadoId->fetch_assoc();
$mail = $filaId['correo'];
$conn->close();

$where = "";
$idAlumno = (int)$_GET['idAlumno'];
$mes = $_POST['mes'];

if(isset($_POST['filtrar'])){
    if(!empty($_POST['mes'])){
        
         $where = "and MONTH(Asesores.fecha) = " . $mes . "";
    } else {
        $where = "";
    }
}

?>

<div class="container">
    <div class="row text-center">
        <?php
        include 'config/Conn.php';
        $query = "SELECT a.idAlumno AS id, CONCAT(a.nombre,' ', a.apellido) AS Alumno
        FROM Alumno as a
        WHERE a.idAlumno = $idAlumno";
        $resultado = $conn->query($query);
        if ($resultado) {
          $resultado->data_seek(0);
          $fila = $resultado->fetch_assoc();
        
        ?>
          <h4>HISTORIAL DE ASESORIAS DE: &nbsp;</h4>
          <br>
          <h4><?php echo $fila['Alumno']; ?></h4>
          <br>
          <br>
   
        <?php
        }
        $conn->close();
        ?>
        </div>
    <div class="row">
        <form method="POST">
            
            <div class="row">
                <div class="col-sm-12">
                    <h5>FILTROS</h5>
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
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Observaciones</th>
                </thead>
                <tbody id="pagination">
                    <?php
                    include 'Conn.php';
                    $query = "SELECT Asesoria.idAsesoria AS Asesoria, Asesoria.fecha AS Fecha,
                            Asesoria.idMotivo AS Motivo, Asesoria.observaciones AS Observaciones
                            FROM Asesoria LEFT JOIN Motivo
                            ON Asesoria.idMotivo = Motivo.idMotivo
                            WHERE Asesoria.idAlumno = $idAlumno
                            $where
                            ORDER BY Asesoria.fecha DESC";
                    $resultado = $conn->query($query);

                    $resultado->data_seek(0);
                    while ($fila = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $fila['Fecha']; ?></td>
                            <td class="align-middle"><?php echo $fila['Motivo']; ?></td>
                            <td class="align-middle"><?php echo $fila['Observaciones']; ?></td>
                        </tr>
                    <?php
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
            <button class="btn-b purple-gradient btn-block p-3" onclick="window.location.href='asesor_historial.php?id=<?php echo $idAsesor; ?>'">Regresar</button><br>
        </div>
    </div>
</div>

<script src="paginacion/bootstrap-table-pagination.js"></script>
<script src="paginacion/pagination.js"></script>

</body>
</html>