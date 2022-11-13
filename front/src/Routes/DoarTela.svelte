<script>
    import Menu from "./Menu.svelte";
</script>

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<main>
    <Menu />
</main>

<body class ="container  shadow-lg mt-5" id="BOXdoar">
    <form class="container row gy-5" id="BOXformgeral">
    <div class="form-group col-6">
        <label for="image">Adicione foto ao objeto</label>
        <input type="file" class="form-control" placeholder="escolha a foto em seu dispositivo">
    </div>
    <div class="form-group col-6">
        <label for="name">Insira o nome do objeto</label>
        <input type="text" class="form-control"  placeholder="nome do objeto...">
    </div>
    <div class="form-group col-6">
        <label for="dsrc"> Descrição</label>
        <input type="text" id="DOARdescri" class="form-control"  placeholder="insira aqui a descrição do objeto...">
    </div>
    <div class="form-group col-6">
        <label for="dsrc"> Tipo do produto</label>
         <select name="tipo">
            
         </select>
    </div>
    </form>
</body>
