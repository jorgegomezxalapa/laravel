<template>
    <v-container fluid>
      <v-btn class="primary" @click="excelentrada = true" block>
                    GENERAR FORMATO DE EXCEL
                  </v-btn>
      <a type="button" style="display: none;"  :href="hreff" value="facebook" target="_blank" class="button" ref="myBtn">hola</a>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"



      >
    <v-card-title class="font-weight-black">
      <v-tabs v-model="tab"
          align-with-title>
   <v-tab>Almacén</v-tab>
   <v-tab @click="getInventarioTotal">Inventario Total</v-tab>
   <v-tab @click="getPartidasSolicitadas">Partidas Solicitadas</v-tab>
   <v-tab @click="getInventario">Inventario Disponible</v-tab>
   <v-tab @click="getHistorialEntrada">Historial de Entrada</v-tab>
   <v-tab @click="getHistorialSalida">Historial de Salida</v-tab>
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
              v-model="buscarInventarioTotal"
              append-icon="mdi-magnify"
              label="Buscar Producto"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersInventarioTotal"
            :items="inventarioTotal"
            :search="buscarInventarioTotal"
          >
          <template v-slot:no-data>
    Aún no hay información disponible
    </template>
          <template v-slot:item.esSolicitud="{ item }">


             <v-chip
      class="ma-2"
      color="orange"
      dark
      v-if="item.esSolicitud == 1"
    >
      Comprometido
    </v-chip>
    <v-chip
      class="ma-2"
      color="primary"
      v-else
      dark
    >
      Disponible
    </v-chip>

          </template>
          <template v-slot:item.documentos="{ item }">
            <p>idPartida{{ idPartida = item.partida.id}}</p>
            <p>idCotizacion{{ idCotizacion = item.partida.idCotizacion}}</p>
          
     <span
                      v-for="(item) in item.documentos"
                      v-bind:key="item.documentos"
                    >
                    <v-chip
                    class="ma-2"
                       small
                       color="secondary"
                       v-if="item != ''"
                     :href="`http://localhost/laravel/storage/app/cotizaciones/${idCotizacion}/${idPartida}/${item}`" target="_blank"
                    >
                   
{{item}}
                      
                    </v-chip>
                            <p v-if="item == ''"><strong>Sin Documentos Adjuntos</strong></p>              
                   
                    </span>
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
              v-model="buscarSolicitadas"
              append-icon="mdi-magnify"
              label="Buscar Partida"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersPartidasSolicitadas"
            :items="partidasSolicitadas"
            :search="buscarSolicitadas"
          >
          <template v-slot:no-data>
    Aún no hay información disponible
    </template>
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
                <span>Marcar Ingreso de Mercancía</span>
            </v-tooltip>


          </template>
          <template v-slot:item.producto.notasdelproducto="{ item }">
             {{item.producto.notasdelproducto}}
                <div v-if="item.producto.archivosdenotas != null">
                  
                  <v-chip small class="mb-1" v-for="(imagen, index) in item.producto.archivosdenotas.split(',')" 
                :key="index"
                @click="abrirpopupcomentarios(item.idCotizacion,item.partida,imagen)"
                >{{
                    imagen
                }}</v-chip>
                </div>
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
              v-model="buscarInventarioDisponible"
              append-icon="mdi-magnify"
              label="Buscar Producto"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersInventarioDisponible"
            :items="inventarioDisponible"
            :search="buscarInventarioDisponible"
          >
          <template v-slot:no-data>
    Aún no hay información disponible
    </template>
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
                  
                </v-card-text>

                <v-card-text>

                  <v-text-field
              v-model="buscarHistorialEntradas"
              append-icon="mdi-magnify"
              label="Buscar Producto"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>

          <v-data-table
            :headers="headersInventarioEntradas"
            :items="inventarioEntradas"
            :search="buscarHistorialEntradas"
          >
          <template v-slot:no-data>
    Aún no hay información disponible
    </template>
          <template v-slot:item.producto.politicasdegarantia="{ item }">

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

          <template v-slot:item.documentos="{ item }">
           
          
     <span
                      v-for="(item) in item.documentos"
                      v-bind:key="item.documentos"
                    >
                    <v-chip
                    class="ma-2"
                       small
                       color="secondary"
                       v-if="item != ''"
                     @click="abrirpopup3(item)"
                    >
                      {{item}}
                    </v-chip>
                            <p v-if="item == ''"><strong>Sin Documentos Adjuntos</strong></p>              
                   
                    </span>
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
              v-model="buscarInventarioSalidas"
              append-icon="mdi-magnify"
              label="Buscar Producto"
              single-line
              hide-details
            ></v-text-field>
            <br> <br>
          </v-card-title>
          <v-data-table
            :headers="headersInventarioSalidas"
            :items="inventarioSalidas"
            :search="buscarInventarioSalidas"
          >
          <template v-slot:no-data>
    Aún no hay información disponible
    </template>
          <template v-slot:item.politicasdegarantia="{ item }">

            <span v-if ="item.politicasdegarantia == 1">Sí Aplica</span>
            <span v-else>No Aplica</span>
          </template>

          <template v-slot:item.documentos="{ item }">
          
          
     <span
                      v-for="(item) in item.documentos"
                      v-bind:key="item.documentos"
                    >
                    <v-chip
                    class="ma-2"
                       small
                       color="secondary"
                       v-if="item != ''"
                     @click="abrirpopup2(item)"
                    >
                      {{item}}
                    </v-chip>
                            <p v-if="item == ''"><strong>Sin Documentos Adjuntos</strong></p>              
                   
                    </span>
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
      v-model="modalEntrada"
      width="500"
    >


      <v-card>
        <v-card-title class="headline grey lighten-2">
          Entrada de Mercancía
        </v-card-title>

        <v-card-text>
          <v-text-field
            v-model="ingresoProducto"
              type="number"
            label="Coloque la cantidad de Entrada de Mercancía"

          ></v-text-field>

          <v-textarea
          outlined

           label="Concepto de Entrada de Mercancía"
             v-model="conceptoentrada"

         ></v-textarea>
         <v-file-input
v-model="files2"
placeholder="Ingresa tus archivos"
label="Archivos de evidencia de entrada de mercancía"
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
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
              @click="actualizarIngreso()"
          >
            Confirmar Ingreso
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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

     <v-dialog
      v-model="excelentrada"
      width="100%"
    >
    

      <v-card>
        <v-card-title class="headline grey lighten-2">
          FORMATO DE EXCEL
        </v-card-title>
         <v-card-text v-if="!filtrado">
         <v-row class="mt-5" align="center">
          <v-col
            align="center"
            cols="12"
           >
            
             <v-select
              v-model="oexcel"
              label="Selecciona una opción"
              :items="exceles"
              item-text="text"
              item-value="value"
              
            ></v-select>
           </v-col>
            <v-col
            align="center"
            cols="12"
            md="6">
             <v-btn
            color="primary"
            class="mt-1 mb-1"
            @click="descargarEntrada(0)"
            >
            DESCARGAR FORMATO COMPLETO
          </v-btn>
           </v-col>
           <v-col
           align="center"
           cols="12"
           md="6">
             <v-btn
            color="primary"
            class="mt-1 mb-1"
            @click="filtrado = true"
            >
            DESCARGAR FORMATO CON FILTROS
          </v-btn>
           </v-col>
         </v-row>
         </v-card-text>
        <v-card-text v-if="filtrado">
           <v-btn
      class="ma-2"
      outlined
      @click="filtrado = false"
    >
     REGRESAR
    </v-btn>
          <h4 class="mt-3 mb-3">PORFAVOR SELECCIONA UN RANGO DE FECHAS</h4>
          <p v-if="dates.length != 0"><strong>Fechas seleccionadas :</strong></p>
          
          <span v-for="(item,i) in dates"
                      v-bind:key="i" class="mr-5">
                        {{formatDate(item)}}
                      </span>

                      <v-btn
         v-if="dates.length == 2"
            color="primary"
            class="mt-1 mb-1"
            @click="descargarEntrada(1)"
          >
            DESCARGAR FORMATO FILTRADO
          </v-btn>
         
         <v-date-picker
        v-model="dates"
        range
         full-width
      class="mt-4"
      ></v-date-picker>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="excelentrada = false"
          >
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-container>
</template>

<script>
   import moment from 'moment'
const axios = require('axios');
import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
import swal from 'sweetalert';
export default {
data () {
  return {
    oexcel:null,
    filtrado:false,
    ingresoProducto:null,
    conceptoentrada:null,
    idEditar:null,
    files:[],
     files2:[],
     exceles :[
     { text: 'Registro de Entradas', value: '0' },
     { text: 'Registro de Salidas', value: '1' },
     ],
    dialog:false,
    modalEntrada:false,
    modalProducto:false,
    cantidadingresada:null,
    cantidadsalida:null,
    conceptosalida:null,
    tab: null,
    model2:'tab-1',
    buscarInventarioTotal:"",
   buscarSolicitadas:"",
   buscarInventarioSalidas:"",
   buscarHistorialEntradas:"",
   buscarInventarioDisponible:"",
    headersPartidasSolicitadas: [
      { text: 'Número de Folio', value: 'cotizacion.solicitud.folio' },

          { text: 'Número de Partida', value: 'partida' },
              {
                text: 'Descripcion',
                align: 'start',

                value: 'producto.descripcion',
              },
               {
                text: 'COMENTARIOS',
                align: 'start',

                value: 'producto.notasdelproducto',
              },

          { text: 'Disponible', value: 'producto.disponible' },
            { text: 'Solicitado', value: 'producto.cantidad' },
          { text: 'Unidad de Medida', value: 'producto.unidaddemedida' },
          { text: 'Marca', value: 'producto.marca' },
          { text: 'Modelo', value: 'producto.modelo' },
          { text: 'Número de Serie', value: 'producto.numerodeserie' },
          { text: 'Acciones', align: 'center', value: 'acciones' },

        ],
        headersInventarioSalidas: [
          { text: 'Fecha de Salida', value: 'created_at' },
              {
                text: 'Responsable',
                align: 'start',

                value: 'empleado.name',
              },
              { text: 'Segmento', value: 'producto.segmento.nombre' },
              { text: 'Concepto de Salida', value: 'concepto' },
              { text: 'Cantidad', value: 'cantidad' },

              { text: 'Descripción del producto', value: 'producto.descripcion' },
              { text: 'Evidencias', value: 'documentos' },
              { text: 'Producto', value: 'producto' },


            ],
            headersInventarioEntradas: [
              { text: 'Fecha de Ingreso', value: 'created_at' },
              {
                text: 'Responsable',
                align: 'start',

                value: 'responsable.name',
              },
                  {
                    text: 'Segmento',
                    align: 'start',

                    value: 'producto.segmento.nombre',
                  },
                  
                  { text: 'Cantidad Ingresada', value: 'cantidad' },
                  { text: 'Unidad de Medida', value: 'producto.unidaddemedida' },
                  { text: 'Descripcion', value: 'producto.descripcion' },
                  { text: 'Precio', value: 'producto.preciodelproveedor' },

                  { text: 'Marca', value: 'producto.marca' },
                  { text: 'Modelo', value: 'producto.modelo' },
                  { text: 'Número de Serie', value: 'producto.numerodeserie' },
                  { text: 'Concepto de Entrada', value: 'concepto' },
                  { text: 'Evidencias', value: 'documentos' },

                ],


            headersInventarioDisponible: [
              
              { text: 'Descripcion', value: 'descripcion' },
              {
                text: 'Segmento',
                align: 'start',

                value: 'segmento.nombre',
              },
              { text: 'Cantidad Disponible', value: 'disponible' },
              { text: 'Unidad de Medida', value: 'unidaddemedida' },
              { text: 'Precio', value: 'preciodelproveedor' },
              { text: 'Marca', value: 'marca' },
              { text: 'Modelo', value: 'modelo' },
              { text: 'Número de Serie', value: 'numerodeserie' },
              { text: 'Políticas de Garantía', value: 'politicasdegarantia' },
              { text: 'Notas del Producto', value: 'notasdelproducto' },
              { text: 'Acciones', align: 'center', value: 'acciones' },

                ],
                headersInventarioTotal: [
              
              
              { text: 'Descripcion', value: 'descripcion' },
              {
                text: 'Segmento',
                align: 'start',

                value: 'segmento.nombre',
              },
              { text: 'Cantidad', value: 'disponible' },
              { text: 'Unidad de Medida', value: 'unidaddemedida' },
              
              { text: 'Marca', value: 'marca' },
              { text: 'Modelo', value: 'modelo' },
              { text: 'Número de Serie', value: 'numerodeserie' },
              {text : 'Documentación Soporte', value :'documentos'},
              { text: 'Estatus', value: 'esSolicitud' },
                ],


        descripcionModal:null,
        unidaddemedidaModal:null,
        marcaModal:null,
        modeloModal:null,
        numeroSerieModal:null,
        politicasdegarantiaModal:null,
        notasModal:null,


        partidasSolicitadas:[],
        inventarioDisponible:[],
        inventarioEntradas:[],
        inventarioSalidas:[],
        inventarioTotal:[],

        idPartidaEntrada:null,
        idProductoEntrada:null,
        idCotizacionEntrada:null,

        excelentrada:false,
        dates: [],
        hreff:null,

  }
},
mounted() {

},

watch: {

  oexcel: function (newVal, oldVal) {
    this.hreff = "getExcel/"+newVal
    },
   
    filtrado: function (newVal, oldVal) {
     if (!newVal) {
      this.dates = []
     }
    }
  },

methods : {
  async descargarEntrada(completo){
   
    const elem = this.$refs.myBtn
   
   
    console.log(this.$refs.myBtn)
            elem.click()
    try {
            

      } catch (error) {

        

      }

  
    if (parseInt(completo) == 0) {
      //completo
    }else{
      //filtrado
    }
  },

  formatDate(value) {
        var localLocale = moment(value);
        moment.locale('es');
        localLocale.locale(false);
        return localLocale.format('LL')
  },
  abrirpopupcomentarios(idCotizacion,idPartida,imagen){
             
              // var url = process.env.MIX_ARCHIVOS_URL;
              var url = 'http://localhost/laravel/storage/app/cotizaciones/'+idCotizacion+'/'+idPartida+'/'
              window.open(url+imagen,'popup','width=600,height=600')
              // falta poner la ruta real

            },
 abrirpopup(url2){
              // var url = process.env.MIX_ARCHIVOS_URL;
              console.log(url2)
              var url = 'http://localhost/laravel/storage/app/cotizaciones/'
              window.open(url+url2,'popup','width=600,height=600')
              // falta poner la ruta real

            },
            abrirpopup2(item){
              // var url = process.env.MIX_ARCHIVOS_URL;
              var url = 'http://localhost/laravel/storage/app/evidenciaSalidas/'
              window.open(url+item,'popup','width=600,height=600')
              // falta poner la ruta real

            },
            abrirpopup3(item){
              // var url = process.env.MIX_ARCHIVOS_URL;
              var url = 'http://localhost/laravel/storage/app/evidenciaEntradas/'
              window.open(url+item,'popup','width=600,height=600')
              // falta poner la ruta real

            },
  async actualizarIngreso () {

    let formData = new FormData()
            formData.append( 'idEmpleado' , parseInt(localStorage.getItem('idPerfil')) )
            formData.append( 'idCotizacion'  , this.idCotizacionEntrada )
            formData.append( 'idPartida'  , this.idPartidaEntrada )
            formData.append( 'idProducto'  , this.idProductoEntrada )
            formData.append( 'cantidad' , this.ingresoProducto )
            formData.append( 'concepto'  , this.conceptoentrada )
    
                    if(this.files2.length != 0){
                        for(let i = 0; i < this.files2.length; i++){
                            let file = this.files2[i]
                            
                            formData.append('archivo['+i+']',file)
                        }
                    }


    try {
        const response = await axios({
          method: 'post',
          url: 'actualizarIngresoPartida',
          data:formData,
        })
       this.modalEntrada = false
        swal("Éxito", "El ingreso de la mercancía se ha realizado correctamente", "success");
        this.getPartidasSolicitadas()
        this.idCotizacionEntrada = null
        this.idPartidaEntrada = null
        this.idProductoEntrada = null
        this.ingresoProducto = null
        this.conceptoentrada = null
        this.files2.splice(0)

    } catch (error) {

       swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");

    }
  },
    async getPartidasSolicitadas () {
      try {
          const response = await axios({
            method: 'get',
            url: 'getInventarioSolicitado',
          })
          console.log(response.data.response)
        this.partidasSolicitadas = response.data.response

      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");

      }

    },
    async getInventarioTotal () {
      try {
          const response = await axios({
            method: 'get',
            url: 'getInventarioTotal',
          })
          console.log(response.data.response)
        this.inventarioTotal = response.data.response

      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");

      }

    },
    async getInventario () {
      try {
          const response = await axios({
            method: 'get',
            url: 'getInventario',
          })

          this.inventarioDisponible = response.data.response

      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");

      }
    },
    async getHistorialEntrada () {
       try {
          const response = await axios({
            method: 'get',
            url: 'getEntradas',
          })

          this.inventarioEntradas = response.data.response
          console.log(response.data)

      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");

      }
    },
    async getHistorialSalida () {

      try {
         const response = await axios({
           method: 'get',
           url: 'getSalidas',
         })

         this.inventarioSalidas = response.data.response
         console.log("salidas",response.data.response)

     } catch (error) {

        swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");

     }

    },


  async asociarInventario (item) {
    this.modalEntrada = true
    this.idCotizacionEntrada = item.idCotizacion
    this.idPartidaEntrada = item.id
    this.idProductoEntrada = item.producto.id
    console.log("actualizar",item)
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
    let formData = new FormData()
    formData.append( 'id', this.idEditar )
    formData.append( 'idEmpleado', parseInt(localStorage.getItem('idPerfil')) )
    formData.append( 'conceptosalida',this.conceptosalida )
    formData.append( 'cantidadsalida',this.cantidadsalida )
                       
                  
                    if(this.files.length != 0){
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            
                            formData.append('archivo['+i+']',file)
                        }
                    }

    try {
          const response = await axios({
            method: 'post',
            url: 'salidaPartida',
            data: formData

          })

          swal("Éxito", "La salida se ha realizado con éxito", "success");
           this.files.splice(0)
          this.conceptosalida = null
          this.cantidadsalida = null
          this.getInventario()
          this.getHistorialSalida()
          this.getHistorialEntrada()

      } catch (error) {

         swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
          console.log(error);

      }
  },


}
}
</script>
