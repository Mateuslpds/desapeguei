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
  let ClosedOBJ = [];

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
    getAGD
  });

  const getOBJ = async (obj) => {
    const loadRoute =
      "http://localhost/desapeguei/back/get-session-obj.php?obj=" + obj;
    await fetch(loadRoute, {
      credentials: "include",
    });
    console.log(loadRoute);
  };

  const getAGD = async () => {
    const loadRoute = "http://localhost/desapeguei/back/get-agenda-objects.php";
    const res = await fetch(loadRoute, {
      credentials: "include",
    });
    ClosedOBJ = await res.json();
  };
</script>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<body>
  <Menu />
<main class="conteudo">
  <section class="conteudo-principal">
    <div class="conteudo-principal-escrito">
      <h1 class="conteudo-principal-titulo">Desapeguei Doação</h1>
      <h3 class="conteudo-principal-subtitulo">Preserve o mundo com a sua doação de eletrônicos.</h3>
      {#if localStorage.getItem("isLogged") != undefined}
      <a href="/doarTela" use:link>
        <button class="conteudo-principal-escrito-botao">Faça uma doação!</button>
      </a>
      {/if}
    </div>
      <img class="conteudo-principal-imagem" src="imagens/robo.png" alt="ROBÔ">
  </section>

  <section class="conteudo-secundario">
    <h3 class="conteudo-secundario-titulo">O que a doação de eletrônicos faz por você?</h3>
      <p class="conteudo-secundario-paragrafo">1. Doar ou reciclar eletrônicos de consumo preserva nossos recursos naturais e evita a poluição do ar e da água, bem como a emissão de gases.</p>
      <p class="conteudo-secundario-paragrafo">2. A reciclagem de um milhão de laptops economiza a energia equivalente à eletricidade usada por mais de 3.500 residências em um ano. </p>
      <p class="conteudo-secundario-paragrafo">3. Para cada milhão de telefones celulares que reciclarmos, 15 mil kg de cobre, 350 kg de prata, 34 kg de ouro e 15 kg de paládio podem ser recuperadas.</p>
  </section>
</main>

  <h1>Recentes</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={7}
    rewind={true}
    navigation
    on:slideChange={() => console.log("slide change")}
    on:swiper={(e) => console.log(e.detail[0])}

  >{#if ClosedOBJ.filter(ClosedOBJ => ClosedOBJ.AGD_STATUS != "fechado")}
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
            <h5><b>{obj.OBJ_NOME}</b></h5>
            <p class="descricao">{obj.OBJ_DESCRICAO}</p>
          </div>
        </a>
      </SwiperSlide>
    {/each}
    {/if}
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
            <h5><b>{obj.OBJ_NOME}</b></h5>
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
            <h5><b>{obj.OBJ_NOME}</b></h5>
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
<footer>
  <div class="container-footer">
      <div class="row-footer">
          <!-- footer col-->
          <div class="footer-col">
              <h4>Empresa</h4>
              <ul>
                  <li><a href="#"> Quem somos </a></li>
                  <li><a href=""> nossos serviços </a></li>
                  <li><a href=""> política de privacidade </a></li>
                  <li><a href=""> programa de afiliados</a></li>
              </ul>
          </div>
          <!--end footer col-->
          <!-- footer col-->
          <div class="footer-col">
              <h4>Obter ajuda</h4>
              <ul>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Transporte</a></li>
                  <li><a href="#">devoluções</a></li>
                  <li><a href="#">Status De Pedido</a></li>
                
              </ul>
          </div>
          <!--end footer col-->
          <!-- footer col-->
          <div class="footer-col">
              <h4>Loja online</h4>
              <ul>
                  <li><a href="#">CPUs</a></li>
                  <li><a href="#">Impressoras</a></li>
                  <li><a href="#">Computadores</a></li>
                  <li><a href="#">Endereço</a></li>
              </ul>
          </div>
          <!--end footer col-->
          <!-- footer col-->
          <div class="footer-col">
             
                 
             

              <div class="medias-socias">
                  <a href="#"> <i class="fa fa-facebook"></i> </a>
                  <a href="#"> <i class="fa fa-instagram"></i> </a>
                  <a href="#"> <i class="fa fa-twitter"></i> </a>
                  <a href="#"> <i class="fa fa-linkedin"></i> </a>
              </div>

          </div>
          <!--end footer col-->
      </div>
  </div>
</footer>


 

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
