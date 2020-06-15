<?php

class Asesoria {

    private $db;

    public function __construct() {

        $this->db = new Database();
    }

    public function getAsesoriasCSV() {

        $asesorias = $this->db->query("SELECT CONCAT(Alumno.nombre,' ',Alumno.apellido) AS alumno
            , Grupo.grupo
            , Asesor.nombre AS asesor
            , Escuela.nombre AS escuela
            , Turno.descripcion AS turno
            , DATE_FORMAT(Asesoria.fecha, '%d-%m-%Y') AS fecha_aseso
            , Motivo.motivo AS motivo
            , Integrantes.descripcion AS dinamica
            , Asesoria.observaciones AS observaciones
            FROM Asesoria
            JOIN Alumno on Alumno.idAlumno = Asesoria.idAlumno
            JOIN Grupo on Alumno.idGrupo = Grupo.idGrupo
            JOIN Asesor on Asesor.idAsesor = Asesoria.idAsesor
            JOIN Motivo on Motivo.idMotivo = Asesoria.idMotivo
            JOIN Integrantes on Integrantes.idIntegrantes = Asesoria.idIntegrantes
            JOIN Turno on Turno.idAsesor = Asesor.idAsesor
            JOIN Escuela on Escuela.idEscuela = Turno.idEscuela
            JOIN Localidad on Localidad.idLocalidad = Escuela.idLocalidad
            ORDER BY Asesoria.fecha DESC
            ");
        
        return $asesorias;
    }

    public function getAsesoriasTabla($filters = "") {
        $query =
            "SELECT
                Asesoria.idAsesoria AS idAsesoria
                , Alumno.idAlumno AS idAlumno
                , CONCAT(Alumno.nombre,' ',Alumno.apellido) AS alumno
                , Asesor.idAsesor AS idAsesor
                , Asesor.nombre AS asesor
                , DATE_FORMAT(Asesoria.fecha, '%d-%m-%Y') AS fecha
                , Motivo.motivo AS motivo
                , Integrantes.descripcion AS dinamica
                , Asesoria.observaciones AS observaciones
            FROM Asesoria
            JOIN Alumno on Alumno.idAlumno = Asesoria.idAlumno
            JOIN Asesor on Asesor.idAsesor = Asesoria.idAsesor
            JOIN Motivo on Motivo.idMotivo = Asesoria.idMotivo
            JOIN Integrantes on Integrantes.idIntegrantes = Asesoria.idIntegrantes
            JOIN Turno on Turno.idAsesor = Asesor.idAsesor
            JOIN Escuela on Escuela.idEscuela = Turno.idEscuela
            JOIN Localidad on Localidad.idLocalidad = Escuela.idLocalidad
            WHERE 1 $filters
            ORDER BY Asesoria.fecha DESC";

          $resultado = $this->db->query($query);
          if (!$resultado) {
            echo "ERROR: " . $this->db->error;
          }
          return $resultado;
    }

    public function exportarCSV() {
        header('Content-Type: text/csv;charset=utf-8');
        header('Content-Disposition: attachment; filename="datos.csv"');
        $where = "";
        $output = fopen('php://output', 'wb');
        fputcsv($output, array("Asesoria No.", "ID Alumno", "Nombre", "idAsesor", "Asesor", "Fecha", "Motivo", "Dinamica", "Observaciones"));
        print_r($_POST);

        $asesor = $_POST['asesor'];
        $sede = $_POST['sede'];
        $escuela = $_POST['escuela'];
        $anio = $_POST['anio'];
        $mes = $_POST['mes'];
        $rangoDeFechasInicio = $_POST['rangoDeFechasInicio'];
        $rangoDeFechasFin = $_POST['rangoDeFechasFin'];

        if ($asesor) $where .= " AND Asesor.idAsesor = '$asesor'";
        if ($sede) $where .= " AND Localidad.idLocalidad = '$sede'";
        if ($escuela) $where .= " AND Escuela.idEscuela = " . $escuela . " ";
        if ($anio) $where .= " AND YEAR(Asesoria.fecha) = '" . $anio . "' ";
        if ($mes) $where .= " AND MONTH(Asesoria.fecha) = " . $mes;
        if (isset($_POST['filtroFecha']) && $rangoDeFechasInicio && $rangoDeFechasFin) {
            $where .= " AND Asesoria.fecha BETWEEN '$rangoDeFechasInicio' AND '$rangoDeFechasFin'";
        }

        $asesoriasFiltrado = $asesoria->getAsesoriasTabla($where);

        while ($row = $asesoriasFiltrado->fetch_assoc()) {
            extract($row);

            $toCSV = array(
            'idAsesoria' => utf8_decode($idAsesoria),
            'id' => utf8_decode($id),
            'alumno' => utf8_decode($alumno),
            'idAsesor' => utf8_decode($idAsesor),
            'asesor' => utf8_decode($asesor),
            'fecha' => $fecha,
            'motivo' => utf8_decode($motivo),
            'dinamica' => utf8_decode($dinamica),
            'observaciones' => utf8_decode($observaciones),
            );
            fputcsv($output, $toCSV);
        }
        fclose($output);
    }
}