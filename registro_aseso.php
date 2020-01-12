<?php include 'asesor_navbar.php'; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h1>Asesorias</h1>
      <label for="inputEmail">Escriba nombre de alumno</label>
      <!--<div class="form-label-group">-->
      <b>Search the table for Course, Fees or Type:  
          <input id="search" type="text" placeholder="Search here"> 
        </b> 
        <br> 
        <br> 
        <table class="table table-striped table-dark table-sm table-bordered"> 
          <thead>
            <th scope="col">Alumno</th>
            <th scope="col">Escuela</th>
            <th scope="col">Grado</th>
            <th scope="col">Grupo</th>
          </thead>
          <tbody id="filter"> 
            <?php
            include 'Conn.php';
            $query = "SELECT Alumno.idAlumno AS id, CONCAT(Alumno.nombre,' ', Alumno.apellido) AS Alumno, 
            Escuela.nombre AS Escuela, Grado.numero AS Grado, Grupo.grupo AS Grupo, Asesor.nombre AS Asesor
            FROM Alumno NATURAL JOIN (
              SELECT * FROM Grupo NATURAL JOIN (
                SELECT * FROM Grado NATURAL JOIN (
                  SELECT * FROM Turno NATURAL JOIN Escuela
                  ON Turno.idEscuela = Escuela.idEscuela
                  NATURAL JOIN Asesor
                  ON Turno.idAsesor = Asesor.idAsesor
                )
                ON Grado.idTurno = Turno.idTurno
              )
              ON Grupo.idGrado = Grado.idGrado
            )
            ON Alumno.idGrupo = Grupo.idGrupo
            WHERE Asesor = Viri
            ORDER BY Alumno DESC";
            $resultado = $conn->query($query);

            $resultado->data_seek(0);
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td data-href="datos_alumno.php" data-id="<?php echo $fila['id']; ?>" class="align-middle"><?php echo $fila['Alumno']; ?></td>
                    <td class="align-middle"><?php echo $fila['Escuela']; ?></td>
                    <td class="align-middle"><?php echo $fila['Grado']; ?></td>
                    <td class="align-middle"><?php echo $fila['Grupo']; ?></td>
                </tr>
            <?php
            }
            $conn->close();

            ?>
          </tbody> 
        </table> 
      
      <!--</div>-->
      <div class="row my-4 justify-content-center">
        <div class="col-sm-3">
          <button class="btn btn-danger btn-lg btn-primary btn-block text-uppercase" onclick="window.location.href='asesor_dashboard.php'">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'asesor_check.php'; ?>
  
<script> 
  document.getElementById("filter").style.visibility = "hidden";
  $(document).ready(function() { 
      $("#search").on("keyup", function() {
         var value = $(this).val();
         if(value === "") {
          document.getElementById("filter").style.visibility = "hidden";
         } else {
          document.getElementById("filter").style.visibility = "visible";
          $("#filter tr").filter(function() { 
              $(this).toggle($(this).text().indexOf(value) > -1) 
          }); 
        }
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