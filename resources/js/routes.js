import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router ({
	routes:[
	{
		path:'/',
		name:'dashboard',
		component: require('./views/DashboardComponent.vue').default
	},
	{
		path:'/solicitudes',
		name:'solicitudes',
		component: require('./views/SolicitudesComponent.vue').default
	},
	{
		path:'/cotizaciones',
		name:'cotizaciones',
		component: require('./views/CotizacionesComponent.vue').default
	},
	{
		path:'/ventas',
		name:'ventas',
		component: require('./views/VentasComponent.vue').default
	},
	{
		path:'/clientes',
		name:'clientes',
		component: require('./views/ClientesComponent.vue').default
	},
	{
		path:'/utilidades',
		name:'utilidades',
		component: require('./views/UtilidadesComponent.vue').default
	},
	{
		path:'/formatos',
		name:'formatos',
		component: require('./views/FormatosComponent.vue').default
	},
	{
		path:'/empleados',
		name:'empleados',
		component: require('./views/EmpleadosComponent.vue').default
	},
	{
		path:'/historial',
		name:'historial',
		component: require('./views/HistorialComponent.vue').default
	},
	
	],
	// mode:'history'
})