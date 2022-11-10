import Home from './Routes/Home.svelte';
import Login from './Routes/Login.svelte';
import Caixinha from './Routes/Caixinha.svelte';
import Cadastro from './Routes/Cadastro.svelte';

const routes = {
    '/' : Home,
    '/login' : Login,
    '/caixinha' : Caixinha,
    '/cadastro' : Cadastro 
}

export default routes;