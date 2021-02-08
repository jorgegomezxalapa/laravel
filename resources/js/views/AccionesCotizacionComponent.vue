<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Detalle General de la cotización</v-card-title>

<v-divider></v-divider>
  <v-card-text>



    <v-container>
      <p class="font-weight-black">Resúmen de las partidas</p>
      <v-row>

          <v-col
            cols="12"
            md="6"
          >
          <v-card
    class="mx-auto"

  >
    <v-card-text>
      <p class="font-weight-black">Cantidad de Partidas: <br> {{this.partidas}}</p>
    </v-card-text>

  </v-card>


        </v-col>

        <v-col
          cols="12"
          md="6"
        >
        <v-card
            class="mx-auto"

          >
            <v-card-text>
              <p class="font-weight-black">IVA <br> {{this.iva}} </p>
            </v-card-text>

          </v-card>


      </v-col>

      <v-col
        cols="12"
        md="6"
      >
      <v-card
          class="mx-auto"

        >
          <v-card-text>
            <p class="font-weight-black">IEPS </p>
          </v-card-text>

        </v-card>


    </v-col>

    <v-col
      cols="12"
      md="6"
    >
    <v-card
        class="mx-auto"

      >
        <v-card-text>
          <p class="font-weight-black">SUBTOTAL <br> {{this.subtotal}} </p>
        </v-card-text>

      </v-card>


  </v-col>

    <v-col
      cols="12"
      md="12"
    >
    <v-card
        class="mx-auto"

      >
        <v-card-text>
          <p class="font-weight-black">TOTAL: <br> {{this.total}}</p>
        </v-card-text>

      </v-card>

  </v-col>
  <v-col
    cols="12"
    md="12"
  >
<hr>
        <p class="font-weight-black">FORMATOS DE IMPRESIÓN DISPONIBLES</p>
        <v-select
        v-model="utilidad"
        :items="utilidades"
        item-text="descripcion"
        item-value="id"
        label="Seleccione un formato * "

        ></v-select>
</v-col>

      </v-row>


    </v-container>




    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
        <v-row>


            <v-col>
               <v-btn
               cols="6"
               block
      color="primary"

      v-if="!editar"
    >
    Generar Impresión PDF
    </v-btn>
    <v-btn
    cols="6"
    block
color="primary"
@click="editarCotizacion"
v-if="editar"
>
Editar Cotización
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
    export default {
        mounted() {
          this.getCotizacion()

        },
        data: () => ({
            editar: false,
            utilidad:null,
            utilidades:[],
            cotizacion:[],
            cliente:[],
            solicitante:[],
            agente:[],
            responsable:[],
            solicitud:[],
            iva:0,
            subtotal:0,
            total:0,
            partidas:0,

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
                    this.iva =  response.data.iva
                    this.subtotal = response.data.subtotal
                    this.total =  response.data.total
                    this.partidas =  response.data.partidas


                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

            async iniciarCotizacion () {
              try {
                  const response = await axios({
                    method: 'post',
                    url: 'iniciarCotizacion',
                    data: {
                      id:this.$route.params.id,
                      utilidad : this.utilidad

                    }
                  })


                   this.$router.push({ name: 'registroPartidas', params:{id:this.$route.params.id} });

              } catch (error) {
                 swal("Error", "Ha ocurrido un error en el servidor", "warning");

                  console.log(error);

              }
            },
            async editarCotizacion(){
              alert("editar")
            },

          },

    }
</script>
