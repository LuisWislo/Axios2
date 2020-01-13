<?php include 'asesor_navbar.php';
    $where = "";
    $idAsesor = (int)$_GET['idAsesor'];
    $idAlumno = (int)$_GET['idAlumno'];
    $idTipoAsesoria = (int)$_GET['idTipoAsesoria'];
    $idMotivoAsesoria = (int)$_GET['idMotivoAsesoria'];
    include 'Conn.php';
    $queryId = "SELECT correo FROM Asesor WHERE idAsesor = '$idAsesor'";
    $resultadoId = $conn->query($queryId);
    $resultadoId->data_seek(0);
    $filaId = $resultadoId->fetch_assoc();
    $mail = $filaId['correo'];
    $conn->close();
?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <?php
        include 'Conn.php';
        $query = "SELECT a.idAlumno AS id, CONCAT(a.nombre,' ', a.apellido) AS Alumno, 
        e.nombre AS Escuela, ga.numero AS Grado, gu.grupo AS Grupo
        FROM Alumno as a JOIN Grupo as gu
        ON a.idGrupo = gu.idGrupo
        JOIN Grado as ga
        ON gu.idGrado = ga.idGrado
        JOIN Turno as t
        ON ga.idTurno = t.idTurno
        JOIN Escuela as e
        ON t.idEscuela = e.idEscuela
        LEFT JOIN Asesor as ase
        ON t.idAsesor = ase.idAsesor
        WHERE ase.idAsesor = $idAsesor AND a.idAlumno = $idAlumno";
        $resultado = $conn->query($query);

        $resultado->data_seek(0);
        $fila = $resultado->fetch_assoc()
        ?>
          <h1>Nueva asesoria con:</h1>
          <br>
          <h2><?php echo $fila['Alumno']; ?></h2>
          <br>
          <form onsubmit="return validateForm()">
   
        <?php
        $conn->close();
        ?>
          <div class="row my-4">
            <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <h3 for="input-tipo">Fecha de asesoria</h3>
                
                <input id="fecha" type="date">
                <br>
                <br>
                <h3 for="input-tipo">Observaciones</h3>
                
                <input id="observaciones" type="text" placeholder="Escriba aquí"> 
              </div>
              <div class="col-sm-2"></div>
            </div>
          </form>
        
        <br>
        <div class="row my-4 justify-content-center">
          <div class="col-sm-8">
            <button data-href="subir_asesoria.php" class="btn btn-success btn-lg btn-primary btn-block text-uppercase">Subir asesoria</button>
          </div>
        </div>
        <div class="row my-4 justify-content-center">
          <div class="col-sm-5">
            <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='asesor_dashboard.php'">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'asesor_check.php'; ?>

<script>
    $(document).ready(function () {
        $(document.body).on("click", "button[data-href]", function () {
            window.location.href = this.dataset.href
                                 + "?idAsesor=" + <?php echo(json_encode($idAsesor)); ?>
                                 + "&idAlumno=" + <?php echo(json_encode($idAlumno)); ?>
                                 + "&idTipoAsesoria=" + <?php echo(json_encode($idTipoAsesoria)); ?>
                                 + "&idMotivoAsesoria=" + document.getElementById('motivoAsesoria');
        });
    });
</script>
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