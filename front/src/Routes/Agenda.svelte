<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { prevent_default } from "svelte/internal";

    let CEP = "";
    let DATA_HORA = "";

    const agendaCreate = async () => {
        const agendaRoute = "http://localhost/desapeguei/back/agenda-create.php";
        const agenDado = new FormData();
        agenDado.append("CEP", CEP);
        agenDado.append("datahora", DATA_HORA);
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
<h1>testeteste teste oi oi oi</h1>

<h1>realize seu agendamento</h1>

<form on:submit|preventDefault={agendaCreate}>
    <div>
        <label>
            <input type="text" bind:value={CEP}> insira aqui seu CEP 
        </label>
    </div>
    <div>
        <label>
            <input type="text" bind:value={DATA_HORA}> insira aq data e hora
        </label>
    </div>
    <div>
        <button>lansa</button>
    </div>

</form>