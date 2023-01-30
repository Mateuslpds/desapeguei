<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";

    let infos = [];
    let CEP = "";

    const imgPath = "http://localhost/desapeguei/back/imagens/";

    const getInfos = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-object.php";
        const res = await fetch(loadRoute, {
            credentials : "include",
        });
        infos = await res.json();
    };

    onMount(() => {
        getInfos();
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
</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>
<Menu></Menu>
{#each infos as info}
<h1>
    NOME DO DOADOR: {info.USUARIO_NOME}
    TELEFONE DE CONTADO DO DOADOR: {info.USUARIO_TEL}
</h1>
<img src="{imgPath}{info.OBJ_IMG}" alt="" />
<h1>Objeto: {info.OBJ_NOME}</h1>
<h1>Descrição: {info.OBJ_DESCRICAO}</h1>
{/each}

<h1>Realize seu agendamento</h1>
<form on:submit|preventDefault={agendaCreate}>
    <div>
        <label for="">Insira o CEP</label>
        <input type="text" required minlength="8" maxlength="9" bind:value={CEP}>
    </div>
    <br>
    <div>
        <button>Confirmar agendamento</button>
    </div>
</form>