<script>
    import Menu from "./Menu.svelte";
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
<body class ="container">
    <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 w-25 mt-lg-5">
        <form>
            <input class="form-control" style="background:#BDE5EB; color:black"  placeholder="Pesquisar por suas doações...">
        </form>
    </div>
    <div class="mt-lg-5 pl-lg-5 me-lg-3" style="padding-right:120px ;">
        <h1>Ops... você ainda não fez nenhuma doação </h1>
    </div>
    <div class="col-12 col-lg-auto mb-3 mb-lg-3 me-lg-6 w-25  pl-lg-5" id="Cbotao">
        <button type="button" class='btn btn-dark btn btn-outline-primary w-75'>
            Doar
        </button>
    </div>
</body>



