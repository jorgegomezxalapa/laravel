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
    <v-card-title class="font-weight-black">Información del Solicitante</v-card-title>

<v-divider></v-divider>
<v-row>
       <v-col
        cols="12"
      >
      <p><strong>Por favor complete el formulario, los campos marcados con un asterisco (*) son obligatorios.</strong></p>
    </v-col>
    </v-row>
  <v-card-text>



    <v-container>
      <p class="font-weight-black">Información del Solicitante</p>
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
        <validation-provider
         v-slot="{ errors }"
         name="Nombre Completo"
         rules="required"
        >
          <v-text-field
      v-model="nombre"
      label="Nombre Completo *"
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
         name="Correo Electrónico"
         rules="required"
        >
          <v-text-field
      v-model="email"

      label="Correo Electrónico *"
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
         name="Teléfono"
         rules="required"
        >
          <v-text-field
      v-model="telefono"

      label="Teléfono *"
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
Registrar
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

                 swal("Éxito", this.nombre+" se ha registrado de manera correcta", "success");
                 this.$router.push({ name: 'solicitantes' });

             } catch (error) {
                swal("Error", "Ha ocurrido un error en el servidor", "warning");

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
                swal("Error", "Ha ocurrido un error en el servidor", "warning");

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
                 swal("Éxito", this.nombre+" se ha editado de manera correcta", "success");


             } catch (error) {
                swal("Error", "Ha ocurrido un error en el servidor", "warning");

                 console.log(error);

             }
           },

         },

    }
</script>
