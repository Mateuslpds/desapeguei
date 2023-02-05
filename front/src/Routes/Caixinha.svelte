<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import Agenda from "./Agenda.svelte";

    let objs = [];
    let doadorAgenda = [];
    let receptorAgenda = []; 
    let types = [];

    let search = null;
    let typefilter = null;

    let nome = "";
    let descricao = "";
    let imagem = "";
    let tipo = "";
    let cep = "";
    let hora = "";

    function openpop(){
        let popout = document.getElementById("popout");
        popout.classList.add("open-popout");
        console.log(popout)
    }
    function closepop(){
        let popout = document.getElementById("popout");
        popout.classList.remove("open-popout");
        console.log(popout)
    } 

    function openpopRea(){
        let popout = document.getElementById("reagendar-popout");
        popout.classList.add("reagendar-open-popout");
    }
    function closepopRea(){
        let popout = document.getElementById("reagendar-popout");
        popout.classList.remove("reagendar-open-popout");
    }

    const imgPath = "http://localhost/desapeguei/back/imagens/";

    $: visibleObjs = search
        ? objs.filter((obj) => {
              return (
                (obj.OBJ_NOME.match(`${search}.*`) || obj.OBJ_DESCRICAO.match(`${search}.*`)) &&
                (obj.OBJ_TIPO_ID == typefilter || typefilter == null)
              );
          })
        : objs;

    const loadObjs = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-user-objects.php";
        const res = await fetch(loadRoute, {
            credentials: "include",
        });
        objs = await res.json();
    };

    const cleanFilter = () => {
        search = null;
        typefilter = null;
    };

    onMount(() => {
        loadObjs();
        loadDoadorAgenda();
        loadReceptorAgenda();
        loadTypes();
    });

    const deleteOBJ = async (id, imagem) => {
        const data = new FormData();
        data.append("id", id);
        data.append("imagem", imagem);
        const deleteRoute = "http://localhost/desapeguei/back/delete-objects.php";
        const res = await fetch(deleteRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível deletar o objeto");
            return;
        }
        loadObjs();
    }

    const deleteDoadorAGD = async (id) => {
        const data = new FormData();
        data.append("id", id);
        const deleteRoute = "http://localhost/desapeguei/back/delete-doador-agendamento.php";
        const res = await fetch(deleteRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível deletar o objeto");
            return;
        }
        loadDoadorAgenda();
        loadReceptorAgenda();
    }

    const deleteReceptorAGD = async (id) => {
        const data = new FormData();
        data.append("id", id);
        const deleteRoute = "http://localhost/desapeguei/back/delete-receptor-agendamento.php";
        const res = await fetch(deleteRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível deletar o objeto");
            return;
        }
        loadDoadorAgenda();
        loadReceptorAgenda();
    }

    let idEdit = "";
    let imgEdit = "";

    const selectID = async (id, imagemEdit) => {
        idEdit = id;
        imgEdit = imagemEdit;
    }

    const editOBJ = async () => {
        const updateRoute = "http://localhost/desapeguei/back/update-object.php";
        const data = new FormData();
        data.append("id", idEdit);
        data.append("nome", nome);
        data.append("imgEdit", imgEdit);
        data.append("descricao", descricao);
        data.append("imagem", imagem[0]);
        data.append("tipo", tipo);
        const res = await fetch(updateRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível editar o objeto");
            return;
        }
        loadObjs();
    };

    const editAGD = async () => {
        const updateRoute = "http://localhost/desapeguei/back/agenda-reagenda.php";
        const data = new FormData()
        data.append("id", idEdit);
        data.append("cep", cep);
        data.append("hora",hora);
        const res = await fetch(updateRoute, {
            method: "POST",
            body: data,
            credentials: "include",
        })
        if(!res.ok){
            alert("erro: não foi possível editar o objeto");
            return;
        }
        loadDoadorAgenda();
        loadReceptorAgenda();
    };

    const loadDoadorAgenda = async () => {
        const loadDoadorAgendaRoute = "http://localhost/desapeguei/back/agenda-doador-read.php";
        const res = await fetch(loadDoadorAgendaRoute, {
        credentials: "include",
    });
        if(!res.ok){
            alert("erro: não foi possível carregar seus objetos doados com agendamento");
            return;
        }
        doadorAgenda = await res.json();
    };

    const loadReceptorAgenda = async () => {
        const loadReceptorAgendaRoute = "http://localhost/desapeguei/back/agenda-receptor-read.php";
        const res = await fetch(loadReceptorAgendaRoute, {
        credentials: "include",
    });
        if(!res.ok){
            alert("erro: não foi possível carregar os objetos dos quais você agendou");
            return;
        }
        receptorAgenda = await res.json();
    };
   
    const ConfirmarEnvio = async (id) => {
        const  ConfirmarEnvioRoute = "http://localhost/desapeguei/back/get-doador-confirmation.php?id=" + id;
        const res = await fetch(ConfirmarEnvioRoute, {
            credentials: "include",
        });
        if(!res.ok){
            alert("erro: não foi possível confirmar o envio")
            return;
        }
    };

    const confirmarRecebimento = async (id) => {
        const  ConfirmarRecebimentoRoute = "http://localhost/desapeguei/back/get-receptor-confirmation.php?id=" + id;
        const data = new FormData()
        data.append("id",id)
        const res = await fetch(ConfirmarRecebimentoRoute, {
            method: "POST",
            body: data,
            credentials: "include"
        });
        if(!res.ok){
            alert("erro: não foi possível confirmar o recebimento")
            return;
        }        
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
</script>

<svelte:head>
    <link rel="stylesheet" href="./src/caixinha.css">
</svelte:head>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
    <Menu/>
</main>
<body class ="box">
    <div class="pesquisar">
        <label class="caixinha" for="caixa">CAIXINHA</label>
        <input class="InPesquisar" type="search" placeholder="Pesquisar por suas doações." bind:value={search}>
        <select class="form-select" style="height: 30px;" name="tipo" id="tipo" bind:value={typefilter}>
            {#each types as type}
                <option value={type.TIPO_ID}>{type.TIPO_DESCRICAO}</option>
            {/each}
        </select>
        <button class="btn btn-outline-danger btn-sm" style="height: 32px;" on:click={cleanFilter}>Limpar filtro</button>
    <div class="Caixinhasgeral">
    {#if objs.length > 0}
    {#each visibleObjs as obj}
        <hr style="width:70%">
        <div class="Descrição">
            <img class="IMGplaceholder" src="{imgPath}{obj.OBJ_IMG}" alt="">
            <div class="xdelete">
                <span on:click={() => deleteOBJ(obj.OBJ_ID, obj.OBJ_IMG)}>&times;</span>
            </div>
            <button class="deletebotão" on:click={() => selectID(obj.OBJ_ID, obj.OBJ_IMG)} on:click={openpop}>Editar</button> 
            {obj.OBJ_NOME}
            <br>
            <div style="overflow: auto;">
                {obj.OBJ_DESCRICAO}
            </div>
        </div>
        {#each doadorAgenda.filter(agenda => agenda.AGD_STATUS != "fechado" && agenda.AGD_OBJ_ID == obj.OBJ_ID) as Dagenda}
        <div class="receptor">
            <br><b>DO RECEPTOR:</b> {Dagenda.USUARIO_NOME}
            <br><b>TELEFONE DO RECEPTOR:</b> {Dagenda.USUARIO_TEL}
            <br><b>CEP:</b> {Dagenda.AGD_CEP}
            <br><b>DATA E HORA EFETUADA:</b> {Dagenda.AGD_DATETIME}
                <br>
            <button class="btnreagendar" on:click={() => selectID(Dagenda.AGD_ID, Dagenda.AGD_DATETIME)} on:click={openpopRea}>Reagendar</button>
            <button class="btnconfirmar" name="submit" on:click={() => ConfirmarEnvio(Dagenda.AGD_ID)}>Confirmar</button>
            <span style="cursor: pointer; color:red; font-size: 25px;" on:click={() => deleteDoadorAGD(Dagenda.AGD_ID)}>&times;</span>
        </div>
        {/each}
    {/each}
    
    <div class="popout" id="popout">
        <h2>Edição de objeto</h2>
        <form on:submit|preventDefault={() => editOBJ()}>
            <label for="nome">Nome</label>
            <br>
            <input type="text" id="nome" bind:value={nome}>
            <br>
            <label for="descricao">Descrição</label>
            <br>
            <input type="text" id="descricao" bind:value={descricao}>
            <br>
            <label for="imagem">Insira uma nova imagem</label>
            <br>
            <input type="file" id="imagem" bind:files={imagem}>
            <br>
            <label for="tipo">Tipo</label>
            <br>
            <select class="tipobutton" name="tipo" id="tipo" bind:value={tipo}>
                {#each types as type}
                    <option value={type.TIPO_ID}>{type.TIPO_DESCRICAO}</option>
                {/each}
            </select>
            <center>
                <button class="btnpopout">Editar</button>
                <button class="fechar" on:click={closepop}>&times; Fechar</button>
            </center>
        </form>
    </div>
    <div class="reagendar-popout" id="reagendar-popout">
        <form on:submit|preventDefault={() => editAGD()}>
            <h2>Edite o local</h2>
            <label for="cep">CEP</label>
            <input type="text" placeholder="Insira o local" id="cep" bind:value={cep}>
            <label for="hora">Hora e Data</label>
            <input type="datetime-local" id="hora" bind:value={hora}>
            <center>
                <button class="btnpopout">Reagendar</button>
                <button class="fechar" on:click={closepopRea}>&times; Fechar</button>
            </center>
        </form>
    </div>
    {:else}
    <div class="imagem">
        <img src="imagens\sad.jpg" alt="gato na caixa"/>
    </div>
    <div class="mt-lg-5  me-lg-3" id="Ctexto1">
        <p>Sua caixinha está vazia!</p>
        <br>
        <p>Você ainda não fez nenhuma</p>
        <p>doação.</p>
    </div>
    {/if}
    {#each receptorAgenda.filter(agenda => agenda.AGD_STATUS != "entregue") as Ragenda}
        <div class="receptor">
            <br><b>DO DOADOR:</b> {Ragenda.USUARIO_NOME}
            <br><b>TELEFONE DO DOADOR:</b> {Ragenda.USUARIO_TEL}  
            <br><b>CEP:</b> {Ragenda.AGD_CEP}
            <br><b>DATA E HORA EFETUADA:</b> {Ragenda.AGD_DATETIME}
                <br>
                {#if Ragenda.AGD_STATUS == 'confirmado'}
                    <button class="btnconfirmar" name="submit2" on:click={() => confirmarRecebimento(Ragenda.AGD_ID)}>Confirmar entrega</button> 
                {:else if Ragenda.AGD_STATUS == 'entregue'}
                    <h3>Seu pedido foi entregue</h3>
                {:else}
                <button class="btnconfirmar" name="submit2" on:click={() => confirmarRecebimento(Ragenda.AGD_ID)}>Confirmar</button> 
                {/if}
            <span style="cursor: pointer; color:red; font-size: 25px;" on:click={() => deleteReceptorAGD(Ragenda.AGD_ID)}>&times;</span>
        </div> 
    {/each}
    {#if doadorAgenda.length > 0}
        {#each doadorAgenda.filter(agenda => agenda.AGD_STATUS == "entregue") as DoadorFechado} 
          <div>
            DOAÇÃO REALIZADA 
            <br><b>CEP DO ENCONTRO:</b> {DoadorFechado.AGD_CEP}
            <br><b>DATA E HORA EFETUADA:</b> {DoadorFechado.AGD_DATETIME}
            <br><b>NOME DO RECEPTOR:</b> {DoadorFechado.USUARIO_NOME}
            <br><b>TELEFONE DO RECEPTOR:</b> {DoadorFechado.USUARIO_TEL}
          </div>
        {/each}
    {/if} 
    {#if receptorAgenda.length > 0 }   
        {#each receptorAgenda.filter(agenda => agenda.AGD_STATUS == "entregue") as ReceptorFechado} 
          <div>
            DOAÇÃO REALIZADA 
            <br><b>CEP DO ENCONTRO:</b> {ReceptorFechado.AGD_CEP}
            <br><b>DATA E HORA EFETUADA:</b> {ReceptorFechado.AGD_DATETIME}
            <br><b>NOME DO DOADOR:</b> {ReceptorFechado.USUARIO_NOME}
            <br><b>TELEFONE DO DOADOR:</b> {ReceptorFechado.USUARIO_TEL}
          </div>
        {/each}
    {/if}
    <div class="textodoar">
        <i>Gostaria de fazer uma doação?</i>
    </div>
    <center>
    <div>
        <a href="/doarTela" use:link>
        <button type="button" class='btnEspecial'>
            Doar
        </button>
        </a>
    </div>
    </center>
</body>