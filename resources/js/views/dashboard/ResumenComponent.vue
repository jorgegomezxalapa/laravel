<template>
  <div>
    <v-row>
      <v-col
        cols="12"
        
      >
        <p class="font-weight-black">RESUMEN</p>
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="8">
                  <p class="font-weight-black">SOLICITUDES</p>
                  <h3 class="font-weight-black">{{cantidadSolicitudes}}</h3>
                </v-col>
                <v-col cols="12" md="4">
                  <img :src="'img/solicitud.png'" width="100%">
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="8">
                  <p class="font-weight-black">COTIZACIONES</p>
                  <h3 class="font-weight-black">{{cantidadCotizaciones}}</h3>
                </v-col>
                <v-col cols="12" md="4">
                  <img :src="'img/cotizacion.png'" width="100%">
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="8">
                  <p class="font-weight-black">VENTAS</p>
                  <h3 class="font-weight-black">{{cantidadVentas}}</h3>
                </v-col>
                <v-col cols="12" md="4">
                 <img :src="'img/ventas.png'" width="100%">
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="8">
                  <p class="font-weight-black">CLIENTES</p>
                  <h3 class="font-weight-black">{{cantidadClientes}}</h3>
                </v-col>
                <v-col cols="12" md="4">
                  <img :src="'img/cliente.png'" width="100%">
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      
     
    </v-row>
  </div>
</template>

<script>
  const axios = require('axios');
  export default {
    data: () => ({
     cantidadSolicitudes:0,
     cantidadCotizaciones:0,
     cantidadVentas:0,
     cantidadClientes:0,

       }),
    watch: {

    },
    methods: {

      async getAll(){
        try {
                const response = await axios({
                  method: 'get',
                  url: 'getAll',
                })
                let respuesta = []
                respuesta = response.data
                this.cantidadSolicitudes = respuesta.solicitudes
                this.cantidadCotizaciones = respuesta.cotizaciones
                this.cantidadVentas = respuesta.ventas
                this.cantidadClientes = respuesta.clientes
                console.log(this.usuarios)


            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "Por favor recarga la página", "error");
                console.log(error);

            }

      }
     
     

    },
    beforeMount: function () {
   

  },
  mounted: function () {
    this.getAll()
 
}
  }
</script>

