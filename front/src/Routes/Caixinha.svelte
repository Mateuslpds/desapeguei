<script>
    import Menu from "./Menu.svelte";
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import { dataset_dev, prevent_default } from "svelte/internal";
    import Agenda from "./Agenda.svelte";

    let objs = [];
    let doadorAgenda = [];
    let receptorAgenda = []; 

    let descricao = "";
    let imagem = "";
    let cep = "";
    let hora = "";
    
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

   
    const ConfirmarEnvio = async () => {
        var Prdt_enviado = document.getElementById("P_enviado")
        if(Prdt_enviado.checked){
            const  ConfirmarEnvioRoute = "http://localhost/desapeguei/back/get-doador-confirmation.php";
            const res = await fetch(ConfirmarEnvioRoute, {
                credentials: "include",
            });
            if(!res.ok){
                alert("erro: não foi possível confirmar o envio")
                return;
            }
        }
    };

    const confirmarRecebimento = async (id) => {
        var Prdt_recebido = document.getElementById("P_recebido")
        if(Prdt_recebido.checked){
            const  ConfirmarRecebimentoRoute = "http://localhost/desapeguei/back/get-receptor-confirmation.php";
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
            <input class="inputdonate" type="search" placeholder="Pesquisar por suas doações.">
        </form>
    </div>
    {#if objs.length > 0}
    {#each objs as obj}
        <div>
            {obj.OBJ_DESCRICAO}
            <img src="{imgPath}{obj.OBJ_IMG}" alt="">
            <span style="cursor: pointer;" on:click={() => deleteOBJ(obj.OBJ_ID, obj.OBJ_IMG)}>&times;</span>
            <button on:click={() => selectID(obj.OBJ_ID, obj.OBJ_IMG)}>Editar</button>
        </div>
    {/each}
    {#each doadorAgenda.filter(agenda => agenda.AGD_STATUS != "fechado") as Dagenda}
        <div>
        DO RECEPTOR: {Dagenda.USUARIO_NOME}
        TELEFONE DO RECEPTOR: {Dagenda.USUARIO_TEL}
        CEP: {Dagenda.AGD_CEP}
        DATA E HORA EFETUADA :{Dagenda.AGD_DATETIME}
        <button on:click={() => selectID(Dagenda.AGD_ID, Dagenda.AGD_DATETIME)}>Reagendar</button>
        <span style="cursor: pointer;" on:click={() => deleteDoadorAGD(Dagenda.AGD_ID)}>&times;</span>
    </div>
    <div>
    <form>
        <label>
            <input type="checkbox" name = "confirmar" id="P_enviado"> produto enviado
        </label>
            <button name="submit" value="true" on:click={() => ConfirmarEnvio()}> confirmar</button>
    </form>
    </div>
    {/each}
        <form on:submit|preventDefault={() => editAGD()}>
            <input type="text" id="cep" bind:value={cep}>
            <input type="datetime-local" id="hora" bind:value={hora}>
            <button class="Editar">Reagendar</button>
        </form>
        <form on:submit|preventDefault={() => editOBJ()}>
            <input type="text" id="descricao" bind:value={descricao}>
            <input type="file" id="imagem" bind:files={imagem}>
            <button class="Editar">Editar</button>
        </form>
    {:else}
    <div class="imagem">
        <img src="imagens\sad.jpg" alt="gato na caixa"/>
    </div>
    <div class="mt-lg-5  me-lg-3 " id="Ctexto1">
        <p>Sua caixinha está vazia!</p>
        <br>
        <p>Você ainda não fez nenhuma</p>
        <p>doação.</p>
    </div>
    {/if}
    {#each receptorAgenda.filter(agenda => agenda.AGD_STATUS != "fechado") as Ragenda}
        <div>
          DO DOADOR: {Ragenda.USUARIO_NOME}
          TELEFONE DO DOADOR: {Ragenda.USUARIO_TEL}  
            CEP: {Ragenda.AGD_CEP}
            DATA E HORA EFETUADA: {Ragenda.AGD_DATETIME}
            <span style="cursor: pointer;" on:click={() => deleteReceptorAGD(Ragenda.AGD_ID)}>&times;</span>
        </div>

          <form>
                <label>
                    <input type="checkbox" name = "confirmarRecebimento" id="P_recebido">produto recebido
                </label>
                    <button name="submit2" value="true" on:click={() => confirmarRecebimento(Ragenda.AGD_ID)}> confirmar</button>
              
          </form>
    {/each}
    {#if doadorAgenda.length > 0}
        {#each doadorAgenda.filter(agenda => agenda.AGD_STATUS == "fechado") as DoadorFechado} 
          <div>
              DOAÇÃO REALIZADA 
            CEP DO ENCONTRO:{DoadorFechado.AGD_CEP}
            DATA E HORA EFETUADA:{DoadorFechado.AGD_DATETIME}
            NOME DO RECEPTOR:{DoadorFechado.USUARIO_NOME}
            TELEFONE DO RECEPTOR:{DoadorFechado.USUARIO_TEL}
          </div>
        {/each}
    {/if} 
    {#if receptorAgenda.length > 0 }   
        {#each receptorAgenda.filter(agenda => agenda.AGD_STATUS == "fechado") as ReceptorFechado} 
          <div>
              DOAÇÃO REALIZADA 
            CEP DO ENCONTRO:{ReceptorFechado.AGD_CEP}
            DATA E HORA EFETUADA:{ReceptorFechado.AGD_DATETIME}
            NOME DO DOADOR:{ReceptorFechado.USUARIO_NOME}
            TELEFONE DO DOADOR:{ReceptorFechado.USUARIO_TEL}
          </div>
        {/each}
    {/if}
    <div class="textodoar">
        Gostaria de fazer uma doação?
    </div>
    <div class="col-12 col-lg-auto mb-0 mb-lg-3 me-lg-6 w-25  pl-lg-5" id="Cbotao">
        <a href="/doarTela" use:link>
        <button type="button" class='btn btn-dark btn btn-outline-primary w-75'>
            Doar
        </button>
        </a>
    </div>
</body>