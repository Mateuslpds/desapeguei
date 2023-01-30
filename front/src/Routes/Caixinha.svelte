<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { dataset_dev, element, prevent_default } from "svelte/internal";
    import Agenda from "./Agenda.svelte";

    let objs = [];
    let doadorAgenda = [];
    let receptorAgenda = []; 

    let nome = "";
    let descricao = "";
    let imagem = "";
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

    const imgPath = "http://localhost/desapeguei/back/imagens/";

    const loadObjs = async () => {
        const loadRoute = "http://localhost/desapeguei/back/get-user-objects.php";
        const res = await fetch(loadRoute, {
            credentials : "include",
        });
        if (!res.ok) {
            alert("erro: você não está logado");
            return;
        }
        objs = await res.json();
        console.log(objs.length)
    };

    onMount(() => {
        loadObjs();
        loadDoadorAgenda();
        loadReceptorAgenda();
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
        <form>
            <label class="caixinha" for="caixa">CAIXINHA</label>
            <input class="InPesquisar" type="search" placeholder="Pesquisar por suas doações.">
        </form>
    <div class="Caixinhasgeral">
    {#if objs.length > 0}
    {#each objs as obj}
        <div class="Descrição">
            {obj.OBJ_NOME}
            {obj.OBJ_DESCRICAO}
            <img class="IMGplaceholder" src="{imgPath}{obj.OBJ_IMG}" alt="">
            <div class="xdelete">
                <span on:click={() => deleteOBJ(obj.OBJ_ID, obj.OBJ_IMG)}>&times;</span>
            </div>
            <button class="deletebotão" on:click={() => selectID(obj.OBJ_ID, obj.OBJ_IMG)} on:click={openpop}>Editar</button> 
        </div>
    {/each}
    {#each doadorAgenda.filter(agenda => agenda.AGD_STATUS != "fechado") as Dagenda}
        <div>
            <b>DO RECEPTOR:</b> {Dagenda.USUARIO_NOME}
            <b>TELEFONE DO RECEPTOR:</b> {Dagenda.USUARIO_TEL}
            <b>CEP:</b> {Dagenda.AGD_CEP}
            <b>DATA E HORA EFETUADA:</b> {Dagenda.AGD_DATETIME}
        <button on:click={() => selectID(Dagenda.AGD_ID, Dagenda.AGD_DATETIME)}>Reagendar</button>
        <span style="cursor: pointer; color:red; font-size: 20px;" on:click={() => deleteDoadorAGD(Dagenda.AGD_ID)}>&times;</span>
    </div>
    <div>
    <button name="submit" on:click={() => ConfirmarEnvio(Dagenda.AGD_ID)}> confirmar</button>
    </div>
    {/each}
    <div class="popout" id="popout">
        <h2>Edição de objeto</h2>
        <form on:submit|preventDefault={() => editOBJ()}>
            <input type="text" id="nome" bind:value={nome}>
            <input type="text" id="descricao" bind:value={descricao}>
            <input type="file" id="imagem" bind:files={imagem}>
            <button class="EditarPopout" on:click={closepop}>Editar</button> 
        </form>
    </div>
        <form on:submit|preventDefault={() => editAGD()}>
            <input type="text" id="cep" bind:value={cep}>
            <input type="datetime-local" id="hora" bind:value={hora}>
            <button class="Editar">Reagendar</button>
        </form>
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
    {#each receptorAgenda.filter(agenda => agenda.AGD_STATUS != "fechado") as Ragenda}
        <div>
            <b>DO DOADOR:</b> {Ragenda.USUARIO_NOME}
            <b>TELEFONE DO DOADOR:</b> {Ragenda.USUARIO_TEL}  
            <b>CEP:</b> {Ragenda.AGD_CEP}
            <b>DATA E HORA EFETUADA:</b> {Ragenda.AGD_DATETIME}
            <span style="cursor: pointer; color:red; font-size: 20px;" on:click={() => deleteReceptorAGD(Ragenda.AGD_ID)}>&times;</span>
        </div>
        <button name="submit2" on:click={() => confirmarRecebimento(Ragenda.AGD_ID)}> confirmar</button>  
    {/each}
    {#if doadorAgenda.length > 0}
        {#each doadorAgenda.filter(agenda => agenda.AGD_STATUS == "fechado") as DoadorFechado} 
          <div class="Doador">
              DOAÇÃO REALIZADA 
            <b>CEP DO ENCONTRO:</b> {DoadorFechado.AGD_CEP}
            <b>DATA E HORA EFETUADA:</b> {DoadorFechado.AGD_DATETIME}
            <b>NOME DO RECEPTOR:</b> {DoadorFechado.USUARIO_NOME}
            <b>TELEFONE DO RECEPTOR:</b> {DoadorFechado.USUARIO_TEL}
          </div>
        {/each}
    {/if} 
    {#if receptorAgenda.length > 0 }   
        {#each receptorAgenda.filter(agenda => agenda.AGD_STATUS == "fechado") as ReceptorFechado} 
          <div class="Receptor">
              DOAÇÃO REALIZADA 
            <b>CEP DO ENCONTRO:</b> {ReceptorFechado.AGD_CEP}
            <b>DATA E HORA EFETUADA:</b> {ReceptorFechado.AGD_DATETIME}
            <b>NOME DO DOADOR:</b> {ReceptorFechado.USUARIO_NOME}
            <b>TELEFONE DO DOADOR:</b> {ReceptorFechado.USUARIO_TEL}
          </div>
        {/each}
    {/if}
    <div class="textodoar">
        Gostaria de fazer uma doação?
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