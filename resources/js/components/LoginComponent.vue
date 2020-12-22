<template>
  <v-app>
  

  <v-app-bar app class="d-flex justify-center">
    Sistema de planificación de recursos empresariales
    {{entorno}}
  </v-app-bar>

  
  <v-main>

   
    <v-container fluid>
      <v-card
        class="mx-auto"
        max-width="374"
      >
   
   <img :src="'img/profile.png'" width="100%" class="my-2" >

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

    <v-card-actions>
     <v-btn color="primary" type="submit" block>
    <strong>Ingresar</strong>
  </v-btn>
      
    </v-card-actions>
  </form>
  </validation-observer>

  <v-card-text class="d-flex justify-center">
      <div>¿Olvidaste tu contraseña?</div>
    </v-card-text>
  </v-card>
    </v-container>
  </v-main>

  <v-footer app class="d-flex justify-center">
    <strong>G SURESTE © {{ new Date().getFullYear() }}</strong>
  </v-footer>
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
        entorno:process.env.MIX_CLIENT_SECRET,
      email: null,
      password: null,
      show1: false,
    }),
    methods: {
      async submit (evt) {
        console.log(process.env.MIX_CLIENT_SECRET)
        return true;
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
        window.location.href = route('dashboard');
      })
      .catch(function (error) {

       swal("Acceso incorrecto!", "Ingresa los datos de usuario correctos!", "warning");

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

