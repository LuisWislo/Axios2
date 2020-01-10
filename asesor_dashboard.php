<?php include 'asesor_navbar.php'; ?>
<div class="container p-5">
  <div class="row p-2">
    <div class="col-md-6">
      <button class="btn-b peach-gradient btn-block p-3" onclick="window.location.href='registro_aseso.php'">Registrar Asesoría</button>
    </div>
    <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3">Historial</button><br>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <h5>ULTIMAS ASESORIAS</h5>
    
    <div class="row">
        <button class="btn-b aqua-gradient btn-block p-3" onclick="window.location.href='admin_asesorias.php'">VER TODAS</button>
      </div>
  </div>
  <?php include 'asesor_check.php'; ?>
  </body>