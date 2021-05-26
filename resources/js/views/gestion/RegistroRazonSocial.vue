<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"
      >
     
    <v-card-title class="font-weight-black">INFORMACIÓN DE LA RAZÓN SOCIAL</v-card-title>

<v-divider></v-divider>
<v-row>
       <v-col
        cols="12"
      >
     <p class="font-weight-black">FORMULARIO DE RAZÓN SOCIAL, LOS CAMPOS MARCADOS CON UN ASTERISCTO (*) SON REQUERIDOS PARA CONTINUAR.</p>
    </v-col>
    </v-row>
  <v-card-text>
    <v-container>
   
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
        
          <v-text-field
      v-model="razonSocial"
      label="RAZÓN SOCIAL (NOMBRE DE LA EMPRESA)*"
      
    ></v-text-field>
  
        </v-col>

        <v-col
          cols="12"
          md="12"
        >
      
         <v-text-field
      v-model="descripcion"

      label="DESCRIPCIÓN*"
     
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
      EDITAR RAZÓN SOCIAL
    </v-btn>
            </v-col>

            <v-col    cols="12">
               <v-btn
               cols="12"
               block
      color="primary"
      v-if="!editar"
       type="submit"
       @click="submit"
    >
      REGISTRAR RAZÓN SOCIAL
    </v-btn>
            </v-col>
        </v-row>

    </v-card-actions>
  

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
      components: {
      ValidationProvider,
      ValidationObserver,
    },
        mounted() {
          this.verificar()
        },
        data: () => ({
          razonSocial:null,
          descripcion:null,
          editar:false,
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

        

         if (true) {
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
                 razonSocial: this.razonSocial,
                 descripcion: this.descripcion,
               }
             })

               swal("ÉXITO", this.razonSocial+" SE HA ACTUALIZADO DE MANERA EXITOSA", "success");
                this.$router.push({ name: 'clientes' });

         } catch (error) {
            swal("ERROR", "HA OCURRIDO UN ERROR CON EL SERVIDOR", "warning");

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
            swal("ERROR", "HA OCURRIDO UN ERROR CON EL SERVIDOR", "warning");

             console.log(error);

         }

       },

       async registrar(){
         try {
             const response = await axios({
               method: 'post',
               url: 'nuevaRazon',
               data: {
                 
                 nombre: this.razonSocial,
                 descripcion: this.descripcion,
                 
               }
             })
            //correcto
            swal("ÉXITO", this.razonSocial+" SE HA REGISTRADO DE MANERA EXITOSA", "success");
            this.$router.push({ name: 'formatos' });

         } catch (error) {
          swal("ERROR", "HA OCURRIDO UN ERROR DE SERVIDOR", "error");
                 console.log(error.response.data);
                 console.log(error.response.status);
                 console.log(error.response.headers);


             console.log(error);

         }
       },
     },

    }
</script>
