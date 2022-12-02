<script>
  import { link } from "svelte-spa-router";
  import Menu from "./Menu.svelte";
  import Objetos from "./Objetos.svelte";
</script>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
  <Menu />
</main>

<body>
  {#if localStorage.getItem("id") != undefined}
  <div
    class="col-12 col-lg-auto mb-0 mb-lg-3 me-lg-6 w-25  pl-lg-5"
    id="Cbotao"
  >
  <a href="/doarTela"use:link>
    <button type="button" class="btn btn-dark btn btn-outline-primary w-75">
      Doar
    </button>
  </a>
  </div>
  {/if}

  <Objetos />
</body>
