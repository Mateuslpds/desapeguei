<script>
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import Menu from "./Menu.svelte";
    import { search } from "../stores.js";

    let objs = [];
    let types = [];

    let tipo = null;

    const imgPath = "http://localhost/desapeguei/back/imagens/";

    const loadTypes = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-types.php";
        const res = await fetch(loadRoute, {
            credentials: "include",
        });
        types = await res.json();
    };
    onMount(() => {
        loadTypes();
    });

    $: visibleObjs = $search
        ? objs.filter((obj) => {
              return (
                  obj.OBJ_DESCRICAO.match(`${$search}.*`) &&
                  (obj.OBJ_TIPO_ID == tipo || tipo == null)
              );
          })
        : objs;

    onMount(async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-objects.php";
        const res = await fetch(loadRoute, {
            credentials: "include",
        });
        objs = await res.json();
    });

    const getOBJ = async (obj) => {
        const loadRoute =
            "http://localhost/desapeguei/back/get-session-obj.php?obj=" + obj;
        await fetch(loadRoute, {
            credentials: "include",
        });
        console.log(loadRoute);
    };

    const cleanFilter = () => {
        tipo = null;
    };
</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<body>
    <Menu />

    <label class="tipo" for="tipo">Tipo</label>
    <select class="form-select" name="tipo" id="tipo" bind:value={tipo}>
        {#each types as type}
            <option value={type.TIPO_ID}>{type.TIPO_DESCRICAO}</option>
        {/each}
    </select>
    <button class="btn btn-outline-danger btn-sm" on:click={cleanFilter}>Limpar filtro</button>

    <div class="grid">
    {#each visibleObjs as obj}
        <a class="card" on:click={() => getOBJ(obj.OBJ_ID)} href="/agendamento" use:link>
            <img class="objImage" src="{imgPath}{obj.OBJ_IMG}" alt="Avatar" style="width:100%" />
            <div class="container">
                <h5><b>Nome do Objeto</b></h5>
                <p class="descricao">{obj.OBJ_DESCRICAO}</p>
            </div>
        </a>
    {/each}
    </div>
</body>

<style>
    body{
        background-color: #ebebeb;
    }
    .tipo{
        margin-top: 1rem;
        margin-left: 3rem;
        font-weight: bold;
    }

    .form-select{
        margin-right: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .grid{
        margin-left: 2rem;
        margin-right: 2rem;
    }

    .card {
        color: #333;
        box-shadow: 0 0.5px 0px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 23%;
        margin: 0.5rem;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .objImage{
        margin-bottom: 20px;
        padding: 20px;
        height: 17rem;
    }

    .container {
        padding: 2px 16px;
    }

    .descricao{
        height: 4.5rem;
        overflow-wrap: break-word;
        overflow: hidden;
    }
</style>
