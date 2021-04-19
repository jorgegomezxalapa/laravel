<template>
    <v-container fluid>

      <v-tabs grow color="#d6b203" background-color="grey lighten-3" >
            <v-tab @click="razonsocial()">RAZÓN SOCIAL</v-tab>
            <v-tab @click="catalogos()">CATÁLOGOS</v-tab>
            <v-tab @click="formatos()">FORMATOS WORD</v-tab>

            <v-tab-item>
              <gestion-razonsocial v-if="mostrarRS"></gestion-razonsocial>

            </v-tab-item>
            <v-tab-item>
                <gestion-catalogos v-if="mostrarCatalogos"></gestion-catalogos>
            </v-tab-item>
            <v-tab-item>
                <gestion-formatos v-if="mostrarFormatos"></gestion-formatos>
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
         this.mostrarRS = true
        },
        data: () => ({
           panel: [0, 1],
            disabled: false,
            readonly: false,
           
            mostrarRS:false,
            mostrarCatalogos:false,
            mostrarFormatos:false,
          
         }),
         watch : {
          

         },
          methods:{
            razonsocial(){
            this.mostrarRS = true
            this.mostrarCatalogos = false
            this.mostrarFormatos = false
            },
            catalogos(){
               this.mostrarRS = false
            this.mostrarCatalogos = true
            this.mostrarFormatos = false
            },
            formatos(){
            this.mostrarRS = false
            this.mostrarCatalogos = false
            this.mostrarFormatos = true
            },
            
            
          },

    }
</script>
