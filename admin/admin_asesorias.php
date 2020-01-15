<style>
    td[data-href] {
        cursor: pointer;  
    }
    td[data-href]:hover {
        background-color: #33a652;
    }
</style> 

<?php
include 'navbar_admin.php';


$where = "";
$asesor = !empty($_POST['asesor']) ? $_POST['asesor'] : "";
$mes = !empty($_POST['mes']) ? $_POST['mes'] : "";
$semestre = !empty($_POST['semestre']) ? $_POST['semestre'] : "";
$anio = !empty($_POST['anio']) ? $_POST['anio'] : "";

if(isset($_POST['filtrar'])){
    if ($mes && $asesor) $where = "WHERE MONTH(Asesores.fecha) = " . $mes . " and Asesores.nombre = '". $asesor ."'";
    else if($mes){
        $where = "WHERE MONTH(Asesores.fecha) = ". $mes;
    }
    else if($asesor){
        $where = "WHERE Asesores.nombre = '". $asesor ."'";
    }

}


?>

<div class="container">
    <div class="row">
        <form method="POST">
            
            <div class="row mb-3">
                <div class="col-sm-12">
                    <h4>FILTROS</h4>
                </div>
                
                <div class="col-sm-4">
                    
                    <select id="tipoAsesoria" class="form-control" name="asesor">
                        <option value="0" selected>Asesor</option>
                        <?php
                        include '../config/Conn.php';
                        $resultado = $conn->query("SELECT nombre FROM Asesor");
                        $resultado->data_seek(0);
                        while ($fila = $resultado->fetch_assoc()) { 
                            $nombreAsesor = $fila['nombre'];
                            ?>
                            <option value="<?php echo $nombreAsesor;?>"><?php echo $nombreAsesor; ?></option>
                            <?php
                        }
                        $conn->close();
                        ?>
                    </select>
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
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <select id="filtroSemestre" class="form-control" name="semestre">
                        <option value="" selected>Semestre</option>
                        <option value="EJ20">Enero-Junio 2020</option>
                        <option value="JD19">Julio-Agosto 2019</option>
                        <option value="EJ20">Enero-Junio 2019</option>
                        <option value="JD18">Julio-Agosto 2018</option>
                        <option value="EJ20">Enero-Junio 2018</option>
                        <option value="JD17">Julio-Agosto 2017</option>
                        <option value="EJ20">Enero-Junio 2017</option>
                        <option value="JD16">Julio-Agosto 2016</option>
                        <option value="EJ16">Enero-Junio 2016</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select id="filtroAnio" class="form-control" name="anio">
                        <option value="" selected>Año</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
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
                    <th scope="col">Asesor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Observaciones</th>
                </thead>
                <tbody id="pagination">
                    <?php
                    include '../config/Conn.php';
                    $query = "SELECT Asesores.idAlumno AS id, Asesores.idAsesoria, CONCAT(Alumno.nombre,' ', Alumno.apellido) AS Alumno,Asesores.nombre, Asesores.fecha, Asesores.Motivo, Asesores.observaciones
                    FROM (	
                        SELECT * FROM Asesor 
                        NATURAL JOIN (
                            SELECT *
                            FROM Motivo 
                            NATURAL JOIN Asesoria
                        ) as Motivos 
                    ) AS Asesores
                    INNER JOIN Alumno
                    ON Asesores.idAlumno = Alumno.idAlumno  
                    $where
                    ORDER BY Asesores.fecha DESC";
                    //echo $query;
                    $resultado = $conn->query($query);
                    if (!$resultado) echo "ERROR: " . $conn->error . $query;
                    $resultado->data_seek(0);
                    while ($fila = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $fila['idAsesoria']; ?></td>
                            <td data-href="alumno_historial.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
                            <td class="align-middle"><?php echo $fila['nombre']; ?></td>
                            <td class="align-middle"><?php echo $fila['fecha']; ?></td>
                            <td class="align-middle"><?php echo $fila['motivo']; ?></td>
                            <td class="align-middle"><?php echo $fila['observaciones']; ?></td>
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
            <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_dashboard.php'">Regresar</button><br>
        </div>
    </div>
</div>

    <script src="../paginacion/bootstrap-table-pagination.js"></script>
    <script src="../paginacion/pagination.js"></script>

    <script>
        $(document).ready(function () {
            $(document.body).on("click", "td[data-href]", function () {
                window.location.href = this.dataset.href + "?id="+ this.dataset.id;
            });
        });
    </script>

    </body>
    </html>