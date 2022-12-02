<script>
    import { objs } from "../stores.js";
    import { onMount } from "svelte";
    import Objeto from "./Objeto.svelte";
    
    onMount( async() => {
        const url = "http://localhost/desapeguei/back/get-objects.php"
        let res = await fetch(url)
        res = await res.json()
        $objs = res.data
    })
</script>

<div id="objs">
    {#each $objs as obj}
        <Objeto {obj}/>
        <br>
    {/each}
</div>