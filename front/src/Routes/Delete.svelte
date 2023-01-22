<script>
    import { objs } from "../stores.js";
    import { onMount } from "svelte";
   
    
    const deleteObjeto = async ( ) => {
        const deleteObj = "http://localhost/desapeguei/back/delete-objects.php";
        let res = await (deleteObjeto);
        const json = await res();
    }   
</script>

<div>
    <button on:click={deleteObjeto}>Deletar objeto</button>
</div>