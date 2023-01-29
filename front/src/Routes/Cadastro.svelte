<script>
    import { link } from "svelte-spa-router";
    import Menu from "./Menu.svelte";

    export let user = {};

    let nome = "";
    let senha = "";
    let senha2 = "";
    let email = "";
    let cpf = "";
    let telefone = "";

    const createUser = async () => {
        if(senha != senha2) return;

        const create = "http://localhost/desapeguei/back/create-user.php";
        const data = new FormData();
        data.append("nome", nome);
        data.append("senha", senha);
        data.append("email", email);
        data.append("cpf", cpf);
        data.append("telefone", telefone);
        fetch(create, {
            method: "POST",
            body: data,
        });
    };

    function Senha() {
        var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
        };
    };

    function Confirmar() {
        var x = document.getElementById("confirmar senha");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
        };
    };  

</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<head>
    <script 
        src="https://kit.fontawesome.com/bc98966db5.js" 
        crossorigin="anonymous">
    </script>
</head>

<main>
    <Menu />
</main>

<body>
    <div class="user container">
        <div class="Inputs">
            <h1><b>Junte-se a nós!</b></h1>
            <form on:submit|preventDefault={createUser}>
                <label for="nome">Nome completo</label>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    class="inputUser"
                    placeholder="Insira seu nome"
                    maxlength= "70"
                    required
                    bind:value={nome}
                />
                <br />
                <label for="cpf">CPF</label>
                <input
                    type="text"
                    name="cpf"
                    id="cpf"
                    class="inputUser"
                    placeholder="Ex: xxx.xxx.xxx-xx"
                    maxlength= "14"
                    required
                    bind:value={cpf}
                />
                <br />
                <label for="telefone">Telefone</label>
                <input
                    type="tel"
                    name="telefone"
                    id="telefone"
                    class="inputUser"
                    placeholder="Ex: (xx) xxxxx-xxxx"
                    maxlength= "16"
                    required
                    bind:value={telefone}
                />
                <br />
                <label for="email">E-mail</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="inputUser"
                    placeholder="Ex: xaolinmatadordeporco@mail.com"
                    maxlength= "45"
                    bind:value={email}
                    required
                />
                <br />
                <label for="senha">Senha</label>
                    <input
                        type="password"
                        name="senha"
                        id="senha"
                        class="inputUser"
                        placeholder="Insira sua senha"
                        maxlength= "20"
                        bind:value={senha}
                        required
                    />
                <label class="passwordhide" for="showpass" ><b>Mostrar senha</b></label>
                    <input class="boxpasswordhide" type="checkbox" on:click={Senha}>
                <br />
                <label for="confirmar senha">Confirmar senha</label>
                <input 
                    type="password"
                    name="confirmar senha"
                    id="confirmar senha"
                    class="inputUser"
                    placeholder="Insira sua senha novamente"
                    maxlength= "20"
                    required
                    bind:value={senha2}
                />
                {#if senha != '' && senha != senha2}
                    <div style="color:red;">Senhas não conferem</div>
                {/if}
                <label class="passwordhide" for="showpass"><b>Mostrar senha</b></label>
                    <input class="boxpasswordhide" type="checkbox" on:click={Confirmar}>
                <button type="submit" class="signIn">Cadastre-se</button>
            </form>
        </div>
        <div class="imagem">
                <img src="imagens/Caba_imagi.jpg" alt="Caba da caixa" />
        </div>
    </div>
</body>

<style>
    *{
       box-sizing: border-box;
    }

    body {
        margin: 0;
        background-color: white;
        font-family: sans-serif;
    }

    h1 {
        text-align: center;
        margin: 10px;
        padding: 10px;
    }

    img {
        width: 100%;
        max-width: 100%;
    }

    input {
        width: 100%;
        padding: 7px 0px;
        box-sizing: border-box;
        text-indent: 14px;
        margin-bottom: 12px;
        border: 1px solid rgb(140, 139, 139);
        border-radius: 5px;
    }

    label {
        font-size: 15px;
        font-style: italic;
        padding-top: 10px;
        line-height: 4px;
    }
    
    .container {
        width: 45%;
        background-color: white;
        margin: 4rem auto 0 auto;
        display: flex;
        justify-content: space-between;
        box-shadow: 4px 4px 4px #2595bea1;
        border: 1px solid #2595bea1;
        border-radius: 10px;
    }

    .container img {
        height: 700px;
    }

    .passwordhide {
        padding-left: 10%;
        padding-right: 5px;
        font-size: 12px;
        line-height: 5px;
    }

    .boxpasswordhide {
        height: 15px;
        width: 15px;
        cursor: pointer;
    }

    .signIn {
        background-color: #2596be;
        box-sizing: border-box;
        width: 100%;
        padding: 10px 0px;
        margin: 15px 0px;
        border: none;
        font-family: "Verdana";
        font-size: large;
        border-radius: 8px;
        color: white;
        cursor: pointer;
    }

    .signIn:hover{
        background-color: #216e8a;
    }
</style>