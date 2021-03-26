<template>
    <v-container fluid>

      <v-tabs grow color="#d6b203" background-color="grey lighten-3" >
            <v-tab @click="solicitud()">SOLICITUD</v-tab>
            <v-tab @click="cotizacion()">COTIZACIÓN</v-tab>
            <v-tab @click="acciones()">ACCIONES</v-tab>

            <v-tab-item>
              <v-expansion-panels
      v-model="panel"
      :disabled="disabled"
      multiple
    >
      <v-expansion-panel>
        <v-expansion-panel-header>
          <v-card-title class="font-weight-black">DATOS GENERALES DE LA SOLICITUD</v-card-title>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <datos-generales-cotizacion v-if="mostrarSolicitud"></datos-generales-cotizacion>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>

            </v-tab-item>
            <v-tab-item>
                <trabajo-cotizacion v-if="mostrarCotizacion"></trabajo-cotizacion>
            </v-tab-item>
            <v-tab-item>
                hola tres
            </v-tab-item>

        </v-tabs>

      
      
    </v-container>
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
        mounted() {
         this.mostrarSolicitud = true
        },
        data: () => ({
           panel: [0, 1],
            disabled: false,
            readonly: false,
           
            mostrarSolicitud:false,
            mostrarCotizacion:false,
            mostrarAcciones:false,
          
         }),
         watch : {
          

         },
          methods:{
            solicitud(){
            this.mostrarSolicitud = true
            this.mostrarCotizacion = false
            this.mostrarAcciones = false
            },
            cotizacion(){
               this.mostrarSolicitud = false
            this.mostrarCotizacion = true
            this.mostrarAcciones = false
            },
            acciones(){
            this.mostrarSolicitud = false
            this.mostrarCotizacion = false
            this.mostrarAcciones = true
            },
            
            
          },

    }
</script>
