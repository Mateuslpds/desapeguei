<script>
  import { link } from "svelte-spa-router";
  import { isLogged } from "../stores";
  import { search } from "../stores";
  
  const searchObj = async () => {
    location.href = "/#/pesquisa";
  }

  const logout = async () => {
    fetch("http://localhost/desapeguei/back/logout.php", {
      credentials: "include",
    });
    localStorage.removeItem("isLogged");
    location.reload();
  };
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

<header class="p-3 text-white" style="background-color: #3270B6;">
  <div class="container">
    <div
      class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"
    >
      <a
        href="/"
        class="d-flex align-items-center mb-3 mb-lg-0 text-dark text-decoration-none" style="font-size: 1.5rem;"
        ><img src="imagens/new_logo.png" alt=""></a
      >
      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 w-50">
        <input
          type="text"
          class="form-control form-control-dark"
          placeholder="&#xF002; Pesquisar doações"
          aria-label="Pesquisar" style="font-family:Arial, FontAwesome"
          autofocus
          bind:value={$search}
          on:input={searchObj}
          />
      </form>
      {#if localStorage.getItem("isLogged") == undefined}
      <div class="text-end">
        <a href="/login" use:link
          ><button type="button" class="btn btn-sm btn-outline-light me-2"
            >Faça login</button
          ></a
        >
        <a href="/cadastro" use:link
        ><button type="button" class="btn btn-sm btn-dark ml-2 mr-3">Cadastre-se</button></a
        >
      </div>
      {:else}
      <a href ='/caixinha' use:link>
      <img class="img-fluid  shadow-lg btn btn-sm" src="imagens/caixinha.png" alt="">
      </a>
      <button
          id="logout"
          type="button"
          class="btn btn-sm btn-dark ml-2 mr-3"
          on:click={logout}>Logout</button
      >
      {/if}
    </div>
  </div>
</header>
