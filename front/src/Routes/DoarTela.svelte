<script>
    import Menu from "./Menu.svelte";
    import { onMount } from "svelte";
    //import { userid } from "../stores";
    let obj = {};

    let types = [];

    let descricao = "";
    let imagem = "";
    //let tipo = "";
    let tipo = "";

    const postOBJ = async () => {
        const postRoute = "http://localhost/desapeguei/back/post-object.php";
        const dado = new FormData();
        dado.append("descricao", descricao);
        dado.append("imagem", imagem);
        dado.append("tipo", tipo);
        let res = await fetch(postRoute, {
            method: "POST",
            body: dado,
            credentials: "include",
        });
        if (!res.ok) {
            alert("deu merda");
            return;
        }
    };

    const loadTypes = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-types.php";
        const res = await fetch(loadRoute, {
            credentials: "include",
        });
        if (!res.ok) {
            alert("deu merda, não tais logado");
            return;
        }
            types = await res.json();
            console.log(types.length);
    };
    onMount(() => {
        loadTypes();
    });
</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
    <Menu />
</main>
<body class="box">
    <h2>Faça sua doação</h2>
    <form on:submit|preventDefault={postOBJ}  class="geral" id="BOXformgeral" >
        <div class="titulo">
            <label for="titulo">Nome do objeto</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control border border-secondary p-1"
                placeholder="Insira o nome do objeto"
            />
        <div class="inpimage">
            <label for="imagem">Adicione imagem ao objeto</label>
            <input
                type="file"
                name="imagem"
                id="imagem"
                class="form-control border border-secondary p-1"
                placeholder="Insira uma imagem."
                bind:value={imagem}
            />
        </div>
        <div class="inpdescri">
            <label for="dsrc">Descrição</label>
            <textarea 
                name="descricao"
                id="DOARdescri"
                class="form-control border border-secondary p-1"
                placeholder="Insira aqui a descrição do objeto."
                bind:value={descricao}
            />

        </div>
        <label class="tipo" for="tipo">Tipo</label>
        <select class="tipobutton" name="tipo" id="tipo" bind:value={tipo}>
            {#each types as type}
                <option value={type.TIPO_ID}>{type.TIPO_DESCRICAO}</option>
            {/each}
        </select>

        <div>
            <button class="botão">Fazer doação</button>
        </div>
    </form>
</body>