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
      <h3 class="conteudo-principal-titulo">Desapeguei Doação</h3>
      <h3 class="conteudo-principal-subtitulo">Preserve o mundo com a sua doação de eletrônicos.</h3>
      {#if localStorage.getItem("isLogged") != undefined}
      <a href="/doarTela" use:link>
        <button class="conteudo-principal-escrito-botao">Faça uma doação!</button>
      </a>
      {:else}
      <a href="/login" use:link>
        <button class="conteudo-principal-escrito-botao">Faça uma doação!</button>
      </a>
      {/if}
    </div>
      <img class="conteudo-principal-imagem" src="imagens/robo.png" alt="ROBÔ">
  </section>

  <section class="conteudo-secundario">
    <h3 class="conteudo-secundario-titulo">O que a doação de eletrônicos faz por você?</h3>
    <ol>  
      <li class="conteudo-secundario-paragrafo">Doar ou reciclar eletrônicos de consumo preserva nossos recursos naturais e evita a poluição do ar e da água, bem como a emissão de gases.</li>
      <br>
      <li class="conteudo-secundario-paragrafo">A reciclagem de um milhão de laptops economiza a energia equivalente à eletricidade usada por mais de 3.500 residências em um ano. </li>
      <br>
      <li class="conteudo-secundario-paragrafo">Para cada milhão de telefones celulares que reciclarmos, 15 mil kg de cobre, 350 kg de prata, 34 kg de ouro e 15 kg de paládio podem ser recuperadas.</li>
    </ol>
  </section>
  <br>
</main>
<div class="O-carrosel">
  <h1 class="titulo-carrosel">Recentes</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={6}
    rewind={true}
    navigation
    style="margin-left: 0.5rem; margin-right: 3rem;"
  >
    {#each objs.reverse().slice(0, 12) as obj}
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
  <h1 class="titulo-carrosel">Componentes Eletrônicos</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={6}
    rewind={true}
    navigation
    style="margin-left: 0.5rem; margin-right: 3rem;"
  >
    {#each objs.filter(obj => obj.OBJ_TIPO_ID == 1).slice(0, 12) as obj}
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
  <h1 class="titulo-carrosel">Eletrodomésticos</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={6}
    rewind={true}
    navigation
    style="margin-left: 0.5rem; margin-right: 3rem;"
  >
    {#each objs.filter(obj => obj.OBJ_TIPO_ID == 2).slice(0, 12) as obj}
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
  <h1 class="titulo-carrosel">Periféricos</h1>
  <Swiper
    modules={[Navigation]}
    spaceBetween={10}
    slidesPerView={6}
    rewind={true}
    navigation
    style="margin-left: 0.5rem; margin-right: 3rem;"
  >
    {#each objs.filter(obj => obj.OBJ_TIPO_ID == 3).slice(0, 12) as obj}
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
</div>
</body>
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
    background: rgba(216,253,255,255);
    color: rgb(12, 69, 80);
  }
  h1 {
    font-family: fantasy;
    width: 100%;
    text-align: left;
    color: rgba(23,32,55,255);
    text-transform: uppercase;
    letter-spacing: 7px;
    padding: 15px 15px 15px 40px;
    background-image: linear-gradient(to right, white, transparent);
  }
  .O-carrosel {
    padding: 50px 70px 50px 70px;  
    background: rgb(112,191,222);
    background: linear-gradient(90deg, rgba(112,191,222,1) 29%, rgba(64,139,196,1) 79%);
  }
  .titulo-carrosel {
    margin-left: 4rem;
  }
  .card {
    color: #333;
    width: 17.5rem;
    height: 24.5rem;
    box-shadow: 0 0.5px 0px 0 rgba(0, 0, 0, 0.2);
    margin-top: 0.5rem;
    margin-bottom: 3rem;
    margin-left: 3.5rem;
    border-radius: 5px;
    text-decoration: none;
  }
  .objImage {
    padding: 20px;
    height: 17rem;
  }
  .descricao {
    height: 3.5rem;
    overflow-wrap: break-word;
    overflow: hidden;
  }
</style>