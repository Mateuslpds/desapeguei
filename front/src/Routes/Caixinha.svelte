<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { dataset_dev } from "svelte/internal";

    let objs = [];

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
<body class ="container  shadow-lg">
    <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 w-25 mt-lg-5">
        <form>
            <input class="form-control" style="background:#1; color:black; font-family:Arial, FontAwesome" type="search" placeholder=" &#xF002; Pesquisar por suas doações...">
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
        <form on:submit|preventDefault={() => editOBJ()}>
            <input type="text" id="descricao" bind:value={descricao}>
            <input type="text" id="imagem" bind:value={imagem}>
            <button>Editar</button>
        </form>
    {:else}
    <div class="mt-lg-5  me-lg-3 " id="Ctexto1">
        <h1>Ops... você ainda não fez nenhuma doação  </h1>
    </div>
    <div class="w-25 " style="margin-left:430px; margin-bottom:5px;">
        <img src="imagens/gacaixa.png" alt="gato na caixa" width="250px" height="250px"/>
    </div>
    {/if}
    <div class="col-12 col-lg-auto mb-0 mb-lg-3 me-lg-6 w-25  pl-lg-5" id="Cbotao">
        <a href="/doarTela" use:link>
        <button type="button" class='btn btn-dark btn btn-outline-primary w-75'>
            Doar
        </button>
        </a>
    </div>
</body>