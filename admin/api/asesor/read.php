<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Asesor.php';

  // Instanciar objeto DB
  $database = new Database();
  $db = $database->conectarse();

  // Instanciar Asesor
  $asesor = new Asesor($db);

  // Asesor query 
  $result = $asesor->read();

  // Get asesores
  $num = $result->rowCount();

  // Check if any
  if($num > 0) {
    // inicializar arreglo
    $asesores_arr = array();
    $asesores_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $asesor_item = array (
        'id' => $idAsesor,
        'nombre' => $nombre_asesor,
        'escuela' => $escuela,
        'turno_tipo' => $turno,
        'turno_desc' => $turno_desc,
        
      );

      // push to 'data'
      array_push($asesores_arr['data'], $asesor_item);
    }

    // turn to JSON & output
    echo json_encode($asesores_arr, JSON_UNESCAPED_UNICODE);
    echo json_last_error_msg();


  } else {
    echo json_encode(
      array('message' => 'no hay asesores')
    );
  }

