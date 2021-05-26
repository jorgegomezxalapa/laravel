<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      app
      color="grey lighten-4"

    >
    <v-list>
        

        <v-list-item link>
          <v-list-item-content>
            <v-list-item-title class="title">
              MENÚ PRINCIPAL
            </v-list-item-title>
            <v-list-item-subtitle class="mt-3">{{this.perfil.name}}</v-list-item-subtitle>
            <v-list-item-subtitle class="mt-2">{{this.perfil.rol}}</v-list-item-subtitle>
            <v-list-item-subtitle></v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

      </v-list>
    <v-divider></v-divider>
    <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="selectedItem"
          color="primary"
        >
          <v-list-item
             v-for="(item, i) in items"
            :key="i"
            @click="enrutar(item.url)"
          >
            

            <v-list-item-content>
              <v-list-item-title v-text="item.text"></v-list-item-title>
            </v-list-item-content>
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      
    

   
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon large @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="font-weight-black mr-3 hidden-sm-and-down">ÁREA DE TRABAJO</v-toolbar-title>
    <v-responsive max-width="65%">

          <v-text-field
              v-model="folio"
              label="Buscar Folio"
              append-icon="mdi-magnify"
              dense
              flat
              hide-details
              rounded
              solo
              @click:append="buscarFolio"
              class=""
            ></v-text-field>

        </v-responsive>
   <v-spacer></v-spacer>


      <v-menu
        bottom
        min-width="200px"
        rounded
        offset-y
      >
        <template v-slot:activator="{ on }">
          <v-btn
            icon
            x-large
            v-on="on"
          >
            <v-badge
        :content="messages"
        :value="messages"
        color="green"
        overlap
      >
        <v-icon>
         mdi-bell-outline
        </v-icon>
      </v-badge>
          </v-btn>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class="mx-12 text-center">

            <p>panel de notificaciones</p>
            </div>
          </v-list-item-content>
        </v-card>
      </v-menu>

    <v-menu
        bottom
        min-width="200px"
        rounded
        offset-y
      >
        <template v-slot:activator="{ on }">
          <v-btn
            icon
            x-large
            v-on="on"
          >
            <v-icon dark>
         mdi-account-circle
      </v-icon>
          </v-btn>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class="mx-12 text-center">
             <v-avatar
                  size="65px"
                  class="mb-3"
                >
                  <img

                    alt="Avatar"
                    src="https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049_960_720.png"
                  >

                </v-avatar>
              <h3>MI PERFIL</h3>
                            <p class="body-1 mt-1 mb-3">
                {{ perfil.name }}
              </p>
              <p class="body-1 mt-1">
                {{ perfil.email }}
              </p>
              <v-divider class="my-3"></v-divider>

    <v-row class="justify-center mt-3 mb-5">
       <v-btn
      rounded

     outlined
      color="black"
    >
      Administrar perfil
    </v-btn>
    </v-row>
     <v-row class="justify-center mt-3 mb-5">
       <v-btn
      rounded

      outlined
      color="black"
      @click="logout()"
    >
      Salir de la cuenta
    </v-btn>
    </v-row>
            </div>
          </v-list-item-content>
        </v-card>
      </v-menu>
    </v-app-bar>


    <v-main>
   <transition name="slide-fade" mode="out-in">
      <router-view :key="$route.fullPath"></router-view>
    </transition>
    </v-main>
    <v-footer app>
    <v-col
      class="text-center"
      cols="12"
      color="grey lighten-4"
    >
      SISTEMA DE PLANIFICACIÓN DE RECURSOS <strong>© {{ new Date().getFullYear() }}</strong>
    </v-col>
  </v-footer>
  </v-app>
</template>

<script>
  const axios = require('axios');
  export default {
    data: () => ({
      drawer: null,
      folio: null,
         messages: 0,
        show: false,
        perfil:{},

      selectedItem: 0,
      items: [
      { text: 'DASHBOARD', icon: 'mdi-devices' , url:'dashboard'},
        { text: 'SOLICITUDES', icon: 'mdi-import' , url:'solicitudes'},
         { text: 'COTIZACIONES', icon: 'mdi-file-send-outline' , url:'cotizaciones'},
         { text: 'VENTAS', icon: 'mdi-cash' , url:'ventas'},
         { text: 'ALMACÉN', icon: 'mdi-window-closed' , url:'almacen'},
        { text: 'CLIENTES', icon: 'mdi-account-badge-horizontal-outline' , url:'clientes'},
         { text: 'SOLICITANTES', icon: 'mdi-account-badge-horizontal-outline' , url:'solicitantes'},
        { text: 'TIPOS DE VENTA', icon: 'mdi-file-percent-outline' , url:'utilidades'},
        { text: 'FORMATOS PDF', icon: 'mdi-file-pdf-box-outline' , url:'formatos'},
        { text: 'EMPLEADOS', icon: 'mdi-account-box-multiple-outline' , url:'empleados'},
        { text: 'HISTORIAL', icon: 'mdi-history' , url:'historial'},
      ],

       }),
    watch: {

    },
    methods: {
      buscarFolio(){

      },
      cargarMain(){
        // this.$router.push({ path: 'dashboard' }).catch(()=>{});
      },
      enrutar(url){
        this.$router.push({ name: url }).catch(()=>{});

      },
      async getperfil(){

        try {
            const response = await axios({
        method: 'get',
        url: 'getperfil',
      })
            // Success 🎉

            this.perfil = response.data
            this.perfil = response.data.data
            

            localStorage.idPerfil = this.perfil.id;


        } catch (error) {
            // Error 😨
            if (error.response) {
                /*
                 * The request was made and the server responded with a
                 * status code that falls out of the range of 2xx
                 */
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
                swal("Acceso incorrecto!", "Verifica que los datos sean correctos!", "warning");
            } else if (error.request) {

                /*
                 * The request was made but no response was received, `error.request`
                 * is an instance of XMLHttpRequest in the browser and an instance
                 * of http.ClientRequest in Node.js
                 */
                 swal("Eror!", "Ha ocurrido un error de conexión!", "warning");
                console.log("console.log 5",error.request);
            } else {
                swal("Eror!", "Ha ocurrido un error de conexión!", "warning");
                // Something happened in setting up the request and triggered an Error
                console.log("console.log 6", error.message);
            }
            console.log(error);
            this.clear()
            this.desactivar = false
        }



      },
      async logout(){



        try {
            const response = await axios({
        method: 'get',
        url: 'logout',
      })
            // Success 🎉
            window.location.href = route('logout');



        } catch (error) {
            // Error 😨
            if (error.response) {
                /*
                 * The request was made and the server responded with a
                 * status code that falls out of the range of 2xx
                 */
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
                swal("Acceso incorrecto!", "Verifica que los datos sean correctos!", "warning");
            } else if (error.request) {

                /*
                 * The request was made but no response was received, `error.request`
                 * is an instance of XMLHttpRequest in the browser and an instance
                 * of http.ClientRequest in Node.js
                 */
                 swal("Eror!", "Ha ocurrido un error de conexión!", "warning");
                console.log("console.log 5",error.request);
            } else {
                swal("Eror!", "Ha ocurrido un error de conexión!", "warning");
                // Something happened in setting up the request and triggered an Error
                console.log("console.log 6", error.message);
            }
            console.log(error);

        }



      },

    },
    beforeMount: function () {
    this.cargarMain()

  },
  mounted: function () {
  this.getperfil()
}
  }
</script>
<style type="text/css">
  tbody tr:nth-of-type(odd) {
   background-color: rgba(0, 0, 0, .06) !important;
 }
 .theme--light.v-data-table thead tr:last-child th, 
   .theme--light.v-data-table tbody tr:not(:last-child) td:last-child,
   .theme--light.v-data-table tbody tr td,
   .theme--light.v-data-table tbody tr:not(:last-child) td:not(.v-data-table__mobile-row) {
      border-bottom: medium solid rgba(0,0,0,.12);
      border-left: medium solid rgba(0,0,0,.12);
      border-right: medium solid rgba(0,0,0,.12);
      border-left: medium solid rgba(0,0,0,.12);
   }

</style>
