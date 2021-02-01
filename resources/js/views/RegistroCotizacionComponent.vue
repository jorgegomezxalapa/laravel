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
          <v-card
    class="mx-auto"

  >
    <v-card-text>
      <p class="font-weight-black">Solicitud con #Folio: <br>{{this.solicitud.folio}} </p>
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
              <p class="font-weight-black">Solicitante: <br>{{this.solicitante.nombre}} </p>
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
            <p class="font-weight-black">Dirigido a(Cliente): <br>{{this.cliente.razonSocial}} </p>
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
          <p class="font-weight-black">Comentarios: <br>{{this.solicitud.comentario}} </p>
        </v-card-text>

      </v-card>

  </v-col>
  <v-col
    cols="12"
    md="12"
  >
<hr>
        <p class="font-weight-black">Seleccionar Tipo de Venta </p>
        <v-select
        v-model="utilidad"
        :items="utilidades"
        item-text="descripcion"
        item-value="id"
        label="Tipo de Venta * "

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
      @click="iniciarCotizacion"
      v-if="!editar"
    >
      Iniciar Cotización
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
          this.gettipoventas()
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
            async gettipoventas(){
              try {
                    const response = await axios({
                      method: 'get',
                      url: 'getUtilidades',

                    })

                    this.utilidades = response.data.response



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
