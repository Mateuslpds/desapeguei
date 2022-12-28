<script>
    import Menu from "./Menu.svelte";
    //import { userid } from "../stores";
    let tipo = {};
    let obj = {};

    let descricao = "";
    let imagem = "";

    const postOBJ = async () => {
        const postRoute = "http://localhost/desapeguei/back/post-object.php";
        const dado = new FormData();
        //dado.append("nome", obj.nome);
        dado.append("descricao", descricao);
        dado.append("imagem", imagem);
        let res = await fetch(postRoute, {
            method: "POST",
            body: dado,
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

<main>
    <Menu />
</main>
<body class="container shadow-lg mt-4 border border-primary" id="BOXdoar">
    <h2>Doe aí meu vey</h2>
    <form on:submit|preventDefault={postOBJ} class="container row gy-5" id="BOXformgeral" >
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
        <!--
        <div class="form-group col-6">
            <label for="dsrc"> Tipo do produto</label>
            <select name="tipo"> tipo do objeto
                <option>- - - - - - - - - -</option>
                <option value="eleDomestico">Eletrodoméstico</option>
                <option value="hardware">Hardware</option>
                <option value="perifericoE">Periférico de entrada</option>
                <option value="perifericoS">Periférico de saída</option>
            </select>
        </div>
        -->
        <div>
            <button class="btn btn-primary">Fazer doação</button>
        </div>
    </form>
</body>


<style>
    h2{
        margin-top:2rem;
        margin-bottom: -4rem;
        text-align: center;
    }
    label{
        line-height: 10px;
    }
</style>