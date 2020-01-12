<?php include 'asesor_navbar.php'; ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h1>Asesorias</h1>
        <label for="inputEmail">Escriba nombre de alumno</label>
        <!--<div class="form-label-group">-->
        <form onsubmit="return validateForm()">
          <input type="text" id="name_input" class="form-control" placeholder="Nombre" list="huge_list" required autofocus>
          <datalist id="huge_list">
          </datalist>
          <br/>
          <input type="submit">

          <div class="row my-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <label for="input-escuela">Escuela</label>
              <input type="input-escuela" class="form-control" placeholder="escuela" disabled>
              <label for="input-grado">Grado</label>
              <input type="input-grado" class="form-control" placeholder="grado" disabled>
              <label for="input-grupo">Grupo</label>
              <input type="input-grupo" class="form-control" placeholder="grupo" disabled>
            </div>
            <div class="col-sm-4">
              <label for="input-tipo">Tipo de Asesoría</label>
              <select id="tipoAsesoria" class="form-control"></select>
              <label for="input-motivo">Motivo de Asesoría</label>
              <select id="motivoAsesoria" class="form-control"></select>
            </div>
            <div class="col-sm-2"></div>
          </div>
        </form>
        <!--</div>-->
        <div class="row my-4 justify-content-center">
          <div class="col-sm-3">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase">Aceptar</button>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='asesor_dashboard.php'">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'asesor_check.php'; ?>

<script src="sauce/asesorias.js"></script>
  <!-- The core Firebase JS SDK is always required and must be listed first -->
<!--
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-analytics.js"></script>
  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyCOnEvFwCfDfM7gpX2DiKZTxtXSNljU_Jw",
      authDomain: "axios-c524e.firebaseapp.com",
      databaseURL: "https://axios-c524e.firebaseio.com",
      projectId: "axios-c524e",
      storageBucket: "axios-c524e.appspot.com",
      messagingSenderId: "1038331624441",
      appId: "1:1038331624441:web:17d779f7c09e12d9b61b28",
      measurementId: "G-RC4MZLVKQT"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
  </script>
  -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

<script src="js/bootstrap-table-pagination.js"></script>
<script src="paginacion/pagination.js"></script>

<!--
  <script>
    firebase.auth().onAuthStateChanged(function (user) {
      if (user) {
        var displayName = user.displayName;
        var email = user.email;
        var emailVerified = user.emailVerified;
        var photoURL = user.photoURL;
        var isAnonymous = user.isAnonymous;
        var uid = user.uid;
        var providerData = user.providerData;
        document.getElementById('hola').innerHTML = user.email;
      } else {
        window.location.href = "index.php";
      }
    });

    function cerrar(){
      firebase.auth().signOut()
      .then(function(){
        console.log("Salir");
        window.location.href = "index.php";
      })
      .catch(function(error){
        console.log(error);
      })
    }
  </script>
-->
</body>