import Home from './Routes/Home.svelte';
import Login from './Routes/Login.svelte';
import Caixinha from './Routes/Caixinha.svelte';
import Cadastro from './Routes/Cadastro.svelte';
import Recuperarsenha from "./Routes/Recuperarsenha.svelte"

const routes = {
    '/' : Home,
    '/login' : Login,
    '/caixinha' : Caixinha,
    '/cadastro' : Cadastro,
    '/recuperar' : Recuperarsenha
}

export default routes;