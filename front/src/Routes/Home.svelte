<script>
  import { link } from "svelte-spa-router";
  import { onMount } from "svelte";
  import Menu from "./Menu.svelte";

  import { Navigation } from "swiper";

  // Import Swiper Svelte components
  import { Swiper, SwiperSlide } from "swiper/svelte";

  // Import Swiper styles
  import "swiper/css";
  import "swiper/css/navigation";

  let objs = [];

  const imgPath = "http://localhost/desapeguei/back/imagens/";

  const loadObjs = async () => {
    const loadRoute = "http://localhost/desapeguei/back/get-objects.php";
    const res = await fetch(loadRoute, {
      credentials: "include",
    });
    objs = await res.json();
  };

  onMount(() => {
    loadObjs();
  });

  const getOBJ = async (obj) => {
    const loadRoute =
      "http://localhost/desapeguei/back/get-session-obj.php?obj=" + obj;
    await fetch(loadRoute, {
      credentials: "include",
    });
    console.log(loadRoute);
  };
</script>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<body>
  <Menu />
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
  <h1>Recentes</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={7}
    rewind={true}
    navigation
    on:slideChange={() => console.log("slide change")}
    on:swiper={(e) => console.log(e.detail[0])}
  >
    {#each objs.slice(0, 14).reverse() as obj}
      <SwiperSlide>
        <a
          class="card"
          on:click={() => getOBJ(obj.OBJ_ID)}
          href="/agendamento"
          use:link
        >
          <img
            class="objImage"
            src="{imgPath}{obj.OBJ_IMG}"
            alt="Avatar"
            style="width:100%"
          />
          <div class="container">
            <h5><b>Nome do Objeto</b></h5>
            <p class="descricao">{obj.OBJ_DESCRICAO}</p>
          </div>
        </a>
      </SwiperSlide>
    {/each}
  </Swiper>
  <h1>Tipo 1</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={7}
    rewind={true}
    navigation
    on:slideChange={() => console.log("slide change")}
    on:swiper={(e) => console.log(e.detail[0])}
  >
    {#each objs.filter(obj => obj.OBJ_TIPO_ID == 1).slice(0, 14) as obj}
      <SwiperSlide>
        <a
          class="card"
          on:click={() => getOBJ(obj.OBJ_ID)}
          href="/agendamento"
          use:link
        >
          <img
            class="objImage"
            src="{imgPath}{obj.OBJ_IMG}"
            alt="Avatar"
            style="width:100%"
          />
          <div class="container">
            <h5><b>Nome do Objeto</b></h5>
            <p class="descricao">{obj.OBJ_DESCRICAO}</p>
          </div>
        </a>
      </SwiperSlide>
    {/each}
  </Swiper>
  <h1>Tipo 2</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={7}
    rewind={true}
    navigation
    on:slideChange={() => console.log("slide change")}
    on:swiper={(e) => console.log(e.detail[0])}
  >
    {#each objs.filter(obj => obj.OBJ_TIPO_ID == 2).slice(0, 14) as obj}
      <SwiperSlide>
        <a
          class="card"
          on:click={() => getOBJ(obj.OBJ_ID)}
          href="/agendamento"
          use:link
        >
          <img
            class="objImage"
            src="{imgPath}{obj.OBJ_IMG}"
            alt="Avatar"
            style="width:100%"
          />
          <div class="container">
            <h5><b>Nome do Objeto</b></h5>
            <p class="descricao">{obj.OBJ_DESCRICAO}</p>
          </div>
        </a>
      </SwiperSlide>
    {/each}
  </Swiper>
</body>

<div class="titulo">DESCUBRA</div>
<div class="row">
  <div class="column">
    <img
      src="https://m.media-amazon.com/images/I/81Y3Vs0N0jL._AC_SY450_.jpg"
      style="width:50%"
    />
    <p>Placa de video</p>
  </div>
  <div class="column">
    <img
      src="https://m.media-amazon.com/images/I/714oTGWUEoL._AC_SY450_.jpg"
      style="width:50%"
    />
    <p>Placa mãe</p>
  </div>
  <div class="column">
    <img
      src="https://i.zst.com.br/thumbs/12/15/37/1572997090.jpg"
      style="width:50%"
    />
    <p>Headset</p>
  </div>
  <div class="column">
    <img
      src="https://mktesports.com.br/wp-content/uploads/2020/04/Melhores-microfones-para-stream-1-1.jpg"
      style="width:50%"
    />
    <p>Microfone</p>
  </div>
</div>

<style>
  * {
    box-sizing: border-box;
  }

  body {
    background-color: #ebebeb;
  }

  h1 {
    margin-left: 3.5rem;
  }

  .card {
    color: #333;
    width: 16rem;
    height: 23rem;
    box-shadow: 0 0.5px 0px 0 rgba(0, 0, 0, 0.2);
    margin-top: 0.5rem;
    margin-bottom: 3rem;
    margin-left: 3rem;
    margin-right: 3rem;
    border-radius: 5px;
    text-decoration: none;
  }

  .objImage {
    margin-bottom: 20px;
    padding: 20px;
    height: 17rem;
  }

  .container {
    padding: 2px 16px;
  }

  .descricao {
    height: 3rem;
    overflow-wrap: break-word;
    overflow: hidden;
  }

  .row {
    margin: auto;
    width: 70%;
    border: 2px solid #2595bea1;
    border-radius: 10px;
    padding-left: 10%;
    padding-top: 1%;
    padding-bottom: 1%;
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

  .titulo {
    text-align: center;
    font-size: 40px;
  }
</style>
