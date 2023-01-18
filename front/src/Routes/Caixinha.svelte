<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { dataset_dev } from "svelte/internal";
    import Agenda from "./Agenda.svelte";

    let objs = [];
    let doadorAgenda = [];
    let receptorAgenda = [];

    let descricao = "";
    let imagem = "";
    

    const loadObjs = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-user-objects.php";
        const res = await fetch(loadRoute, {
            credentials : "include",
        });
        if (!res.ok) {
            alert("erro: você não está logado");
            return;
        }
        objs = await res.json();
        console.log(objs.length)
    };

    onMount(() => {
        loadObjs();
        loadDoadorAgenda();
        loadReceptorAgenda();
    });

    const deleteOBJ = async (id) => {
        const data = new FormData();
        data.append("id", id);
        const deleteRoute = "http://localhost/desapeguei/back/delete-objects.php";
        const res = await fetch(deleteRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível deletar o objeto");
            return;
        }
        loadObjs();
    }

    let idEdit = "";

    const selectID = async (id) => {
        idEdit = id;
        console.log(idEdit);
    }

    const editOBJ = async () => {
        const updateRoute = "http://localhost/desapeguei/back/update-object.php";
        const data = new FormData();
        data.append("id", idEdit);
        data.append("descricao", descricao);
        data.append("imagem", imagem);
        const res = await fetch(updateRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível editar o objeto");
            return;
        }
        loadObjs();
    };
  
    const loadDoadorAgenda = async () => {
        const loadDoadorAgendaRoute = "http://localhost/desapeguei/back/agenda-doador-read.php";
        const res = await fetch(loadDoadorAgendaRoute, {
        credentials: "include",
    });
        if(!res.ok){
            alert("erro: não foi possível carregar seus objetos doados com agendamento");
            return;
        }
        doadorAgenda = await res.json();
    };

    const loadReceptorAgenda = async () => {
        const loadReceptorAgendaRoute = "http://localhost/desapeguei/back/agenda-receptor-read.php";
        const res = await fetch(loadReceptorAgendaRoute, {
        credentials: "include",
    });
        if(!res.ok){
            alert("erro: não foi possível carregar os objetos dos quais você agendou");
            return;
        }
        receptorAgenda = await res.json();
    };

</script>
<svelte:head>
    <link rel="stylesheet" href="./src/caixinha.css">
</svelte:head>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
    <Menu/>
</main>
<body class ="box">
    <div class="pesquisar">
        <form>
            <label class="caixinha" for="caixa">CAIXINHA</label>
            <input class="inputdonate" type="search" placeholder="Pesquisar por suas doações.">
        </form>
    </div>
    {#if objs.length > 0}
    {#each objs as obj}
        <div>
            {obj.OBJ_DESCRICAO}
            {obj.OBJ_IMG}
            <span style="cursor: pointer;" on:click={() => deleteOBJ(obj.OBJ_ID)}>&times;</span>
            <button on:click={() => selectID(obj.OBJ_ID)}>Editar</button>        
        </div>
    {/each}
    {#each doadorAgenda as Dagenda}
        <!--arrumar alguma forma de deixar isso de lado do objeto como se tivesse relacionando visualmente isto-->
        <div>
       <!--PARA O RECEPTOR : {Dagenda.USUARIO_NOME}   forma de fazer com que apareça o nome do receptor para o doador -->
        CEP: {Dagenda.AGD_CEP}
        HORA EFETUADA :{Dagenda.AGD_DATETIME}
        </div>
    {/each}
        <form on:submit|preventDefault={() => editOBJ()}>
            <input type="text" id="descricao" bind:value={descricao}>
            <input type="text" id="imagem" bind:value={imagem}>
            <button class="Editar">Editar</button>
        </form>
    {:else}
    <div class="imagem">
        <img src="imagens\sad.jpg" alt="gato na caixa"/>
    </div>
    <div class="mt-lg-5  me-lg-3 " id="Ctexto1">
        <p>Sua caixinha está vazia!</p>
        <br>
        <p>Você ainda não fez nenhuma</p>
        <p>doação.</p>
    </div>
    {/if}
    {#each receptorAgenda as Ragenda}
        <div>
          DO DOADOR: {Ragenda.USUARIO_NOME} <!-- forma com que apareça o nome do doador para o receptor-->
            CEP: {Ragenda.AGD_CEP}
            HORA EFETUADA: {Ragenda.AGD_DATETIME}
        </div>
    {/each}
    <div class="textodoar">
        Gostaria de fazer uma doação?
    </div>
    <div class="col-12 col-lg-auto mb-0 mb-lg-3 me-lg-6 w-25  pl-lg-5" id="Cbotao">
        <a href="/doarTela" use:link>
        <button type="button" class='btn btn-dark btn btn-outline-primary w-75'>
            Doar
        </button>
        </a>
    </div>
</body>