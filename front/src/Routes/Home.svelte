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

  {#if localStorage.getItem("isLogged") != undefined}
    <div
      class="col-12 col-lg-auto mb-0 mb-lg-3 me-lg-6 w-25  pl-lg-5"
      id="Cbotao"
    >
      <a href="/doarTela" use:link>
        <button type="button" class="btn btn-dark btn btn-outline-primary w-75">
          Doar
        </button>
      </a>
    </div>

  {/if}

  <Objetos />
</body>
<div class="titulo">DESCUBRA</div>

<div class="row">
  <div class="column">
    <img src="https://m.media-amazon.com/images/I/81Y3Vs0N0jL._AC_SY450_.jpg"  style="width:50%">
    <p>Placa de video</p>
  </div>
  <div class="column">
    <img src="https://m.media-amazon.com/images/I/714oTGWUEoL._AC_SY450_.jpg"  style="width:50%">
    <p>Placa mãe</p>
  </div>
  <div class="column">
    <img src="https://i.zst.com.br/thumbs/12/15/37/1572997090.jpg"  style="width:50%">
    <p>Headset</p>
  </div>
    <div class="column">
    <img src="https://mktesports.com.br/wp-content/uploads/2020/04/Melhores-microfones-para-stream-1-1.jpg"  style="width:50%">
    <p>Microfone</p>
</div>
</div>
  <style>

* {
  box-sizing: border-box;
}

.row {
  margin: auto;
  width: 70%;
  border: 2px solid #2595bea1;
  border-radius: 10px;
  padding-left:10%;
  padding-top:1% ;
  padding-bottom:1% ;
}

.column {
  float: left;
  width: 25%;
  padding: 5px;
 }

.row::after {
  content: "";
  clear: both;
  display: table;
}

.titulo{
  text-align: center;
    font-size: 40px;
}
</style>