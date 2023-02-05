<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { loop_guard } from "svelte/internal";

    let infos = [];
    let datahora = "";

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
        agenDado.append("datahora", datahora);
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

<head>
    <title>ViaCEP Webservice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     Adicionando Javascript 
    <script>

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').innerHTML=(conteudo.logradouro);
            document.getElementById('bairro').innerHTML=(conteudo.bairro);
            document.getElementById('cidade').innerHTML=(conteudo.localidade);
            document.getElementById('uf').innerHTML=(conteudo.uf);
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').innerHTML="...";
                document.getElementById('bairro').innerHTML="...";
                document.getElementById('cidade').innerHTML="...";
                document.getElementById('uf').innerHTML="...";
                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            }
        }
    };
    </script>
</head>

<body>
    <Menu></Menu>
    <div class="container">
        <div class="obj-box">
        {#each infos as info}
            <img class="obj-image" src="{imgPath}{info.OBJ_IMG}" alt="" />
            <div class="obj-info">
                <h3 class="obj-name">{info.OBJ_NOME}</h3>
                <p class="obj-desc">Descrição: {info.OBJ_DESCRICAO}</p>
                <div class="user-info">                
                    <h5>Informações do Doador: </h5>
                    <h6>Nome: {info.USUARIO_NOME}</h6>
                    <h6>E-mail: {info.USUARIO_EMAIL}</h6>
                    <h6>Telefone: {info.USUARIO_TEL}</h6>
                </div>
                <div>
                    <h5 onLoad={pesquisacep(info.OBJ_CEP.toString())}><strong>Local de encontro:</strong></h5>
                    <h6>CEP: <span>{info.OBJ_CEP}</span></h6>
                    <h6>Rua: <span id="rua"></span></h6>
                    <h6>Bairro: <span id="bairro"></span></h6>
                    <h6>Cidade: <span id="cidade"></span></h6>
                    <h6>Estado: <span id="uf"></span></h6>
                </div>
            </div>
        {/each}
        </div>
        <div class="agd-box">
            <h1 class="agd-title">Realize seu agendamento</h1>
            <form class="agd-form" on:submit|preventDefault={agendaCreate}>
                <label for="">Insira a data e a hora em que você deseja agendar</label>
                <input type="datetime-local" id="hora" bind:value={datahora}>
                <div class="cep-results">
                    <label style="float: left; width: 30%">Rua:
                    <input name="rua" type="text" id="rua" size="60" /></label>
                    <label style="float: left; width: 30%">Bairro:
                    <input name="bairro" type="text" id="bairro" size="40" /></label>
                    <label style="float: left; width: 30%">Cidade:
                    <input name="cidade" type="text" id="cidade" size="40" /></label>
                    <label style="float: left; width: 10%">Estado:
                    <input name="uf" type="text" id="uf" size="2" /></label>
                </div>
                <button class="btn btn-primary">Confirmar agendamento</button>
            </form>
        </div>
    </div>
    <br><br><br><br>
</body>

<style>
    body{
        background-color: #ebebeb;
    }

    .container{
        margin-top: 5rem;
        width: 60%;
        padding: 10px;
        border-radius: 0.3rem;
        background-color: white;
    }

    .obj-box{
        display: flex;
    }

    .obj-image{
        margin: 2rem;
        width: 50%;
        object-fit: contain;
        align-self: flex-start;
    }

    .obj-info{
        margin-top: 2rem;
        margin-right: 2rem;
        flex: 1 1 auto;
    }

    .obj-name{
        font-weight: bold;
    }

    .obj-desc{
        line-height: 1.43em;
        margin-top: 8px;
        margin-bottom: 1rem;
        font-size: 16px;
        color: rgba(0,0,0,.9);;
        word-break: break-all;
    }

    .user-info > h5{
        font-weight: bold;
    }

    .agd-title{
        margin-left: 2rem;
    }

    .agd-form{
        margin-left: 2rem;
    }

    .cep-results{
        display: none;
    }

    .btn{
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
</style>