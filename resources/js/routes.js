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
		path:'/ingreso',
		name:'ingreso',
		component: require('./components/LoginComponent.vue').default
	},
	{
		path:'/solicitudes',
		name:'solicitudes',
		component: require('./views/SolicitudesComponent.vue').default
	},
	{
		path:'/nueva-solicitud',
		name:'nuevaSolicitud',
		component: require('./views/RegistroSolicitudesComponent.vue').default
	},
	{
		path:'/cotizaciones',
		name:'cotizaciones',
		component: require('./views/CotizacionesComponent.vue').default
	},
	{
		path:'/capturar-cotizacion',
		name:'capturarCotizacion',
		component: require('./views/RegistroCotizacionComponent.vue').default
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
		path:'/nuevo-cliente',
		name:'nuevoCliente',
		component: require('./views/RegistroClientesComponent.vue').default
	},
	{

		path:'/solicitantes',
		name:'solicitantes',
		component: require('./views/SolicitantesComponent.vue').default
	},
	{
		path:'/nuevo-solicitante',
		name:'nuevoSolicitante',
		component: require('./views/RegistroSolicitantesComponent.vue').default
	},
	{
		path:'/utilidades',
		name:'utilidades',
		component: require('./views/UtilidadesComponent.vue').default
	},

	{
		path:'/nuevo-monto-utilidad',
		name:'nuevoMonto',
		component: require('./views/RegistroUtilidadMontoComponent.vue').default
	},
	{
		path:'/nueva-campania-utilidad',
		name:'nuevaCampania',
		component: require('./views/RegistroUtilidadCampaniaComponent.vue').default
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
		path:'/nuevo-empleado',
		name:'nuevoEmpleado',
		component: require('./views/RegistroEmpleado.vue').default
	},
	{
		path:'/editar-empleado/:id',
		name:'editarEmpleado',
		component: require('./views/RegistroEmpleado.vue').default
	},
	{
		path:'/detalle-empleado/:id',
		name:'detalleEmpleado',
		component: require('./views/DetalleEmpleado.vue').default
	},
	{
		path:'/historial',
		name:'historial',
		component: require('./views/HistorialComponent.vue').default
	},

	],
	// mode:'history'
})
