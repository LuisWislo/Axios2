

  <?php
  include 'navbar_admin.php';
  ?>
 <div class="container p-5">
    <div class="row p-2">
      <div class="col-md-6">
        <button class="btn-b peach-gradient btn-block p-3" onclick="window.location.href='admin_sedes.php'">Sedes</button><br>
        <button class="btn-b blue-gradient btn-block p-3">Facilitadores</button>
      </div>
      <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3">Peridos</button><br>
        <button class="btn-b aqua-gradient btn-block p-3">---</button>
      </div>
    </div>
  </div>
  <?php include 'admin_check.php'; ?>
</body>