<script>
    import Menu from "./Menu.svelte";
    //import { userid } from "../stores";
    let tipo = {};
    let obj = {};
    const postOBJ = async () => {
        const updateRoute = "http://localhost/desapeguei/back/post-object.php";
        const dado = new FormData();
       // dado.append("nome", obj.nome);
        dado.append("descricao", obj.descricao);
        dado.append("foto", obj.foto);
        let res = await fetch(updateRoute, {
            method: "POST",
            body: dado,
            credentials : "include",
        });
    };
   const typeInsert = async () => {
        const updateRoute = "http://localhost/desapeguei/back/type.php";
        const dadoTipo = new FormData();
        dadoTipo.append("tipo", tipo.descricao);

        let res2 = await fetch(updateRoute, {
            method: "POST",
            body: dadoTipo,
            credentials : "include",
        });
    }
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
    <form on:submit="{postOBJ}" on:submit="{typeInsert}">
    <form class="container row gy-5" id="BOXformgeral" >
        <div class="form-group col-6">
            <label for="image ">Adicione foto ao objeto</label>
            <input
                type="text"
                name="foto"
                id="foto"
                class="form-control border border-secondary p-1"
                placeholder="escolha a foto em seu dispositivo"
                bind:value={obj.foto}
            />
        </div>
        <div class="form-group col-6">
            <label for="name">Insira o nome do objeto</label>
            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control border border-secondary"
                placeholder="nome do objeto..."
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
                bind:value={obj.descricao}
            />
        </div>
        <div class="form-group col-6">
            <label for="dsrc"> Tipo do produto</label>
            <select name="tipo" bind:value={tipo.descricao}> tipo do objeto
                <option>- - - - - - - - - -</option>
                <option value="eleDomestico">Eletrodoméstico</option>
                <option value="hardware">Hardware</option>
                <option value="perifericoE">Periférico de entrada</option>
                <option value="perifericoS">Periférico de saída</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Fazer doação</button>
        </div>
    </form>
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