<script>
  import Menu from "./Menu.svelte";
  import { link } from "svelte-spa-router";
  import { users, userid, isLogged } from "../stores";

  export let user = {};

  let email = "";
  let senha = "";

  const submit = async () => {
    const auth = "http://localhost/desapeguei/back/auth.php";
    
    const data = new FormData();
    data.append("email", email);
    data.append("senha", senha);

    const res = await fetch(auth, {
      method: "POST",
      body: data,
      credentials : "include",
    });

    if (!res.ok) {
      alert("Usuário ou senha incorreto");
      return;
    }

    $isLogged = true;
    localStorage.setItem("isLogged", "true");
    window.location.href = "/";
  };

  function Senha() {
        var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
        };
    };

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
        <h1 class="pb-3">Fique conectado</h1>
        <div class="form-style user">
          <form on:submit|preventDefault={submit}>
            <div class="form-group pb-3">
              <label for="">Usuário</label>
              <input
                type="email"
                placeholder="Seu e-mail ou CPF"
                class="form-control"
                id="email"
                bind:value={email}
              />
            </div>
            <div class="form-group pb-3">
              <label for="">Senha</label>
              <input
                type="password"
                placeholder="Coloque sua senha aqui"
                class="form-control"
                id="senha"
                bind:value={senha}
              />
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <div><a href="/recuperar" use:link>Esqueceu a senha?</a></div>
              <div class="d-flex align-items-center">
                <input class="boxpasswordhide" type="checkbox" style="width: 15px" on:click={Senha}> 
                <span class="pl-2 font-weight-bold">Mostrar senha</span>
              </div>
            </div>
            <div class="pb-2">
              <button
                type="submit"
                class="btn text-white w-100 font-weight-bold mt-2"
                style="background-color: #3270B6;"
                >Conectar</button
              >
            </div>
          </form>
          <div class="pt-4 text-center">
            Não tem conta? Crie ela em apenas alguns cliques
            <a href="/cadastro"use:link>
            <button
              type="submit"
              class="btn btn-dark w-100 font-weight-bold mt-2"
              >Cadastre-se</button
            >
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
