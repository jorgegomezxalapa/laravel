<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Registro de Partidas</v-card-title>

<v-divider></v-divider>
  <v-card-text>



    <v-container>
      <!-- <p class="font-weight-black">Datos generales</p> -->
      <v-row>



    <v-col
      cols="12"

    >

<p class="font-weight-black">Detalle de Partidas Registradas</p>
<v-data-table
:headers="headers"
:items="partidas"
:search="search"
>




<template v-slot:item.acciones="{ item }">

<v-tooltip top>
<template v-slot:activator="{ on, attrs }">
<router-link :to="{name: 'editarSolicitud', params:{id:item.id}}">
<v-btn
v-bind="attrs"
v-on="on"
     small
      color="warning"
      dark

      fab
    >
      <v-icon>mdi-pencil-box-outline</v-icon>
    </v-btn>
  </router-link>
</template>
<span>Editar Solicitud</span>
</v-tooltip>

<v-tooltip top>
<template v-slot:activator="{ on, attrs }">
<v-btn
v-bind="attrs"
v-on="on"
     small
      color="primary"
      dark

      fab
    >
      <v-icon>mdi-file-send-outline</v-icon>
    </v-btn>
</template>
<span>Ver Cotización</span>
</v-tooltip>

</template>
</v-data-table>
  </v-col>
</v-row>
      <v-row>



    <v-col
      cols="12"
      md="5"
    >
      <hr>

<p class="font-weight-black">Ingreso de Partida</p>
<v-row>


<p class="font-weight-black">Partida #{{this.partida}}</p>
<v-col
  cols="12"

>
<v-textarea
solo
  v-model="descripcion"
label="Descripción"
></v-textarea>
</v-col>

<v-col
cols="6"

>
<v-text-field
  v-model="unidadmedida"

  label="Unidad de Medida * "

></v-text-field>
</v-col>
<v-col
cols="6"

>
<v-text-field
  v-model="cantidad"

  label="Cantidad * "

></v-text-field>
</v-col>
<v-col
cols="6"

>
<v-text-field
  v-model="precioproveedor"

  label="Precio del Proveedor * "

></v-text-field>
</v-col>
<v-col
cols="6"

>
<v-checkbox
      v-model="checkbox"
      label="¿Modificar tipo de venta actual?"
    ></v-checkbox>


</v-col>
<v-col
cols="12"

>

<v-text-field
  v-model="utilidaddefault"
v-if="checkbox"
  label="Tipo de Venta(Utilidad) * "

></v-text-field>
</v-col>

<v-col
cols="12"

>
<v-btn

block
color="primary"
@click="iniciarCotizacion"
v-if="!editar"
>
Guardar Partida
</v-btn>
</v-col>
</v-row>
  </v-col>
  <v-col
    cols="12"
    md="4"
  >
  <hr>

  <p class="font-weight-black">Cálculo Automático</p>
  <v-text-field
    v-model="iva"

    label="% IVA * "

  ></v-text-field>
  <v-text-field
    v-model="ieps"

    label="% IEPS * "

  ></v-text-field>
  <v-text-field
    v-model="importe1"

    label="Importe(1) * "

  ></v-text-field>
  <v-text-field
    v-model="utilidadgenerada"

    label="Utilidad * "

  ></v-text-field>

  <v-text-field
    v-model="preciounitario"

    label="Precio Unitario * "

  ></v-text-field>

  <v-text-field
    v-model="importe2"

    label="Importe(2) * "

  ></v-text-field>


</v-col>

  <v-col
    cols="12"
    md="3"
  >
      <hr>
<p class="font-weight-black">Detalle General</p>
<v-card
    class="mx-auto"

  >
    <v-card-text>
      <p class="font-weight-black">TIPO DE VENTA: <br>Nombre tipo de venta <br>({{this.utilidaddefault}} %) </p>
    </v-card-text>
      </v-card>
    <v-card
        class="mx-auto"

      >
        <v-card-text>
          <p class="font-weight-black">CÁLCULO DE IVA: <br>{{this.totalIva}} </p>
        </v-card-text>
          </v-card>
        <v-card
            class="mx-auto"

          >
            <v-card-text>
              <p class="font-weight-black">CÁLCULO DE IEPS: <br>{{this.totalIeps}} </p>
            </v-card-text>
              </v-card>
            <v-card
                class="mx-auto"

              >
                <v-card-text>
                  <p class="font-weight-black">SUBTOTAL: <br>{{this.subtotal}} </p>
                </v-card-text>
                  </v-card>
                  <v-card
                      class="mx-auto"

                    >
                      <v-card-text>
                        <p class="font-weight-black">TOTAL: <br>{{this.total}} </p>
                      </v-card-text>
                        </v-card>


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
      color="warning"
      @click="iniciarCotizacion"
      v-if="!editar"
    >
      Finalizar Registro de Partidas
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
        watch: {
    // whenever question changes, this function will run
    cantidad: function (newQuestion, oldQuestion) {
        this.importe1 = parseFloat(this.cantidad) * parseFloat(this.precioproveedor)
        this.importe2 = parseFloat(this.preciounitario) * parseFloat(this.cantidad)

    },
    precioproveedor: function (newQuestion, oldQuestion) {
      this.importe1 = parseFloat(this.cantidad) * parseFloat(this.precioproveedor)
      this.utilidadgenerada = parseFloat( this.precioproveedor) * parseFloat(this.utilidaddefault)
      this.preciounitario = parseFloat( this.precioproveedor)+ parseFloat(this.utilidadgenerada)

    },
    utilidaddefault: function (newQuestion, oldQuestion) {
      this.utilidadgenerada = parseFloat( this.precioproveedor) * parseFloat(this.utilidaddefault)

    },
    utilidadgenerada: function (newQuestion, oldQuestion) {
      this.preciounitario = parseFloat( this.precioproveedor)+ parseFloat(this.utilidadgenerada)
    },
    preciounitario: function (newQuestion, oldQuestion) {
    this.importe2 = parseFloat(this.preciounitario) * parseFloat(this.cantidad)
    },
    ieps: function (newQuestion, oldQuestion) {

    },
    iva: function (newQuestion, oldQuestion) {

    },



  },
        data: () => ({
          search:"",
            editar: false,
            partida:1,
            descripcion:null,
            unidadmedida:null,
            cantidad:0,
            precioproveedor:0,
            utilidaddefault:0.25,
            importe1:0,
            utilidadgenerada:0,
            preciounitario:0,
            importe2:0,
            totalIva:0,
            totalIeps:0,
            subtotal:0,
            total:0,
            checkbox:false,
            iva:16,
            ieps:0,
            headers: [
              {
                text: 'No Artículo(Partida)',
                align: 'center',

                value: 'fecha',
              },
              { text: 'Descripción', align: 'center', value: 'folio' },
                { text: 'Unidad de Medida', align: 'center', value: 'responsable.name' },
              { text: 'Cantidad', align: 'center', value: 'agente.name' },
              { text: 'Precio Proveedor', align: 'center', value: 'cliente.razonSocial' },
              { text: 'Importe', align: 'center', value: 'solicitante.nombre' },
                { text: 'Utilidad', align: 'center', value: 'solicitante.nombre' },
                  { text: 'Precio de Venta', align: 'center', value: 'solicitante.nombre' },
                    { text: 'Importe', align: 'center', value: 'solicitante.nombre' },
              { text: 'Acciones', align: 'center', value: 'acciones' },
            ],
            partidas: [],

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
