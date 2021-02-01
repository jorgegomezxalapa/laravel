<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Información de la cotización</v-card-title>

<v-divider></v-divider>
  <v-card-text>



    <v-container>
      <p class="font-weight-black">Datos generales</p>
      <v-row>

          <v-col
            cols="12"
            md="6"
          >
          <p class="font-weight-black">Solicitud con #Folio: <br>{{this.cliente.razonSocial}} </p>

        </v-col>

        <v-col
          cols="12"
          md="6"
        >

          <p class="font-weight-black">Solicitante: <br>{{this.solicitante.nombre}} </p>

      </v-col>

      <v-col
        cols="12"
        md="6"
      >

          <p class="font-weight-black">Dirigido a(Cliente): <br>{{this.cliente.razonSocial}} </p>

    </v-col>

    <v-col
      cols="12"
      md="12"
    >

          <p class="font-weight-black">Comentarios: <br>{{this.solicitud.comentarios}} </p>
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

    >
      Editar
    </v-btn>
            </v-col>
            <v-col>
                <v-btn
      color="error"
      cols="6"
      block

    >
     Eliminar
    </v-btn>
            </v-col>
            <v-col>
               <v-btn
               cols="6"
               block
      color="primary"

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
    export default {
        mounted() {
          this.getCotizacion()
        },
        data: () => ({
            editar: false,
            cotizacion:[],
            cliente:[],
            solicitante:[],
            agente:[],
            responsable:[],
            solicitud:[],

         }),
          methods:{
            async getCotizacion(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'getCotizacion',
                      data:{
                        id:this.$route.params.id,
                      }
                    })

                    this.cotizacion = response.data.response
                      console.log(this.cotizacion)
                      this.solicitud = this.cotizacion.solicitud
                    this.cliente = this.cotizacion.solicitud.cliente
                      this.solicitante = this.cotizacion.solicitud.solicitante
                        this.agente = this.cotizacion.solicitud.agente
                          this.responsable = this.cotizacion.solicitud.responsable
                    console.log(this.cliente, this.solicitante, this.agente, this.responsable)


                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

          },

    }
</script>
