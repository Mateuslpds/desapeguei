<script>
    import Menu from "./Menu.svelte";

    export let user = {};

    const createUser = async () => {
        const updateRoute = "http://localhost/desapeguei/back/create-user.php";
        const data = new FormData();
        data.append("nome", user.nome);
        data.append("senha", user.senha);
        data.append("email", user.email);
        data.append("cpf", user.cpf);
        data.append("telefone", user.telefone);
        let res = await fetch(updateRoute, {
            method: "POST",
            body: data,
        });
    };
</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
    <Menu />
</main>

<body>
    <div class="user container">
        <div class="Inputs">
            <h1 style="text-align: center;">Junte-se a nós!</h1>
            <form action="">
                <label for="nome">Nome completo</label>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    class="inputUser"
                    placeholder="Insira seu nome"
                    required
                    bind:value={user.nome}
                />
                <br />
                <br />
                <label for="cpf">CPF</label>
                <input
                    type="text"
                    name="cpf"
                    id="cpf"
                    class="inputUser"
                    placeholder="Insira seu CPF"
                    required
                    bind:value={user.cpf}
                />
                <br />
                <br />
                <label for="telefone">Telefone</label>
                <input
                    type="number"
                    name="telefone"
                    id="telefone"
                    class="inputUser"
                    placeholder="Insira seu número"
                    required
                    bind:value={user.telefone}
                />
                <br />
                <br />
                <label for="email">E-mail</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="inputUser"
                    placeholder="Insira seu número"
                    bind:value={user.email}
                    required
                />
                <br />
                <br />
                <label for="senha">Senha</label>
                <input
                    type="password"
                    name="senha"
                    id="senha"
                    class="inputUser"
                    placeholder="Insira sua senha"
                    bind:value={user.senha}
                    required
                />
                <br />
                <br />
                <label for="confirmar senha">Confirmar senha</label>
                <input
                    type="password"
                    name="confirmar senha"
                    id="confirmar senha"
                    class="inputUser"
                    placeholder="Insira sua senha novamente"
                    required
                />
                <button on:click={createUser} type="submit" class="signIn">Cadastre-se</button>
            </form>
        </div>
        <div class="imagem">
            <img src="imagens/Caba_imagi.jpg" alt="Caba da caixa" />
        </div>
    </div>
</body>

<style>
    body {
        margin: 0;
        background-color: white;
        font-family: sans-serif;
    }

    .container {
        width: 45%;
        background-color: white;
        margin: 4rem auto 0 auto;
        display: flex;
        justify-content: space-between;
        box-shadow: 10px -10px #2596be;
        border: 2px solid #2596be;
    }

    .container img {
        height: 670px;
    }

    input {
        width: 100%;
        padding: 8px 0px;
        margin: 2px 0;
        box-sizing: border-box;
    }

    label {
        font-size: 15px;
    }

    .signIn {
        width: 100%;
        border: none;
        padding: 10px 0px;
        margin: 10px 0;
        box-sizing: border-box;
        font-family: "Trebuchet MS";
        font-size: large;
        background-color: #2596be;
    }
</style>
