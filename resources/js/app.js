
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
Vue.use(Vuetify);



Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);

import router from './routes'

const app = new Vue({
  el: '#app',
  router,
  vuetify: new Vuetify(),
});
