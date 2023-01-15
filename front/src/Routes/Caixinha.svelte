<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { dataset_dev } from "svelte/internal";
    import Agenda from "./Agenda.svelte";

    let objs = [];
    let dataAgenda = [];

    let descricao = "";
    let imagem = "";
    

    const loadObjs = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-user-objects.php";
        const res = await fetch(loadRoute, {
            credentials : "include",
        });
        if (!res.ok) {
            alert("deu merda, não tais logado");
            return;
        }
        objs = await res.json();
        console.log(objs.length)
    };

    onMount(() => {
        loadObjs();
        loadAgenda();
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
            alert("deu merda aí");
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
            alert("deu merda aí");
            return;
        }
        loadObjs();
    };
  
    const loadAgenda = async () => {
        const loadAgendaRoute = "http://localhost/desapeguei/back/agenda-doador-read.php";
        const res = await fetch(loadAgendaRoute, {
        credentials: "include",
    });
        if(!res.ok){
            alert("deu merda aí");
            return;
        }
        dataAgenda = await res.json();
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
        {#each dataAgenda as agenda}
        <div>
            {obj.OBJ_DESCRICAO}
            {obj.OBJ_IMG}
            /
           CEP: {agenda.AGD_CEP}
           HORA EFETUADA :{agenda.AGD_DATETIME}
            <span style="cursor: pointer;" on:click={() => deleteOBJ(obj.OBJ_ID)}>&times;</span>
            <button on:click={() => selectID(obj.OBJ_ID)}>Editar</button>        
        </div>
        {/each}
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