<head>
  <meta charset="utf-8">
  <title>Registro de Grupos</title>
  <link rel="stylesheet" href="sauce/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">

</head>

<body>

  <script src="sauce/grupos.js"></script>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
      aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
      <img src="sauce/Logo AXIOS.png" width="50" height="50" class="d-inline-block align-top" alt="">
    </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Hola <h7 id="hola"></h7> </a>
        </li>
      </ul>

      <button class="btn" type="submit" onclick="cerrar()">Cerrar Sesión</button>

    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h1>Registro de Grupos</h1>

        <div class="form-label-group">
          <div class="row my-4 justify-content-center">
            <div class="col-sm-8">
              <label for="inputEmail">Escriba nombre de la escuela</label>
              <input type="text" id="inputAlumno" class="form-control" placeholder="Nombre" required autofocus>
            </div>
          </div>
          <div class="row my-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <label for="input-grado">Grado</label>
              <input type="input-grado" class="form-control" placeholder="grado" required>
              <label for="input-tipo">Facilitador</label>
              <select id="tipoAsesoria" class="form-control"></select>
            </div>
            <div class="col-sm-4">
              <label for="input-grupo">Grupo</label>
              <input type="input-grupo" class="form-control" placeholder="grupo" required>
            </div>
            <div class="col-sm-2"></div>
          </div>
        </div>
        <form>
          <div class="row justify-content-center">
            <h4 for="archivo">Archivo</h4>
            <div class="col-sm-4">
              <input type="file" class="form-control-file" id="inputArchivo">
            </div>
          </div>
        </form>
        <div class="row my-4 justify-content-center">
          <div class="col-sm-3">
            <button class="btn btn-success btn-lg btn-primary btn-block text-uppercase">Aceptar</button>
          </div>
          <div class="col-sm-3">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- The core Firebase JS SDK is always required and must be listed first -->
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
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
          window.location.href = "login.html";
        }
      });
    
      function cerrar(){
        firebase.auth().signOut()
        .then(function(){
          console.log("Salir");
        })
        .catch(function(error){
          console.log(error);
        })
      }
    
    </script>
    -->
</body>