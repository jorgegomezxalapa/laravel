<template>
  <v-app>
  

  <!-- <v-app-bar app class="d-flex justify-center">
    Sistema de planificación de recursos empresariales
    
  </v-app-bar> -->

  
  <v-main>

   
    <v-container fill-height fluid>
      <v-card
        class="mx-auto rounded-xl py-5 px-2"
        max-width="380"
        align="center"
        justify="space-around"


      >
   
   <img :src="'img/profile.png'" width="100%">

    <v-card-title><h5><strong>Ingresa con tus datos personales</strong></h5></v-card-title>
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
              outlined
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
              outlined
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

    <v-card-actions>
     <v-btn color="primary" type="submit" block :disabled="desactivar">
    <strong>Ingresar</strong>
  </v-btn>

      
    </v-card-actions>
  </form>
  </validation-observer>

  <v-card-text class="d-flex justify-center">
      <div>
         <v-btn text>
          ¿Olvidaste tu contraseña?
        </v-btn>
      </div>
    </v-card-text>
  </v-card>
    </v-container>
  </v-main>

  <!-- <v-footer app class="d-flex justify-center">
    <strong>G SURESTE © {{ new Date().getFullYear() }}</strong>
  </v-footer> -->
</v-app>
</template>

<script>
  const axios = require('axios');
  import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  import swal from 'sweetalert';

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
      desactivar: false,
      email: null,
      password: null,
      show1: false,
    }),
    methods: {
      async submit (evt) {
        this.desactivar = true
        evt.preventDefault();
        const result = await this.$refs.observer.validate()
        if (result) {
         this.login()
        }
      },
      clear () {
        this.email = null
        this.password = null
        this.$refs.observer.reset()
      },
      async login(){

        try {
            const response = await axios({
        method: 'post',
        url: 'authenticate',
        data: {
          email: this.email,
          password: this.password
        }
      })
            // Success 🎉
            console.log("Acceso correcto",response);
            window.location.href = route('dashboard');
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

