<script>
    import Menu from "./Menu.svelte";
</script>


<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>
<main>
    <Menu/>
</main>
<body class ="container">
    <div>
        <form>
            <input placeholder="Pesquisar por suas doações...">
        </form>
    </div>
    <div>
        <h1>Ops... você ainda não fez nenhuma doação </h1>
    </div>
    <div>
        <button type="button" class='.btn-large'>
            Doar
        </button>
    </div>
</body>



