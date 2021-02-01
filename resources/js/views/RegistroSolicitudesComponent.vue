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
    <v-card-title class="font-weight-black">Información de la Solicitud</v-card-title>

<v-divider></v-divider>
<v-row>
       <v-col
        cols="12"
      >
      <p><strong>Por favor complete el formulario, los campos marcados con un asterisco  *  son obligatorios.</strong></p>
    </v-col>
    </v-row>
  <v-card-text class="d-flex justify-center">

    <v-row>
      <v-col
        cols="12"

        md="6"
      >
        <p class="font-weight-black">Información de la Solicitud</p>

    <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        :return-value.sync="date"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="date"
            label="Fecha de recepción de la solicitud * "
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="es-419"
          v-model="date"
          no-title
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="primary"
            @click="menu = false"
          >
            Cancel
          </v-btn>
          <v-btn
            text
            color="primary"
            @click="$refs.menu.save(date)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-menu>
      <validation-provider
       v-slot="{ errors }"
       name="Folio Interno para la solicitud"
       rules="required"
     >

    <v-text-field
      v-model="folio"
      :error-messages="errors"
      label="Folio Interno para la solicitud * "

    ></v-text-field>
  </validation-provider>


<validation-provider
 v-slot="{ errors }"
 name="Agende de Ventas"
 rules="required"
>
<v-select
v-model="agente"
:items="agentes"
item-text="name"
item-value="id"
label="Agende de Ventas * "
:error-messages="errors"
></v-select>
</validation-provider>


      </v-col>
      <v-col
        cols="12"
        md="6"
      >
       <p class="font-weight-black">Información del Cliente</p>
       <validation-provider
        v-slot="{ errors }"
        name="Con atención a (Cliente)"
        rules="required"
       >
<v-select
      v-model="cliente"
      :items="clientes"
      item-text="razonSocial"
      item-value="id"
      label="Con atención a (Cliente) * "
      :error-messages="errors"
    ></v-select>
  </validation-provider>

  <validation-provider
   v-slot="{ errors }"
   name="Solicitante de la cotización"
   rules="required"
  >
<v-select
      v-model="solicitante"
      :items="solicitantes"
      item-text="nombre"
      item-value="id"
      label="Solicitante de la cotización * "
:error-messages="errors"
    ></v-select>
    </validation-provider>




      </v-col>

      <v-col cols="12">
        <v-divider></v-divider>
         <p class="font-weight-black">Configuración para la atención de la Solicitud</p>
          <v-row>
           <v-col cols="12"
           md="12">
           <validation-provider
            v-slot="{ errors }"
            name="Empleado Responsable para Cotizar"
            rules="required"
           >
           <v-select
      v-model="empleado"
      :items="empleados"
      item-text="name"
      item-value="id"
      label="Empleado Responsable para Cotizar * "
:error-messages="errors"
    ></v-select>
  </validation-provider>

      </v-col>

          </v-row>
      </v-col>

          <v-col cols="12"
     >
     <v-divider></v-divider>
         <p class="font-weight-black">Comentarios</p>
          <v-textarea
          solo
            v-model="comentarios"
          label="Ingresa Aquí tus Comentarios"
        ></v-textarea>
      </v-col>
    </v-row>




    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
        <v-row>
            <v-col>
               <v-btn
               v-if="!editar"
               cols="6"
               block
      color="primary"
 type="submit"
    >
      Registrar Solicitud
    </v-btn>
    <v-btn
    v-if="editar"
    cols="6"
    block
color="warning"
type="submit"
>
Editar Solicitud
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
            this.getCatalogos()
            this.verificar()

        },
        components: {
        ValidationProvider,
        ValidationObserver,
      },
        data: () => ({

             date: new Date().toISOString().substr(0, 10),
             solicitud:[],
              menu: false,
              editar:false,
            folio:null,
          cliente:null,
            solicitante:null,
            comentarios:null,
agente:null,
            empleado:null,
            empleados:[],
  agentes:[],
            clientes:[],
            solicitantes:[],


         }),
         methods: {
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
                   url: 'getSolicitud',
                   data: {
                     id: this.$route.params.id,
                   }
                 })
                 this.solicitud= response.data.response
                 console.log("solicitd", this.solicitud.agente)

               this.date = this.solicitud.fecha
               this.folio = this.solicitud.folio
               this.agente = parseInt(this.solicitud.agente)
               this.cliente = parseInt(this.solicitud.cliente)
               this.solicitante = parseInt(this.solicitud.solicitante)
               this.empleado = parseInt(this.solicitud.responsable)
               this.comentarios = this.solicitud.comentario


             } catch (error) {
                swal("Error", "Ha ocurrido un error en el servidor", "warning");

                 console.log(error);

             }

           },
           async submit (evt) {

         evt.preventDefault();
         const result = await this.$refs.observer.validate()

         if (result) {
           if (this.editar == true ) {
             this.editarSolicitud()
           }else{
             this.registrarSolicitud()
           }

         }
       },
       async editarSolicitud () {
         try {
             const response = await axios({
               method: 'post',
               url: 'editarSolicitud',
               data: {
                 id: this.$route.params.id,
                 fecha: this.date,
                 folio: this.folio,
                 agente: this.agente,
                 cliente: this.cliente,
                 solicitante: this.solicitante,
                 responsable: this.empleado,
                 comentarios: this.comentarios,
               }
             })
              this.$router.push({ name: 'solicitudes' });
             swal("Éxito", "La solicitud con folio "+this.folio+" se ha editado de manera correcta", "success");


         } catch (error) {
            swal("Error", "Ha ocurrido un error en el servidor", "warning");

             console.log(error);

         }
       },
       async registrarSolicitud () {
         try {
             const response = await axios({
               method: 'post',
               url: 'createSolicitud',
               data: {
                 fecha: this.date,
                 folio: this.folio,
                 agente: this.agente,
                 cliente: this.cliente,
                 solicitante: this.solicitante,
                 responsable: this.empleado,
                 comentarios: this.comentarios,
               }
             })

             swal("Éxito", "La solicitud con folio "+this.folio+" se ha registrado de manera correcta", "success");
              this.$router.push({ name: 'solicitudes' });

         } catch (error) {
            swal("Error", "Ha ocurrido un error en el servidor", "warning");

             console.log(error);

         }
       },

          async getCatalogos () {
            try {
                const response = await axios({
                  method: 'get',
                  url: 'catalogosSolicitud',
                })

                this.agentes = response.data.agentes
                this.clientes = response.data.clientes
                this.solicitantes = response.data.solicitantes
                this.empleados = response.data.responsables

              





              console.log(response.data.solicitantes)
                console.log(response.data.agentes)
                  console.log(response.data.responsables)
                    console.log(response.data.clientes)


            } catch (error) {
               swal("Error", "Ha ocurrido un error en el servidor", "warning");

                console.log(error);

            }

          }
         }

    }
</script>
