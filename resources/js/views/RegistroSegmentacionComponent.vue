<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"

      >
      <validation-observer
    ref="observer"
    v-slot="{ invalid }"
  >
   <form @submit.prevent="submit">


  <v-card-text>



    <v-container>
      <p class="font-weight-black mb-3"  align="center" @click="verSegmentos">Ver Segmentos registrados</p>
        <p class="font-weight-black mb-3"  align="center">Llena el Formulario para registrar una nueva segmentación de Inventario</p>

      <v-row>
        <v-col
          cols="12"
          md="12"
        >
        <validation-provider
         v-slot="{ errors }"
         name="Nombre de la segmentación"
         rules="required"
        >
          <v-text-field
      v-model="nombre"
      label="Nombre de la segmentación*"
:error-messages="errors"
    ></v-text-field>
    </validation-provider>
        </v-col>


        <v-col
          cols="12"

        >
        <validation-provider
         v-slot="{ errors }"
         name="Descripción de la segmentación"
         rules="required"
        >
          <v-text-field
      v-model="descripcion"

      label="Descripción de la segmentación*"
:error-messages="errors"
    ></v-text-field>
    </validation-provider>
        </v-col>

      </v-row>

    </v-container>

    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
        <v-row>
            <v-col>

    <v-btn
    cols="6"
    block

     type="submit"
color="primary"

>
Registrar
</v-btn>
            </v-col>


        </v-row>






    </v-card-actions>
  </form>
</validation-observer>

  </v-card>

  <v-dialog
      v-model="dialog"
    
    >

      <v-card>
        <v-card-title class="headline grey lighten-2">
          Lista de Segmentos registrados
        </v-card-title>

        <v-card-text>
          <v-data-table
    :headers="headers"
    :items="segmentos"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog = false"
          >
            Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

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
        mounted() {

        },
        components: {
        ValidationProvider,
        ValidationObserver,
      },
        data: () => ({
          headers: [
          {
            text: 'Fecha de Registro',
            align: 'start',
            sortable: false,
            value: 'created_at',
          },
          { text: 'Nombre', value: 'nombre' },
          { text: 'Descripción', value: 'descripcion' },
          { text: 'Acciones', value: 'acciones' },

        ],
        segmentos: [],
         dialog: false,
          nombre:null,
          descripcion:null,
         }),
         methods:{


           async submit (evt) {

         evt.preventDefault();
         const result = await this.$refs.observer.validate()

         if (result) {
            this.registrarUtilidad()

         }
       },
       async registrarUtilidad () {
         try {
             const response = await axios({
               method: 'post',
               url: 'nuevoSegmento',
               data: {
                 nombre: this.nombre,
                 descripcion: this.descripcion,

               }
             })

             swal("Éxito", "El segmento "+ this.nombre+ "se ha registrado de manera correcta", "success");
            this.nombre=null
            this.descripcion=null

         } catch (error) {
            swal("Error", "Ha ocurrido un error en el servidor", "warning");

             console.log(error);

         }
       },

       async verSegmentos() {
         this.getSegmentos()
         this.dialog = true
       },

       async getSegmentos () {
         try {
             const response = await axios({
               method: 'get',
               url: 'getSegmentos',

             })

          this.segmentos = response.data.response

         } catch (error) {
            swal("Error", "Ha ocurrido un error en el servidor", "warning");

             console.log(error);

         }

       },

         },

    }
</script>
