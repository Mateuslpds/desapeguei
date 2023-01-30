<script>
    import Menu from "./Menu.svelte";
    import { onMount } from "svelte";
    let obj = {};

    let types = [];

    let nome = "";
    let descricao = "";
    let imagem = "";
    let tipo = "";

    const postOBJ = async () => {
        const postRoute = "http://localhost/desapeguei/back/post-object.php";
        const dado = new FormData();
        dado.append("nome", nome);
        dado.append("descricao", descricao);
        dado.append("imagem", imagem[0]);
        dado.append("tipo", tipo);
        let res = await fetch(postRoute, {
            method: "POST",
            body: dado,
            credentials: "include",
        });
        if (!res.ok) {
            alert("erro: não foi possível postar o objeto");
            return;
        }

        console.log(imagem[0]);
    };

    const loadTypes = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-types.php";
        const res = await fetch(loadRoute, {
            credentials: "include",
        });
        if (!res.ok) {
            alert("erro: não foi possível carregar os tipos");
            return;
        }
            types = await res.json();
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
        <div class="nome">
            <label for="nome">Nome do objeto</label>
            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control border border-secondary p-1"
                placeholder="Insira o nome do objeto"
                bind:value={nome}
            />
        <div class="inpimage">
            <label for="imagem">Adicione imagem ao objeto</label>
            <input
                type="file"
                name="imagem"
                id="imagem"
                class="form-control border border-secondary p-1"
                placeholder="Insira uma imagem."
                bind:files={imagem}
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