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
   <v-tab>Historial de Entrada</v-tab>
   <v-tab>Historial de Salida</v-tab>
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
       href="#tab-2"
       @click="getInventario"
     >
      Segmentos del Inventario
     </v-tab>
       <v-tab
         href="#tab-1"
       >
         Registro de Inventario
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
                      @click="asociarInventario(item)"
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
              label="Buscar Producto"
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
          <template v-slot:item.politicasdegarantia="{ item }">

            <span v-if ="item.politicasdegarantia == 1">Sí Aplica</span>
            <span v-else>No Aplica</span>
          </template>

          <template v-slot:item.acciones="{ item }">
            <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
            <v-btn
            v-if="item.disponible > 0"
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
                <span>Registrar Salida</span>
            </v-tooltip>
            <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
            <v-btn
            v-if="item.disponible == 0"
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
                <span>Ingresar Entrada</span>
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
              v-model="search5"
              append-icon="mdi-magnify"
              label="Buscar Producto"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersEntradas"
            :items="entradas"
            :search="search5"
          >
          <template v-slot:item.politicasdegarantia="{ item }">

            <span v-if ="item.politicasdegarantia == 1">Sí Aplica</span>
            <span v-else>No Aplica</span>
          </template>

          <template v-slot:item.producto="{ item }">
            <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
            <v-btn
             v-bind="attrs"
                v-on="on"
                     small
                      color="warning"
                      dark
                        @click="verProducto(item.producto)"
                      fab
                    >
                      <v-icon>mdi-pencil-box-outline</v-icon>
                    </v-btn>

                </template>
                <span>Ver Detalle del Producto</span>
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
              v-model="search4"
              append-icon="mdi-magnify"
              label="Buscar Producto"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersSalidas"
            :items="salidas"
            :search="search4"
          >
          <template v-slot:item.politicasdegarantia="{ item }">

            <span v-if ="item.politicasdegarantia == 1">Sí Aplica</span>
            <span v-else>No Aplica</span>
          </template>

          <template v-slot:item.producto="{ item }">
            <v-tooltip top>
            <template v-slot:activator="{ on, attrs }">
            <v-btn
             v-bind="attrs"
                v-on="on"
                     small
                      color="warning"
                      dark
                        @click="verProducto(item.producto)"
                      fab
                    >
                      <v-icon>mdi-pencil-box-outline</v-icon>
                    </v-btn>

                </template>
                <span>Ver Detalle del Producto</span>
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
      v-model="modalProducto"
      width="500"
    >
      <template v-slot:activator="{ on, attrs }">

      </template>

      <v-card>
        <v-card-title class="headline grey lighten-2">
          Detalle del producto
        </v-card-title>

        <v-card-text>
          <p>Descripción del producto: {{descripcionModal}}</p> <br>
          <p>Unidad de Medida: {{unidaddemedidaModal}}</p> <br>
            <p>Marca: {{marcaModal}}</p> <br>
            <p>modelo: {{modeloModal}}</p> <br>
            <p>Número de Serie: {{numeroSerieModal}}</p> <br>
            <p v-if="politicasdegarantiaModal == 1">Políticas de garantía: SÍ</p>
              <p v-else>Políticas de garantía: NO</p> <br>
            <p>Notas del prodcuto: {{notasModal}}</p>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="modalProducto = false"
          >
          Cerrar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  <v-dialog
      v-model="dialog"

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
        Salida de Almacén
        </v-card-title>

        <v-card-text>
<br>
          <v-textarea
          outlined

           label="Concepto de salida de mercancía"
             v-model="conceptosalida"

         ></v-textarea>

         <v-file-input
v-model="files"
placeholder="Ingresa tus archivos"
label="Archivos de evidencia salida de mercancía"
multiple
prepend-icon="mdi-paperclip"
>
<template v-slot:selection="{ text }">
<v-chip
small
label
color="primary"
>
{{ text }}
</v-chip>
</template>
</v-file-input>

          <v-text-field
            v-model="cantidadsalida"
            label="Cantidad de salida"
              type="number"

          ></v-text-field>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="salidaPartida"
          >
            Confirmar Salida
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
        files:[],
    dialog:false,
    modalProducto:false,
    cantidadingresada:null,
    cantidadsalida:null,
    conceptosalida:null,
    tab: null,
    model2:'tab-1',
    search1:null,
      search2:null,
        search3:null,
        search4:null,
        search5:null,
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
        headersSalidas: [
          { text: 'Fecha de Salida', value: 'created_at' },
              {
                text: 'Responsable',
                align: 'start',
                filterable: false,
                value: 'empleado.name',
              },
              { text: 'Segmento', value: 'producto.segmento.nombre' },
              { text: 'Concepto', value: 'concepto' },
              { text: 'Cantidad', value: 'cantidad' },

              { text: 'Descripción del producto', value: 'producto.descripcion' },
              { text: 'Evidencias', value: 'evidencias' },
              { text: 'Producto', value: 'producto' },


            ],
            headersEntradas: [
              { text: 'Fecha de Ingreso', value: 'created_at' },
              {
                text: 'Responsable',
                align: 'start',
                filterable: false,
                value: 'empleado.name',
              },
                  {
                    text: 'Segmento',
                    align: 'start',
                    filterable: false,
                    value: 'segmento.nombre',
                  },
                  { text: 'Miniatura', value: '' },
                  { text: 'Cantidad Ingresada', value: 'cantidad' },
                  { text: 'Unidad de Medida', value: 'unidaddemedida' },
                  { text: 'Descripcion', value: 'descripcion' },
                  { text: 'Precio', value: 'preciodelproveedor' },
                    { text: 'Políticas de Garantía', value: 'politicasdegarantia' },
                  { text: 'Marca', value: 'marca' },
                  { text: 'Modelo', value: 'modelo' },
                  { text: 'Número de Serie', value: 'numerodeserie' },
                  { text: 'Notas del Producto', value: 'notasdelproducto' },

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
              { text: 'Fecha de Ingreso', value: 'created_at' },
                  {
                    text: 'Segmento',
                    align: 'start',
                    filterable: false,
                    value: 'segmento.nombre',
                  },
                  { text: 'Miniatura', value: '' },

                  { text: 'Cantidad Disponible', value: 'disponible' },
                  { text: 'Unidad de Medida', value: 'unidaddemedida' },
                  { text: 'Descripcion', value: 'descripcion' },
                  { text: 'Precio', value: 'preciodelproveedor' },
                    { text: 'Políticas de Garantía', value: 'politicasdegarantia' },
                  { text: 'Marca', value: 'marca' },
                  { text: 'Modelo', value: 'modelo' },
                  { text: 'Número de Serie', value: 'numerodeserie' },
                  { text: 'Notas del Producto', value: 'notasdelproducto' },
                  { text: 'Acciones', align: 'center', value: 'acciones' },

                ],
        global: [],
        solicitadas:[],
        disponibles:[],
        salidas:[],
        descripcionModal:null,
        unidaddemedidaModal:null,
        marcaModal:null,
        modeloModal:null,
        numeroSerieModal:null,
        politicasdegarantiaModal:null,
        notasModal:null,
        entradas:[],

  }
},
mounted() {
  this.getAlmacen()
  this.getSalidas()

},
methods : {
  async asociarInventario (item) {
    console.log(item)
  },
    async verProducto (item) {
      console.log(item)
      this.modalProducto = true
      this.descripcionModal = item.descripcion
      this.unidaddemedidaModal = item.unidaddemedida
      this.marcaModal = item.marca
      this.modeloModal = item.modelo
      this.numeroSerieModal = item.numerodeserie
      this.politicasdegarantiaModal = item.politicasdegarantia
      this.notasModal = item.notasdelproducto

    },

  async btnactualizar (item) {
    this.idEditar = item.id
    console.log(item)
    this.dialog = true
  },
  async salidaPartida() {
    this.dialog = false

    try {
          const response = await axios({
            method: 'post',
            url: 'salidaPartida',
            data: {
              id: this.idEditar,
              idEmpleado:parseInt(localStorage.getItem('idPerfil')),
              conceptosalida:this.conceptosalida,
              cantidadsalida:parseInt(this.cantidadsalida),
            }

          })

          swal("Éxito", "La salida se ha realizado con éxito", "success");
          this.getSalidas()
          this.getDisponibles()
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

  async getSalidas(){
    try {
          const response = await axios({
            method: 'get',
            url: 'getSalidas',

          })
          this.salidas = response.data.response


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
          this.entradas = this.disponibles
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
