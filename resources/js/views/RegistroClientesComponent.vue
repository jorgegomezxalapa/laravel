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
    <v-card-title class="font-weight-black">Información del Cliente</v-card-title>

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
      <p class="font-weight-black">Información del Cliente</p>
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
        <validation-provider
         v-slot="{ errors }"
         name="Razón Social(Nombre de la empresa)"
         rules="required"
       >
          <v-text-field
      v-model="razonSocial"
      label="Razón Social(Nombre de la empresa)*"
       :error-messages="errors"
    ></v-text-field>
  </validation-provider>
        </v-col>

        <v-col
          cols="12"
          md="12"
        >
        <validation-provider
         v-slot="{ errors }"
         name="Dirigido a(Representante)"
         rules="required"
       >
         <v-text-field
      v-model="representante"

      label="Dirigido a(Representante)*"
      :error-messages="errors"
    ></v-text-field>
  </validation-provider>
        </v-col>

        <v-col
          cols="12"
          md="12"
        >

         <v-text-field
      v-model="conatencion"

      label="Con Atención a"
      :error-messages="errors"
    ></v-text-field>

        </v-col>

        <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="rfc"

      label="RFC(De la Razón Social)"

    ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="email"

      label="Correo Electrónico(De la Razón Social)"

    ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="telefono"

      label="Teléfono(De la Razón Social)"

    ></v-text-field>
        </v-col>

      </v-row>

    </v-container>

    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
        <v-row>
            <v-col    cols="12">
                <v-btn

      color="warning"
      cols="12"
      block
      v-if="editar"
       type="submit"
    >
      Editar
    </v-btn>
            </v-col>

            <v-col    cols="12">
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
      components: {
      ValidationProvider,
      ValidationObserver,
    },
        mounted() {
          this.verificar()
        },
        data: () => ({
          cliente:[],
          editar:false,
          conatencion:null,
          razonSocial:null,
          representante:null,
          rfc:null,
          email:null,
          telefono:null,
         }),

         methods: {
           async verificar(){
              if (this.$route.params.id != undefined) {
                 this.editar = true
                 this.getEditar()
             }else{

             }
           },
           async submit (evt) {

         evt.preventDefault();
         const result = await this.$refs.observer.validate()

         if (result) {
           if (this.editar == true ) {
             this.editarDatos()
           }else{
             this.registrar()
           }

         }
       },

       async editarDatos(){
         try {
             const response = await axios({
               method: 'post',
               url: 'editarCliente',
               data: {
                 id: this.$route.params.id,
                 conatencion:this.conatencion,
                 razonSocial: this.razonSocial,
                 representante: this.representante,
                 rfc: this.rfc,
                 email: this.email,
                 telefono: this.telefono,
               }
             })

               swal("Éxito", this.razonSocial+" se ha actualizado con éxito", "success");
                this.$router.push({ name: 'clientes' });





         } catch (error) {
            swal("Error", "Ha ocurrido un error en el servidor", "warning");

             console.log(error);

         }
       },
       async getEditar(){
         try {
             const response = await axios({
               method: 'post',
               url: 'getCliente',
               data: {
                 id: this.$route.params.id,
               }
             })
             this.cliente= response.data.response
             console.log("solicitd", this.cliente.fecha)
             this.conatencion = this.cliente.conatencion
           this.razonSocial = this.cliente.razonSocial
           this.representante = this.cliente.representante
           this.rfc = this.cliente.rfc
           this.email = this.cliente.email
           this.telefono = this.cliente.telefono



         } catch (error) {
            swal("Error", "Ha ocurrido un error en el servidor", "warning");

             console.log(error);

         }

       },

       async registrar(){
         try {
             const response = await axios({
               method: 'post',
               url: 'createCliente',
               data: {
                 conatencion:this.conatencion,
                 razonSocial: this.razonSocial,
                 representante: this.representante,
                 rfc: this.rfc,
                 email: this.email,
                 telefono: this.telefono,
               }
             })
            //correcto
            swal("Éxito", this.razonSocial+" se ha registrado de manera correcta", "success");
            this.$router.push({ name: 'clientes' });

         } catch (error) {
          swal("Error", "Ha ocurrido un error de servidor", "error");
                 console.log(error.response.data);
                 console.log(error.response.status);
                 console.log(error.response.headers);


             console.log(error);

         }
       },
     },

    }
</script>
