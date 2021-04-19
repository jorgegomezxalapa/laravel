
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
import es from "vuetify/es5/locale/es";
Vue.use(Vuetify);

import moment from 'moment';

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY')
    }
});



Vue.component('login-component', require('./views/login/LoginComponent.vue').default);
Vue.component('dashboard-component', require('./views/dashboard/DashboardComponent.vue').default);
Vue.component('dashboard-resumen', require('./views/dashboard/ResumenComponent.vue').default);
Vue.component('dashboard-cliente', require('./views/dashboard/ClienteComponent.vue').default);
Vue.component('dashboard-solicitante', require('./views/dashboard/SolicitanteComponent.vue').default);
Vue.component('dashboard-empleado', require('./views/dashboard/EmpleadoComponent.vue').default);
Vue.component('dashboard-razonsocial', require('./views/dashboard/RazonSocialComponent.vue').default);
Vue.component('datos-generales-cotizacion', require('./views/cotizaciones/DatosGeneralesComponent.vue').default);
Vue.component('trabajo-cotizacion', require('./views/cotizaciones/TrabajoCotizacionComponent.vue').default);
Vue.component('configuraciones-cotizacion', require('./views/cotizaciones/ConfiguracionesCotizacionComponent.vue').default);
Vue.component('partidas-component', require('./views/cotizaciones/PartidasComponent.vue').default);
Vue.component('totales-cotizacion', require('./views/cotizaciones/TotalesCotizacionComponent.vue').default);
Vue.component('acciones-cotizacion', require('./views/cotizaciones/AccionesCotizacionComponent.vue').default);

Vue.component('cards-dashboard', require('./components/DashboardCardsComponent.vue').default);
Vue.component('tables-dashboard', require('./components/DashBoardTablesComponent.vue').default);
Vue.component('registro-inventario', require('./views/RegistroInventarioComponent.vue').default);
Vue.component('registro-segmentacion', require('./views/RegistroSegmentacionComponent.vue').default);

Vue.component('componente-clientes', require('./views/ClientesComponent.vue').default);
Vue.component('componente-solicitantes', require('./views/SolicitantesComponent.vue').default);
Vue.component('componente-solicitudes', require('./views/SolicitudesComponent.vue').default);

Vue.component('gestion-razonsocial', require('./views/gestion/RazonSocialComponent.vue').default);
Vue.component('gestion-catalogos', require('./views/gestion/CatalogosComponent.vue').default);
Vue.component('gestion-formatos', require('./views/gestion/FormatosComponent.vue').default);

import router from './routes'

const app = new Vue({
  el: '#app',
  router,
  vuetify: new Vuetify({
    lang: {
        locales: { es },
        current: "es",
    },
}),
});
