<template>
  <v-app>
    <v-main>
      <v-container fill-height fluid>
        <v-card
          class="mx-auto rounded-xl py-5 px-2"
          max-width="380"
          align="center"
          justify="space-around"
        >

          <img :src="'img/profile.png'" width="100%">

          <v-card-title>
            <h5><strong>Para ingresar, coloca tu usuario y contraseña.</strong></h5>
          </v-card-title>
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
                      name="Nombre de Usuario"
                      rules="required"
                    >
                      <v-text-field
                        v-model="usuario"
                        outlined
                        :error-messages="errors"
                        label="Nombre de Usuario"
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
  </v-app>
</template>

<script>
  const axios = require('axios');
  import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  import swal from 'sweetalert';

  setInteractionMode('eager')
  extend('required', {
    ...required,
    message: '{_field_} no puede quedarse vacío',
  })
  
  export default {
    components: {
      ValidationProvider,
      ValidationObserver,
    },
    data: () => ({
      desactivar: false,
      usuario: null,
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
        this.desactivar = false
      },
      clear () {
        this.usuario = null
        this.password = null
        this.$refs.observer.reset()
      },
      async login(){

        try {
            const response = await axios({
              method: 'post',
              url: 'ingreso',
              data: {
                userName: this.usuario,
                password: this.password
              }
            })
           
            window.location.href = route('dashboard');
        } catch (error) {
            if (error.response) {
              
                swal("Información incorrecta!", "El usuario o contraseña son incorrectos!", "warning");
            }else {
                swal("Eror!", "Ha ocurrido un error de conexión!", "warning");
              
                
            }
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
