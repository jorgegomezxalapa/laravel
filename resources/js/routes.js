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
		component: require('./views/solicitudes/SolicitudesComponent.vue').default
	},
	{
		path:'/nueva-solicitud',
		name:'nuevaSolicitud',
		component: require('./views/solicitudes/RegistroSolicitudesComponent.vue').default
	},
	{
		path:'/editar-solicitud/:id',
		name:'editarSolicitud',
		component: require('./views/solicitudes/RegistroSolicitudesComponent.vue').default
	},
	{
		path:'/cotizaciones',
		name:'cotizaciones',
		component: require('./views/cotizaciones/CotizacionesComponent.vue').default
	},
	{
		path:'/iniciar-cotizacion/:id',
		name:'iniciarCotizacion',
		component: require('./views/RegistroCotizacionComponent.vue').default
	},
	{
		path:'/registro-partidas/:id',
		name:'registroPartidas',
		component: require('./views/RegistropartidasComponent.vue').default
	},
	{
		path:'/acciones-cotizaciones/:id',
		name:'detalleCotizacion',
		component: require('./views/AccionesCotizacionComponent.vue').default
	},
	{
		path:'/almacen',
		name:'almacen',
		component: require('./views/AlmacenComponent.vue').default
	},
	{
		path:'/ventas',
		name:'ventas',
		component: require('./views/VentasComponent.vue').default
	},
	{
		path:'/clientes',
		name:'clientes',
		component: require('./views/clientes/ClientesComponent.vue').default
	},
	{
		path:'/nuevo-cliente',
		name:'nuevoCliente',
		component: require('./views/clientes/RegistroClientesComponent.vue').default
	},
	{
		path:'/editar-cliente/:id',
		name:'editarCliente',
		component: require('./views/clientes/RegistroClientesComponent.vue').default
	},
	{

		path:'/solicitantes',
		name:'solicitantes',
		component: require('./views/solicitantes/SolicitantesComponent.vue').default
	},
	{
		path:'/nuevo-solicitante',
		name:'nuevoSolicitante',
		component: require('./views/solicitantes/RegistroSolicitantesComponent.vue').default
	},
	{
		path:'/editar-solicitante/:id',
		name:'editarSolicitante',
		component: require('./views/solicitantes/RegistroSolicitantesComponent.vue').default
	},
	{
		path:'/tipos-de-venta',
		name:'utilidades',
		component: require('./views/tiposdeventa/TiposdeventaComponent.vue').default
	},
	{
		path:'/editar-tipo-de-venta/:id',
		name:'editarUtilidad',
		component: require('./views/tiposdeventa/RegistroTiposdeventaComponent.vue').default
	},
	{
		path:'/nuevo-tipo-de-venta',
		name:'nuevaUtilidad',
		component: require('./views/tiposdeventa/RegistroTiposdeventaComponent.vue').default
	},

	{
		path:'/formatos',
		name:'formatos',
		component: require('./views/FormatosComponent.vue').default
	},
	{
		path:'/empleados',
		name:'empleados',
		component: require('./views/empleados/EmpleadosComponent.vue').default
	},
	{
		path:'/nuevo-empleado',
		name:'nuevoEmpleado',
		component: require('./views/empleados/RegistroEmpleado.vue').default
	},
	{
		path:'/editar-empleado/:id',
		name:'editarEmpleado',
		component: require('./views/empleados/RegistroEmpleado.vue').default
	},
	{
		path:'/detalle-empleado/:id',
		name:'detalleEmpleado',
		component: require('./views/empleados/DetalleEmpleado.vue').default
	},
	{
		path:'/historial',
		name:'historial',
		component: require('./views/HistorialComponent.vue').default
	},

	],
	// mode:'history'
})
