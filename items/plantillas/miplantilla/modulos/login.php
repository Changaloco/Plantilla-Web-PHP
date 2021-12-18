
<main>
  <div class="container  login">
    <div class="row align-stretch">
      <div class="col bg-login d-none  d-lg-block col-md-5 col-lg-5 col-cl-6">
        <img class="img-fluid" src="<?php echo$imagenes['PersuitSesionUrl'] ?>" alt="">
      </div>
      <div class="col">
        <div class="text-end ">
          <img src="<?php echo $logo['imagen'] ?>"  alt="" class="img-fluid login-img">
        </div>
        <div class="login_titulo">
          <h2 class=" fw-bold text-center py-5 mb-5">
            Bienvenido
          </h2>
        </div>

          <div class="div">
            <form class="login_form" idEmpresa="<?php echo $empresa["id_empresa"] ?>" id="login-form" method="POST">
            <input type="hidden" id="ingEmpresa" name="ingEmpresa"  value="<?php echo $empresa["id_empresa"] ?>">
              <div class="mb-4">
                <label  for=" email"  class="form-label">Correo Electronico</label>
                <input required type="email" id="loginCorreo"  name="ingCorreo"  class="form-control" name="email">
              </div>
              <div class="mb-4">
                <label  for=" password " class="form-label">Password</label>
                <input required type="password" id="loginPassword"  name="ingPassword"  class="form-control" name="password">
              </div>
              <div class="d-grid">
                <button  type="submit" class="btn btn-themeVar btn-login">
                  Iniciar Sesion
                </button>
              </div>
              <div class="my-3">
                <span class="login-texto-busqueda">No tienes cuenta? <a href="register">Registrate</a></span>
                
              </div>
            </form>

            <div class="container my-1 w-100">
              <h4 class="text-center redes-sociales">Redes sociales</h4>
              <div class="row">
                <div class="col-6">
                  <button class="btn btnSignInFacebook btn-outline-primary">
                    <div class="row align-items-center">
                      <div class="col-2">
                        <i width="32" class="fab fa-facebook"></i>
                      </div>
                      <div class="col-10">
                        Facebook
                      </div>
                    </div>
                  </button>
                </div>
                <div class="col-6">
                  <button class="btn btnSignInGoogle btn-outline-success">
                    <div class="row align-items-center">
                      <div class="col-2">
                        <i class="fab fa-google"></i>
                      </div>
                      <div class="col-10">
                        Google
                      </div>
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </div>
          
      </div>
    </div>  
  </div>
</main>