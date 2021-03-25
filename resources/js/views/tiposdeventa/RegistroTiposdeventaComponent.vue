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
    <v-card-title class="font-weight-black">INFORMACIÓN DEL TIPO DE VENTA</v-card-title>

<v-divider></v-divider>
  <v-card-text>



    <v-container>
      <p class="font-weight-black">FORMULARIO DE TIPO DE VENTA, LOS CAMPOS MARCADOS CON UN ASTERISCTO (*) SON REQUERIDOS PARA CONTINUAR.</p>
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
        <validation-provider
         v-slot="{ errors }"
         name="DESCRIPCIÓN DEL TIPO DE VENTA"
         rules="required"
        >
          <v-text-field
      v-model="descripcion"
      label="DESCRIPCIÓN DEL TIPO DE VENTA*"
:error-messages="errors"
    ></v-text-field>
    </validation-provider>
        </v-col>


        <v-col
          cols="12"
          md="8"
        >
        <validation-provider
         v-slot="{ errors }"
         name="PORCENTAJE DEL TIPO DE VENTA"
         rules="required"
        >
          <v-text-field
      v-model="porcentaje"
 type="number"
      label="PORCENTAJE DEL TIPO DE VENTA(EN ESCALA DE 0 A 100 %) *"
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

      color="warning"
      cols="6"
      block
      v-if="editar"
       type="submit"

    >
      EDITAR TIPO DE VENTA
    </v-btn>
    <v-btn
    cols="6"
    block
    v-if="!editar"
     type="submit"
color="primary"

>
REGISTRAR TIPO DE VENTA
</v-btn>
            </v-col>


        </v-row>






    </v-card-actions>
  </form>
</validation-observer>

  </v-card>

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
          this.verificar()
        },
        components: {
        ValidationProvider,
        ValidationObserver,
      },
        data: () => ({
          editar:false,
          descripcion:null,
          porcentaje:null,
          utilidad:[],
         }),
         methods:{
           async verificar(){
              if (this.$route.params.id != undefined) {
                 this.editar = true
                 this.getEditar()
             }else{

             }
           },
           async getEditar(){
             try {
                 const response = await axios({
                   method: 'post',
                   url: 'getUtilidad',
                   data: {
                     id: this.$route.params.id,
                   }
                 })
                 this.utilidad= response.data.response
                 console.log("solicitd", this.utilidad.agente)
                 this.descripcion = this.utilidad.descripcion
                 this.porcentaje = this.utilidad.porcentaje


             } catch (error) {
                swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

                 console.log(error);

             }

           },
           async submit (evt) {

         evt.preventDefault();
         const result = await this.$refs.observer.validate()

         if (result) {
           if (this.editar == true ) {
             this.editarUtilidad()
           }else{
             this.registrarUtilidad()
           }

         }
       },
       async registrarUtilidad () {
         try {
             const response = await axios({
               method: 'post',
               url: 'createUtilidad',
               data: {
                 descripcion: this.descripcion,
                 porcentaje: this.porcentaje,

               }
             })

             swal("ÉXITO", "EL TIPO DE VENTA SE HA REGISTRADO CON ÉXITO", "success");
              this.$router.push({ name: 'utilidades' });

         } catch (error) {
            swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

             console.log(error);

         }
       },
       async editarUtilidad () {


         try {
             const response = await axios({
               method: 'post',
               url: 'editarUtilidad',
               data: {
                 id: this.$route.params.id,
                 descripcion: this.descripcion,
                 porcentaje: this.porcentaje,
               }
             })
              this.$router.push({ name: 'utilidades' });
             swal("ÉXITO", "EL TIPO DE VENTA SE HA ACTUALIZADO CON ÉXITO", "success");


         } catch (error) {
            swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

             console.log(error);

         }
       },
         },

    }
</script>
