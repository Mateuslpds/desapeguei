<script>
  import Menu from "./Menu.svelte";
</script>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
  <Menu />
  <body>
    <div class="container">
      <div class="row m-5 no-gutters shadow-lg">
        <div class="col-md-6 d-none d-md-block">
          <img
            src="imagens/Recuperar.png"
            class="img-fluid"
            style="min-height: 40%;"
            alt=""
          />
        </div>
        <div class="col-md-6 p-5 form-style">
          <form action="$">
            <h1>Esqueceu a senha?</h1>
            <br />

            <div class="desapega">
              <div class="input-box pb-3 form-group">
                <label for="password">Senha Secreta</label>
                <input
                  id="text"
                  type="text"
                  name="text"
                  placeholder="Resposta da perguntinha secreta"
                  required
                  class="form-control"
                  minlength="8"
                />
              </div>
              <br />

              <div class="input-box pb-3 form-group">
                <label for="password">Nova senha</label>
                <input
                  id="password"
                  type="password"
                  name="password"
                  placeholder="Digite a senha aqui"
                  required
                  class="form-control"
                  minlength="8"
                />
              </div>
              <br />

              <div class="input-box pb-3 form-group">
                <label for="confirmPassword">Confirme sua Senha </label>
                <input
                  id="confirmPassword"
                  type="password"
                  name="confirmPassword"
                  placeholder="Digite a senha aqui"
                  required
                  class="form-control"
                  minlength="8"
                />
              </div>
              <center
                ><div class="d-flex align-items-center justify-content-between">
                  <input name="" type="checkbox" value="" />
                  <span class="pl-2 font-weight-bold"
                    >Mantenha-me conectado</span
                  >
                </div>
              </center>
              <br />
              <div class="continue-button pb-2">
                <button class="btn w-100 font-weight-bold mt-2"
                  ><a href="$">Conectar</a></button
                >
              </div>
              <br />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</main>
