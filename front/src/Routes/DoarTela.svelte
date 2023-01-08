<script>
    import Menu from "./Menu.svelte";
    import { onMount } from "svelte";
    //import { userid } from "../stores";
    let obj = {};

    let types = [];

    let descricao = "";
    let imagem = "";
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
    <form
        on:submit|preventDefault={postOBJ}
        class="container row gy-5"
        id="BOXformgeral"
    >
        <div class="form-group col-6">
            <label for="imagem">Adicione imagem ao objeto</label>
            <input
                type="text"
                name="imagem"
                id="imagem"
                class="form-control border border-secondary p-1"
                placeholder="escolha a imagem em seu dispositivo"
                bind:value={imagem}
            />
        </div>
        <div class="form-group col-6">
            <label for="dsrc"> Descrição</label>
            <input
                type="text"
                name="descricao"
                id="DOARdescri"
                class="form-control border border-secondary pt-3"
                placeholder="insira aqui a descrição do objeto..."
                bind:value={descricao}
            />
        </div>

        <select name="tipo" id="tipo" bind:value={tipo}>
            {#each types as type}
                <option value={type.TIPO_ID}>{type.TIPO_DESCRICAO}</option>
            {/each}
        </select>

        <div>
            <button class="btn btn-primary">Fazer doação</button>
        </div>
    </form>
</body>

<style>
    h2 {
        margin-top: 2rem;
        margin-bottom: -4rem;
        text-align: center;
    }
    label {
        line-height: 10px;
    }
</style>
