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
    <v-card-title class="font-weight-black">INFORMACIÓN DEL SOLICITANTE</v-card-title>

<v-divider></v-divider>
<v-row>
       <v-col
        cols="12"
      >
       <p class="font-weight-black">FORMULARIO DE SOLICITANTE, LOS CAMPOS MARCADOS CON UN ASTERISCTO (*) SON REQUERIDOS PARA CONTINUAR.</p>
    </v-col>
    </v-row>
  <v-card-text>



    <v-container>
      
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
        <validation-provider
         v-slot="{ errors }"
         name="NOMBRE COMPLETO"
         rules="required"
        >
          <v-text-field
      v-model="nombre"
      label="NOMBRE COMPLETO *"
      :error-messages="errors"
    ></v-text-field>
  </validation-provider>
        </v-col>



         <v-col
          cols="12"
          md="6"
        >
        <validation-provider
         v-slot="{ errors }"
         name="CORREO ELECTRÓNICO"
         rules="required"
        >
          <v-text-field
      v-model="email"

      label="CORREO ELECTRÓNICO *"
      :error-messages="errors"
    ></v-text-field>
      </validation-provider>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
        <validation-provider
         v-slot="{ errors }"
         name="TELÉFONO DE CONTACTO"
         rules="required"
        >
          <v-text-field
      v-model="telefono"

      label="TELÉFONO DE CONTACTO *"
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
      cols="12"
      block
      v-if="editar"
      type="submit"
    >
     Editar
    </v-btn>
    <v-btn
    cols="12"
    block
color="primary"
  v-if="!editar"
  type="submit"
>
REGISTRAR SOLICITANTE
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
message: '{_field_} NO PUEDE QUEDARSE VACÍO',
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
            nombre:null,
            email:null,
            telefono:null,
         }),

         methods: {
           async submit (evt) {

         evt.preventDefault();
         const result = await this.$refs.observer.validate()

         if (result) {
           if (this.editar == true ) {
             this.editarSolicitante()
           }else{
             this.registrarSolicitante()
           }

         }
       },
           async verificar(){
              if (this.$route.params.id != undefined) {
                 this.editar = true
                 this.getEditar()
             }else{

             }
           },

           async registrarSolicitante () {
             try {
                 const response = await axios({
                   method: 'post',
                   url: 'createSolicitante',
                   data: {
                     solicitante:[],
                     nombre:this.nombre,
                     email:this.email,
                     telefono:this.telefono,
                   }
                 })

                 swal("ÉXITO", this.nombre+" SE HA REGISTRADO DE MANERA EXITOSA", "success");
                 this.$router.push({ name: 'solicitantes' });

             } catch (error) {
                swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

                 console.log(error);

             }
           },
           async getEditar(){
             try {
                 const response = await axios({
                   method: 'post',
                   url: 'getSolicitante',
                   data: {
                     id: this.$route.params.id,
                   }
                 })
                 this.solicitante= response.data.response
                 console.log("solicitd", this.solicitante)

               this.nombre = this.solicitante.nombre
               this.email = this.solicitante.email
               this.telefono = this.solicitante.telefono



             } catch (error) {
                swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

                 console.log(error);

             }

           },
           async editarSolicitante () {
             try {
                 const response = await axios({
                   method: 'post',
                   url: 'editarSolicitante',
                   data: {
                     id: this.$route.params.id,
                     nombre: this.nombre,
                     email: this.email,
                     telefono: this.telefono,
                   }
                 })
                  this.$router.push({ name: 'solicitantes' });
                 swal("ÉXITO", this.nombre+" SE HA EDITADO DE MANERA EXITOSA", "success");


             } catch (error) {
                swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

                 console.log(error);

             }
           },

         },

    }
</script>
