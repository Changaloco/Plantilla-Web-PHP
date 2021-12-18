
<main>
      <div class="container login">
        <div class="row align-stretch">
          <div
            class="col bg-registro d-none d-lg-block col-md-5 col-lg-5 col-cl-6"
          >
          <img class="img-fluid" src="<?php echo$imagenes['PersuitRegistroUrl'] ?>" alt="">
        </div>
          <div class="col">
            <div class="text-end">
              <img src="<?php echo $logo['imagen'] ?>" alt="" class="img-fluid login-img" />
            </div>
            <div class="register_titulo">
              <h2 class=" fw-bold text-center py-5 mb-5">
                Registrarse
              </h2>
            </div>

            <div class="div">
              <form id="signup-form" >
              <input type="hidden" id="empresaCliente" value="<?php echo $empresa["id_empresa"] ?>">
                <div class="mb-4">
                  <div class="form-group">
                  <label for=" text" class="form-label">Nombre</label>
                  <input required type="text" class="form-control" id="nombre" name="email" />
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-group">
                  <label for=" text" class="form-label">Usuario</label>
                  <input required type="text" class="form-control" id="usuario" name="User" />
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-group">
                  <label for=" telefono" class="form-label">Telefono</label>
                  <input required type="text" class="form-control" id="telefono" name="telefono" />
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-group">
                  <label for=" email" class="form-label"
                    >Correo Electronico</label
                  >
                  <input required type="email" class="form-control" id="email" name="email" />
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-group">
                  <label for=" password " class="form-label">Password</label>
                  <input required type="password" class="form-control" id="password" name="password" />
                  </div>
                </div>
                <div class="mb-4">
                    <div class="form-group">
                    <label for=" password " class="form-label">Re-Password</label>
                    <input required type="password" id="repassword" class="form-control" name="password" />
                    </div>
                  </div>
                <div class="d-grid">
                  <button type="submit" class="btn btn-themeVar btn-login">
                    Registrarse
                  </button>
                </div>
                <div class="my-3">
                  <span class="login-texto-busqueda"
                    >Ya tienes cuenta? <a href="login">Iniciar Sesion</a></span
                  >
                </div>
                
              </form>

              <div class="container my-1 w-100">
                <h4 class="text-center redes-sociales">Redes sociales</h4>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-outline-primary">
                      <div class="row align-items-center">
                        <div class="col-2">
                          <i width="32" class="fab fa-facebook"></i>
                        </div>
                        <div class="col-10">Facebook</div>
                      </div>
                    </button>
                  </div>
                  <div class="col-6">
                    <button class="btn btn-outline-success">
                      <div class="row align-items-center">
                        <div class="col-2">
                          <i class="fab fa-google"></i>
                        </div>
                        <div class="col-10">Google</div>
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