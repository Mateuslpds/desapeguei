<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { prevent_default } from "svelte/internal";

    let objs = [];
    let userDATA = [];

    let CEP = "";

    const imgPath = "http://localhost/desapeguei/back/imagens/";

    const getObjs = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-object.php";
        const res = await fetch(loadRoute, {
            credentials : "include",
        });
        objs = await res.json();
        console.log(objs.length)
    };

    const readUSER = async () => {
        const loadUserRoute = "http://localhost/desapeguei/back/read-user.php";
        const res = await fetch (loadUserRoute, {
            credentials: "include",
        });
        userDATA = await res.json();
        console.log(userDATA.length);

    };

    onMount(() => {
        getObjs();
        readUSER();
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
{#each objs as obj}
{#each userDATA as user}
<h1>
    NOME DO DOADOR :{user.USUARIO_NOME}
    TELEFONE DE CONTADO DO DOADOR: {user.USUARIO_TEL}
</h1>
{/each}
<img src="{imgPath}{obj.OBJ_IMG}" alt="" />
<h1>Objeto: {obj.OBJ_DESCRICAO}</h1>

<h1>realize seu agendamento</h1>


<form on:submit|preventDefault={agendaCreate}>
    <div>
        <label>
            <input type="text" bind:value={CEP}> insira aqui seu CEP 
        </label>
    </div>
    <div>
        <button>enviar CEP</button>
    </div>
</form>
{/each}

