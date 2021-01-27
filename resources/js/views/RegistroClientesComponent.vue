<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"
      >
    <v-card-title class="font-weight-black">Nuevo Cliente</v-card-title>

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
          <v-text-field
      v-model="razonSocial"
      label="Razón Social(Nombre de la empresa)*"
      required
    ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="12"
        >
         <v-text-field
      v-model="representante"

      label="Dirigido a(Representante)*"
      required
    ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="rfc"

      label="RFC"
      required
    ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="email"

      label="Correo Electrónico"
      required
    ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="telefono"

      label="Teléfono"
      required
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
      v-if="esEditar"
    >
      Editar
    </v-btn>
            </v-col>

            <v-col    cols="12">
               <v-btn
               cols="12"
               block
      color="primary"
      v-if="!esEditar"
    >
      Registrar
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
            console.log('Component mounted.')
        },
        data: () => ({
          esEditar:false,
          razonSocial:null,
          representante:null,
          rfc:null,
          email:null,
          telefono:null,
         }),

    }
</script>
