<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { prevent_default } from "svelte/internal";

    let objs = [];
    let dataAgenda = [];
    
    let CEP = "";

    const getObjs = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-object.php";
        const res = await fetch(loadRoute, {
            credentials : "include",
        });
        objs = await res.json();
        console.log(objs.length)
    };

    onMount(() => {
        getObjs();
    });

    const agendaCreate = async () => {
        const agendaRoute = "http://localhost/desapeguei/back/agenda-create.php";
        const agenDado = new FormData();
        agenDado.append("CEP", CEP);
        let res = await fetch(agendaRoute, {
            method: "POST",
            body: agenDado,
            credentials : "include",
        });
        if (!res.ok) {
            alert("deu merda");
            return;
        }
    };

    const loadAgenda = async () => {
        const loadAgendaRoute = "http://localhost/desapeguei/back/agenda-doador-read.php";
        const res = await fetch(loadAgendaRoute, {
        credentials: "include",
    });
    dataAgenda = await res.json();
    };


</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>
<Menu></Menu>
{#each objs as obj}
<h1>Objeto: {obj.OBJ_DESCRICAO}</h1>

<h1>realize seu agendamento</h1>

<form on:submit|preventDefault={agendaCreate}>
    <div>
        <label>
            <input type="text" bind:value={CEP}> insira aqui seu CEP 
        </label>
    </div>
    <div>
        <button>lansa</button>
    </div>
</form>
{/each}

<button on:click={() => loadAgenda()}>{dataAgenda}</button>