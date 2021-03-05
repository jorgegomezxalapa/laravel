
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
Vue.use(Vuetify);



Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('cards-dashboard', require('./components/DashboardCardsComponent.vue').default);
Vue.component('tables-dashboard', require('./components/DashBoardTablesComponent.vue').default);
Vue.component('registro-inventario', require('./views/RegistroInventarioComponent.vue').default);

Vue.component('componente-clientes', require('./views/ClientesComponent.vue').default);
Vue.component('componente-solicitantes', require('./views/SolicitantesComponent.vue').default);
Vue.component('componente-solicitudes', require('./views/SolicitudesComponent.vue').default);

import router from './routes'

const app = new Vue({
  el: '#app',
  router,
  vuetify: new Vuetify(),
});
