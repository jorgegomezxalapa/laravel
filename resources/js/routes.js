import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router ({
	routes:[
	{
		path:'/dashboard',
		name:'home',
		component: require('./views/DashboardComponent.vue').default
	},
	
	],
	// mode:'history'
})