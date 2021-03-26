<template>
    <v-container fluid>
      <v-expansion-panels
      v-model="panel"
      :disabled="disabled"
      
    >
      <v-expansion-panel>
        <v-expansion-panel-header>
           <v-card-title class="font-weight-black">CONFIGURACIONES</v-card-title>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <configuraciones-cotizacion></configuraciones-cotizacion>
        </v-expansion-panel-content>
      </v-expansion-panel>

      <v-expansion-panel>
        <v-expansion-panel-header>
           <v-card-title class="font-weight-black">PARTIDAS</v-card-title>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <partidas-component v-if="mostrarPartidas"></partidas-component>
        </v-expansion-panel-content>
      </v-expansion-panel>

      
    </v-expansion-panels>
      
    </v-container>
</template>


<script>

 import moment from 'moment'
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
         
        
        },
        data: () => ({
        
            panel: 0,
            disabled: false,
            readonly: false,
            mostrarPartidas:false,
          
         }),
         watch : {
          panel: function (newVal, oldVal) {
            if (newVal == 1) {
              this.mostrarPartidas = true
            }else{
              this.mostrarPartidas = false
            }
          },
          

         },
          methods:{
           

            
          },

    }
</script>
