<script>
    import { link } from "svelte-spa-router";
    import { onMount } from "svelte";
    import Menu from "./Menu.svelte";
    import { search } from "../stores.js";

    let objs = [];

    console.log($search);

    const imgPath = "http://localhost/desapeguei/back/imagens/";

    $: visibleObjs = $search ?
		objs.filter(obj => {
			return obj.OBJ_DESCRICAO.match(`${$search}.*`)
		}) : objs;

	onMount(async () => {
		const loadRoute = "http://localhost/desapeguei/back/get-objects.php";
        const res = await fetch(loadRoute, {
            credentials: "include",
        });
        objs = await res.json();
	});

    const getOBJ = async (obj) => {
        const loadRoute =
            "http://localhost/desapeguei/back/get-session-obj.php?obj=" + obj;
        await fetch(loadRoute, {
            credentials: "include",
        });
        console.log(loadRoute);
    };
</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
/>

<body>
    <Menu />

    {#each visibleObjs as obj}
        <div>
            {obj.OBJ_DESCRICAO}
            <img src="{imgPath}{obj.OBJ_IMG}" alt="" />
            <a href="/agendamento" use:link>
                <button on:click={() => getOBJ(obj.OBJ_ID)}> agendar</button>
            </a>
        </div>
    {/each}
</body>
