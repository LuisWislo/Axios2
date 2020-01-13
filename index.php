<?php
session_start();

if(isset($_GET['cerrar_sesion'])){
  session_unset();
  session_destroy();
}

if(isset($_SESSION['user'])){
  if(isset($_SESSION['admin'])){
    header('location: admin/admin_dashboard.php');
  }else{
    header('location: asesor_dashboard.php');
  }
}

if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
  $mail = $_POST['inputEmail'];
  $pass = $_POST['inputPassword'];

  include 'Conn.php';

  $query = "SELECT * FROM Asesor WHERE correo = '$mail' AND password = PASSWORD('$pass')";
  $resultado = $conn->query($query);
  $fila = mysqli_fetch_row($resultado);
  $conn->close();
  if($fila == true){
    $_SESSION['user'] = $mail;
    if($mail == 'admin@axios.com'){
      $_SESSION['admin'] = true;
      header('location: admin/admin_dashboard.php');
    }else{
      $_SESSION['admin'] = false;
      header('location: asesor_dashboard.php');
    }
  }

}

?>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="sauce/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1,
    shrink-to-fit=no">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body text-center">
            <img src="sauce/Logo AXIOS.png" class="img-responsive" style="width:100px;" /><br>
            <h5 class="card-title text-center">Control de Asesorías</h5>

            <form class="form-signin" id="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Correo Electrónico" required autofocus>
                <label for="inputEmail">Correo Electrónico</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contraseña" required>
                <label for="inputPassword">Contraseña</label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Submit">Ingresar</button>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


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


    function enviar() {
      var email = document.getElementById('inputEmail').value;
      var password = document.getElementById('inputPassword').value;

      firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // ...
      });


    }
  </script>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script>
    const signInForm = document.querySelector('#form-signin');
    signInForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Obtener info
      const email = signInForm['inputEmail'].value;
      const password = signInForm['inputPassword'].value;

      firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorMessage);
      });
    })


    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        var displayName = user.displayName;
        var email = user.email;
        var emailVerified = user.emailVerified;
        var photoURL = user.photoURL;
        var isAnonymous = user.isAnonymous;
        var uid = user.uid;
        var providerData = user.providerData;
        if (email == "admin@axios.com") {
          window.location.href = "admin/admin_dashboard.php";
        } else {
          window.location.href = "asesor_dashboard.php?inputMail=" + email;
        }
      } else {
        // User is signed out.
        // ...
      }
    });
  </script>
  -->
</body>