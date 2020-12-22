<template>
    <!-- App.vue -->

<v-app>
  <v-navigation-drawer  v-model="drawer"
        color=""
       app>
  
      <v-list>
        <!-- <v-list-item>
            <center>
                <v-list-item-avatar>
            <img :src="'https://cdn.pixabay.com/photo/2016/08/31/11/54/user-1633249_1280.png'" width="100%" class="my-2" >
          </v-list-item-avatar>
            </center>
          
        </v-list-item> -->

        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="title">
              ADMINISTRADOR
            </v-list-item-title>
            <v-list-item-subtitle>administracion@email.com</v-list-item-subtitle>
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

  <v-app-bar color="" app>
    
    <v-row>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
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
            <v-avatar
              color=""
              size="48"
            >
              <img :src="'https://cdn.pixabay.com/photo/2016/08/31/11/54/user-1633249_1280.png'" width="100%" class="my-2" >
            </v-avatar>
          </v-btn>
        </template>
        <v-card>
          <v-list-item-content class="justify-center">
            <div class="mx-auto text-center">
              <v-avatar
                color=""
              >
                <img :src="'https://cdn.pixabay.com/photo/2016/08/31/11/54/user-1633249_1280.png'" width="100%" class="my-2" >
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
                Mi perfil
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
    </v-row>

  </v-app-bar>

  <!-- Sizes your content based upon application components -->
  <v-main>

    <!-- Provides the application the proper gutter -->
    <v-container fluid>

      <!-- If using vue-router -->
      <!-- <router-view></router-view> -->
    </v-container>
  </v-main>

  <v-footer class="d-flex justify-center">
    <strong>G SURESTE © {{ new Date().getFullYear() }}</strong>
  </v-footer>
</v-app>
</template>

<script>
  export default {
    data () {
      return {
        drawer: null,
        items: [
        { text: 'Registrar solicitud', icon: 'mdi-folder-plus' },
         { text: 'Concentrado de cotizaciones', icon: 'mdi-folder-multiple' },
        { text: 'Información de clientes', icon: 'mdi-account-switch' },
        { text: 'Configuración de utilidad', icon: 'mdi-cash-multiple' },
        { text: 'Configuración de formatos', icon: 'mdi-file-pdf-box' },
        { text: 'Control de usuarios', icon: 'mdi-account-key' },
        { text: 'Más acciones', icon: 'mdi-laptop-windows' },
      ],
         user: {
        initials: 'ADMIN',
        fullName: 'Administrador',
        email: 'administracion@email.com',
      },
      }
    },
  }
</script>
