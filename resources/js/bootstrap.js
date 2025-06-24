//Configure Axios et attache l’instance à window.axios pour d’éventuelles requêtes HTTP.
//fetch() est intégré dans le navigateur, 
// mais Axios rend les choses plus simples, lisibles et puissantes.

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';