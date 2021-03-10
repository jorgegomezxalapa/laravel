<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"



      >
    <v-card-title class="font-weight-black">
      <v-tabs v-model="tab"
          align-with-title>
   <v-tab>Almacén</v-tab>
   <v-tab @click="getSolicitadas">Partidas Solicitadas</v-tab>
   <v-tab @click="getDisponibles">Inventario Disponible</v-tab>
 </v-tabs>
    </v-card-title>
<v-divider></v-divider>
  <v-card-text>
    <v-tabs-items v-model="tab">
        <v-tab-item
        >
          <v-card flat>
            <v-card-text>
              <v-row>
      <v-col
        cols="12"

      >

      <v-tabs
       v-model="model2"

       slider-color="primary"
     >
       <v-tab
         href="#tab-1"
       >
         Registro de Inventario
       </v-tab>
       <v-tab
         href="#tab-2"
         @click="getInventario"
       >
        Registro de Segmento
       </v-tab>
     </v-tabs>

     <v-tabs-items v-model="model2">
      <v-tab-item

        value="tab-1"
      >
        <v-card flat>
          <v-card-text>
            <registro-inventario></registro-inventario>
          </v-card-text>
        </v-card>
      </v-tab-item>

      <v-tab-item

        value="tab-2"
      >
      <v-card flat>
        <v-card-text>
          <registro-segmentacion></registro-segmentacion>
        </v-card-text>
      </v-card>
      </v-tab-item>
    </v-tabs-items>

      </v-col>


    </v-row>


            </v-card-text>
          </v-card>
        </v-tab-item>

        <v-tab-item
        >
          <v-card flat>
            <v-card-text>
              <v-card flat>
                <v-card-text>

                  <v-text-field
              v-model="search2"
              append-icon="mdi-magnify"
              label="Buscar Partida"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersSolicitadas"
            :items="solicitadas"
            :search="search2"
          >
          <template v-slot:item.acciones="{ item }">


            <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">

            <v-btn
             v-bind="attrs"
                v-on="on"
                     small
                      color="warning"
                      dark
                      @click="btnactualizar(item)"
                      fab
                    >
                      <v-icon>mdi-pencil-box-outline</v-icon>
                    </v-btn>

                </template>
                <span>Actualizar Inventario</span>
            </v-tooltip>


          </template>
        </v-data-table>
                </v-card-text>
              </v-card>
            </v-card-text>
          </v-card>
        </v-tab-item>

        <v-tab-item
        >
          <v-card flat>
            <v-card-text>
              <v-card flat>
                <v-card-text>

                  <v-text-field
              v-model="search3"
              append-icon="mdi-magnify"
              label="Buscar Partida"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersDisponibles"
            :items="disponibles"
            :search="search3"
          >
          <template v-slot:item.acciones="{ item }">


            <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">

            <v-btn
             v-bind="attrs"
                v-on="on"
                     small
                      color="warning"
                      dark
  @click="btnactualizar(item)"
                      fab
                    >
                      <v-icon>mdi-pencil-box-outline</v-icon>
                    </v-btn>

                </template>
                <span>Actualizar Inventario</span>
            </v-tooltip>


          </template>
        </v-data-table>
                </v-card-text>
              </v-card>
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>


    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>

    </v-card-actions>
  </v-card>
  <v-dialog
      v-model="dialog"
      width="500"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
          hidden="true"
        >
          Click Me
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline grey lighten-2">
        Modificación de Partida
        </v-card-title>

        <v-card-text>

          <v-text-field
            v-model="cantidadingresada"
            label="Digite la cantidad a ingresar"
            required
          ></v-text-field>

          <v-text-field
            v-model="cantidadretirada"
            label="Digite la cantidad a retirar"
            required
          ></v-text-field>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="actualizarPartida"
          >
            Actualizar partida
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-container>
</template>

<script>
const axios = require('axios');
import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
import swal from 'sweetalert';
export default {
data () {
  return {
    idEditar:null,
    dialog:false,
    cantidadingresada:null,
    cantidadretirada:null,
    tab: null,
    model2:'tab-1',
    search1:null,
      search2:null,
        search3:null,
    headers: [
      { text: '# Folio Solicitud|Cotización', value: 'cotizacion.solicitud.folio' },
          {
            text: 'Descripcion',
            align: 'start',
            filterable: false,
            value: 'descripcion',
          },
          { text: 'Precio de Proveedor', value: 'precioproveedor' },
          { text: 'Disponible', value: 'disponible' },
            { text: 'Solicitado', value: 'solicitadas' },
          { text: 'Unidad de Medida', value: 'unidadmedida' },
          { text: 'Marca', value: 'marca' },
          { text: 'Modelo', value: 'modelo' },
          { text: 'Número de Serie', value: 'numserie' },

        ],
        headersSolicitadas: [
          { text: '# Folio Solicitud|Cotización', value: 'cotizacion.solicitud.folio' },
              {
                text: 'Descripcion',
                align: 'start',
                filterable: false,
                value: 'descripcion',
              },
              {
                text: 'Notas',
                align: 'start',
                filterable: false,
                value: 'notasproducto',
              },
              { text: 'Precio de Proveedor', value: 'precioproveedor' },
              { text: 'Disponible', value: 'disponible' },
                { text: 'Solicitado', value: 'solicitadas' },
              { text: 'Unidad de Medida', value: 'unidadmedida' },
              { text: 'Marca', value: 'marca' },
              { text: 'Modelo', value: 'modelo' },
              { text: 'Número de Serie', value: 'numserie' },
                  { text: 'Acciones', align: 'center', value: 'acciones' },

            ],

            headersDisponibles: [
              { text: '# Folio Solicitud|Cotización', value: 'cotizacion.solicitud.folio' },
                  {
                    text: 'Descripcion',
                    align: 'start',
                    filterable: false,
                    value: 'descripcion',
                  },
                  { text: 'Precio de Proveedor', value: 'precioproveedor' },
                  { text: 'Disponible', value: 'disponible' },
                    { text: 'Solicitado', value: 'solicitadas' },
                  { text: 'Unidad de Medida', value: 'unidadmedida' },
                  { text: 'Marca', value: 'marca' },
                  { text: 'Modelo', value: 'modelo' },
                  { text: 'Número de Serie', value: 'numserie' },
                  { text: 'Acciones', align: 'center', value: 'acciones' },

                ],
        global: [],
        solicitadas:[],
        disponibles:[],

  }
},
mounted() {
  this.getAlmacen()

},
methods : {
  async btnactualizar (item) {
    this.idEditar = item.id
    console.log(item)
    this.dialog = true
  },
  async actualizarPartida() {
    this.dialog = false

    try {
          const response = await axios({
            method: 'post',
            url: 'actualizarPInventario',
            data: {
              id: this.idEditar,
              sumar:parseInt(this.cantidadingresada),
              restar:parseInt(this.cantidadretirada),
            }

          })
          this.getAlmacen()
          this.getDisponibles()
          this.getSolicitadas()



          swal("Éxito", "La Partida se actualizó correctamente", "error");
      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
          console.log(error);

      }
  },
  async getAlmacen(){
    try {
          const response = await axios({
            method: 'get',
            url: 'getAlmacen',

          })
          this.global = response.data.response
          console.log(response.data.response)



      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
          console.log(error);

      }
  },

  async getInventario () {
    this.getAlmacen()
  },

  async getDisponibles () {
    try {
          const response = await axios({
            method: 'get',
            url: 'getAlmacenDisponibles',

          })
          this.disponibles = response.data.response
          console.log(response.data.response)



      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
          console.log(error);

      }

  },

  async getSolicitadas () {
    try {
          const response = await axios({
            method: 'get',
            url: 'getAlmacenSolicitadas',

          })
          this.solicitadas = response.data.response
          console.log(response.data.response)



      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
          console.log(error);

      }
  },


}
}
</script>
