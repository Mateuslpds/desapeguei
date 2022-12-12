<script>
    import { objs } from "../stores.js";
    import { onMount } from "svelte";
    import Objeto from "./Objeto.svelte";
   
    
    const deleteObjeto = async ( ) => {
        const deleteObj = "http://localhost/desapeguei/back/delete-objects.php";
        let res = await (deleteObjeto);
        const json = await res ();
         $objs = $objs.filter(
            item  => item.Objeto.OBJETO_ID != item.ClipboardItem.OBJETO_ID);
         
    }   
</script>

<div>
    <button on:click={deleteObjeto}>Deletar objeto</button>
</div>