<!-- <template>
  <v-app id="inspire">
    <v-system-bar app>
      <v-spacer></v-spacer>

      <v-icon>mdi-square</v-icon>

      <v-icon>mdi-circle</v-icon>

      <v-icon>mdi-triangle</v-icon>
    </v-system-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-sheet
        color="grey lighten-4"
        class="pa-4"
      >
        <v-avatar
          class="mb-4"
          color="grey darken-1"
          size="64"
        ></v-avatar>

        <div>john@vuetifyjs.com</div>
      </v-sheet>

      <v-divider></v-divider>

      <v-list>
        <v-list-item
          v-for="[icon, text] in links"
          :key="icon"
          link
        >
          <v-list-item-icon>
            <v-icon>{{ icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container
        class="py-8 px-6"
        fluid
      >
        <v-row>
          <v-col
            v-for="card in cards"
            :key="card"
            cols="12"
          >
            <v-card>
              <v-subheader>{{ card }}</v-subheader>

              <v-list two-line>
                <template v-for="n in 6">
                  <v-list-item

                    :key="n"
                  >
                    <v-list-item-avatar color="grey darken-1">
                    </v-list-item-avatar>

                    <v-list-item-content>
                      <v-list-item-title>Message {{ n }}</v-list-item-title>

                      <v-list-item-subtitle>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil repellendus distinctio similique
                      </v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>

                  <v-divider
                    v-if="n !== 6"
                    :key="`divider-${n}`"
                    inset
                  ></v-divider>
                </template>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      cards: ['Today', 'Yesterday'],
      drawer: null,
      links: [
        ['mdi-inbox-arrow-down', 'Inbox'],
        ['mdi-send', 'Send'],
        ['mdi-delete', 'Trash'],
        ['mdi-alert-octagon', 'Spam'],
      ],
    }),
  }
</script> -->

<template>
  <v-app>
  

  <v-app-bar app class="d-flex justify-center">
    Sistema de planificación de recursos empresariales
  </v-app-bar>

  
  <v-main>

   
    <v-container fluid>
      <v-card
        class="mx-auto my-1"
        max-width="374"
      >
   
   <img :src="'../public/img/profile.png'" width="100%" >

    <v-card-title>Ingresa con tus datos personales</v-card-title>
    <validation-observer
    ref="observer"
    v-slot="{ invalid }"
  >
   <form @submit.prevent="submit">
    <v-card-text>

      <v-row>
        <v-col
            cols="12"
            class="personalizado"
          >
          <validation-provider
            v-slot="{ errors }"
            name="Correo electrónico"
            rules="email|required"
          >
            <v-text-field
              v-model="email"
              filled
              :error-messages="errors"
              label="Correo electrónico"
              autocomplete="new-password"
            ></v-text-field>
             </validation-provider>
          </v-col>
          <v-col
            cols="12"
            class="personalizado"
          >
           <validation-provider
        v-slot="{ errors }"
        name="Contraseña"
        rules="required"
      >
            <v-text-field
              v-model="password"
              filled
              :error-messages="errors"
              label="Contraseña"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              autocomplete="new-password"
              @click:append="show1 = !show1"
            ></v-text-field>
          </validation-provider>
          </v-col>
      </v-row>
    </v-card-text>

    <v-card-text class="d-flex justify-center">
      <div>¿Olvidaste tu contraseña?</div>
    </v-card-text>

    <v-card-actions>
     <v-btn color="primary" type="submit" block>
    Ingresar
  </v-btn>
      
    </v-card-actions>
  </form>
  </validation-observer>
  </v-card>
    </v-container>
  </v-main>

  <v-footer app class="d-flex justify-center">
    <!-- -->Sistema de planificación de recursos empresariales- Gsureste ©{{ new Date().getFullYear() }} Derechos Reservados
  </v-footer>
</v-app>
</template>

<script>
  const axios = require('axios');
  import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  // import swal from 'sweetalert';

  setInteractionMode('eager')
  extend('digits', {
    ...digits,
    message: '{_field_} needs to be {length} digits. ({_value_})',
  })
  extend('required', {
    ...required,
    message: '{_field_} no puede quedarse vacío',
  })
  extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
  })
  extend('regex', {
    ...regex,
    message: '{_field_} {_value_} does not match {regex}',
  })
  extend('email', {
    ...email,
    message: 'El formato de email debe ser válido',
  })
  export default {
    components: {
      ValidationProvider,
      ValidationObserver,
    },
    data: () => ({
      email: null,
      password: null,
      show1: false,
    }),
    methods: {
      async submit (evt) {
        evt.preventDefault();
      
        const result = await this.$refs.observer.validate()
        if (result) {
         this.login()
        }

        // this.$refs.observer.validate()
        // console.log(this.$refs.observer.validate())
      },
      clear () {
        this.email = null
        this.password = null
        this.$refs.observer.reset()
      },
      login(){
       axios({
        method: 'post',
        url: 'authenticate',
        data: {
          email: this.email,
          password: this.password
        }
      })
      .then(function (response) {
        console.log("redirigir")
        window.location.href = 'http://localhost/erpgsureste/public/inicio';
      })
      .catch(function (error) {

       // swal("Acceso incorrecto!", "Ingresa los datos de usuario correctos!", "warning");

      })


      },
    },
  }
</script>

<codepen-resources lang="json">
  {
    "js": ["https://cdn.jsdelivr.net/npm/vee-validate@3.x/dist/vee-validate.js"]
  }
</codepen-resources>
<style type="text/css">
  .personalizado {
    padding: 8px!important;
  }
</style>

