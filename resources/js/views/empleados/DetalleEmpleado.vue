<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"

      >
    <v-card-title class="font-weight-black">Detalle general del Empleado</v-card-title>
<v-divider></v-divider>
  <v-card-text class="d-flex justify-center">

Soy el detalle del empleado

    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>

    </v-card-actions>
  </v-card>
    </v-container>
</template>

<script>
const axios = require('axios');
import swal from 'sweetalert';

    export default {
      data: () => ({

       }),
        mounted() {
            console.log('Component mounted.')
        },
        methods : {
          // async getEditar(){
          //   try {
          //       const response = await axios({
          //         method: 'post',
          //         url: 'getUsuario',
          //         data: {
          //           id: this.$route.params.id,
          //         }
          //       })
          //
          //
          //
          //
          //   } catch (error) {
          //      swal("Error", "Ha ocurrido un error en el servidor", "warning");
          //
          //       console.log(error);
          //
          //   }
          //
          // },
        },
    }
</script>
