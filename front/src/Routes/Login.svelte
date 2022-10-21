<script>
  import Menu from "./Menu.svelte";
</script>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
  <Menu />
  <div class="container">
    <div class="row m-5 no-gutters shadow-lg">
      <div class="col-md-6 d-none d-md-block">
        <img
          src="imagens/imagem-login.jpeg"
          class="img-fluid"
          style="min-height:100%;"
          alt=""
        />
      </div>
      <div class="col-md-6 bg-white p-5">
        <h2 class="pb-3">Fique conectado</h2>
        <div class="form-style">
          <form>
            <div class="form-group pb-3">
              <label for="">Usuário</label>
              <input
                type="email"
                placeholder="Seu e-mail ou CPF"
                class="form-control"
                id="email"
              />
            </div>
            <div class="form-group pb-3">
              <label for="">Senha</label>
              <input
                type="password"
                placeholder="Coloque sua senha aqui"
                class="form-control"
                id="senha"
              />
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <div><a href="/">Esqueceu a senha?</a></div>
              <div class="d-flex align-items-center">
                <input name="" type="checkbox" value="" />
                <span class="pl-2 font-weight-bold">Mantenha-me conectado</span>
              </div>
            </div>
            <div class="pb-2">
              <button
                type="submit"
                class="btn text-white w-100 font-weight-bold mt-2" style="background-color: #3270B6;"
                >Conectar</button
              >
            </div>
          </form>
          <div class="pt-4 text-center">
            Não tem conta? Crie ela em apenas alguns cliques
            <button
              type="submit"
              class="btn btn-dark w-100 font-weight-bold mt-2"
              >Cadastre-se</button
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
