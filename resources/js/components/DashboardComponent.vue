<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      class="px-3"
    >
    <v-btn
      block
      class="mt-3"
      outlined
      
    >
      Administrador
    </v-btn>
    <v-divider></v-divider>
    <v-list
        nav
      >

        <v-list-item-group
          v-model="selectedItem"
          color="primary"
        >
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon large @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="font-weight-black mr-3 hidden-sm-and-down">JVX SERP PRO</v-toolbar-title>
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
              <v-avatar
                color="brown"
              >
                <span class="white--text headline">{{ user.initials }}</span>
              </v-avatar>
              <h3>Soy notificaciones</h3>
              <p class="caption mt-1">
                {{ user.email }}
              </p>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
              >
                Editar Cuenta
              </v-btn>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
              >
                Cerrar Sesión
              </v-btn>
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
                color="brown"
              >
                <span class="white--text headline">{{ user.initials }}</span>
              </v-avatar>
              <h3>{{ user.fullName }}</h3>
              <p class="caption mt-1">
                {{ user.email }}
              </p>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
              >
                Editar cuenta
              </v-btn>
              <v-divider class="my-3"></v-divider>
              <v-btn
                depressed
                rounded
                text
              >
                Cerrar Sesión
              </v-btn>
            </div>
          </v-list-item-content>
        </v-card>
      </v-menu>
    </v-app-bar>
    

    <v-main>
      <!--  -->

    </v-main>
    <v-footer padless>
    <v-col
      class="text-center"
      cols="12"
    >
      SISTEMA DE PLANIFICACIÓN DE RECURSOS <strong>© {{ new Date().getFullYear() }}</strong>
    </v-col>
  </v-footer>
  </v-app>
</template>

<script>
  export default {
    data: () => ({ 
      drawer: null,
      folio: null,
         messages: 0,
        show: false,
     user: {
        initials: 'JVX',
        fullName: 'Nombre Usuario',
        email: 'Rol de usuario',

      },
      selectedItem: 0,
      items: [
      { text: 'Dashboard', icon: 'mdi-devices' },
        { text: 'Solicitudes', icon: 'mdi-import' },
         { text: 'Cotizaciones', icon: 'mdi-file-send-outline' },
         { text: 'Ventas', icon: 'mdi-account-cash-outline' },
        { text: 'Clientes', icon: 'mdi-account-badge-horizontal-outline' },
        { text: 'Utilidades', icon: 'mdi-file-percent-outline' },
        { text: 'Formatos', icon: 'mdi-file-pdf-box-outline' },
        { text: 'Empleados', icon: 'mdi-account-box-multiple-outline' },
        { text: 'Historial', icon: 'mdi-history' },
      ],
       
       }),
    watch: {
      
    },
    methods: {
      buscarFolio(){
        console.log("buscando folio")
      }
      
    },
  }
</script>