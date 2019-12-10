<?php include 'navbar_admin.php'; ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body text-center">
            <img src="../sauce/Logo AXIOS.png" class="img-responsive" style="width:100px;" /><br>
            <h5 class="card-title text-center">Registro de Asesores</h5>
            <form class="form-signup" id="form-signup">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required
                  autofocus>
                <label for="inputEmail">Correo Electrónico</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                <label for="inputPassword">Contraseña</label>
              </div>

              <button role="button" class="btn btn-lg btn-primary btn-block text-uppercase">Registrar</button>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'admin_check.php'; ?>
  
  <script>
    const signUpForm = document.querySelector('#form-signup');
    signUpForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Obtener info
      const email = signUpForm['inputEmail'].value;
      const password = signUpForm['inputPassword'].value;

      console.log(email + " " + password);

      firebase.auth().createUserWithEmailAndPassword(email, password).catch(function (error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorMessage + " " + errorCode);
      });
    })
  </script>
</body>