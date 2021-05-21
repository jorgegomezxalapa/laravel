<template>
    <v-container fluid>
        
        <h5 class="font-weight-black mt-3 mb-3 ml-1">MÓDULO DE VENTAS</h5>
         <br>
        <h6><strong>TOTAL DE VENTAS</strong><v-chip
           small
        
          class="primary ml-3"
      
        >
         {{getLongitud(this.ventas)}}
        </v-chip></h6>
        <br>
        
        
        
      
       <v-row>
        <v-col cols="12">
           <v-chip
           default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.sinAsignar)}}</strong>
        </v-avatar>
          VENTAS SIN ESTATUS ASIGNADOS
        </v-chip>
      </v-col>
         <v-col cols="12" md="3">
           <v-chip
           default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.disponiblecompra)}}</strong>
        </v-avatar>
          DISPONIBLE PARA COMPRA
        </v-chip>
        <v-chip
        default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.comprada)}}</strong>
        </v-avatar>
          COMPRA REALIZADA
        </v-chip>
         </v-col>
         <v-col cols="12" md="3">
           <v-chip
           default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.disponibleentrega)}}</strong>
        </v-avatar>
          DISPONIBLE PARA ENTREGA
        </v-chip>
        <v-chip
        default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.entregada)}}</strong>
        </v-avatar>
          ENTREGA REALIZADA
        </v-chip>
         </v-col>
         <v-col cols="12" md="3">
           <v-chip
           default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.disponiblefactura)}}</strong>
        </v-avatar>
          DISPONIBLE PARA FACTURA
        </v-chip>
        <v-chip
        default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.facturada)}}</strong>
        </v-avatar>
          FACTURA REALIZADA
        </v-chip>
         </v-col>
         <v-col cols="12" md="3">
          <v-chip
        default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.cobradasinfacturar)}}</strong>
        </v-avatar>
          COBRADA SIN FACTURAR
        </v-chip>
             <v-chip
             default
        small
          class="primary mr-1 mt-1 mb-1"
      
        >
          <v-avatar
          left
          class="primary dark"
        >
          <strong>{{getLongitud(this.cobrada)}}</strong>
        </v-avatar>
          COBRADA
        </v-chip>

         </v-col>
       </v-row>
        <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
      
        justify="space-around"
      > 
    <v-row>
      <v-col cols="12" md="6">
          <h6 class="font-weight-black mt-3 mb-3 ml-1">LISTA DE RESULTADOS</h6>
      </v-col>
      <v-col cols="12" md="6">
          <v-row>
            <v-col cols="12" md="3">
                <h6 class="font-weight-black mt-3 mb-3 ml-1">FILTRAR POR</h6>
            </v-col>
            <v-col cols="12" md="9">
                <v-select
                small
                  :items="filtros"
                  v-model="filtro"
                   item-text="nombre"
                  item-value="id"
                  label="SELECCIONA UNA OPCIÓN"
                  solo
                ></v-select>
            </v-col>

          </v-row>
         
      </v-col>

    </v-row>

         <v-data-table
          :headers="headers"
          :items="ventas"
        
        >
       <template v-slot:no-data>
     
        <strong>NO HAY INFORMACÍÓN DISPONIBLE</strong>
      
    </template>
    <template v-slot:item.cotizacion.solicitud.created_at="{ item }">
      {{formatDate(item.cotizacion.solicitud.created_at)}}

    </template>
    <template v-slot:item.created_at="{ item }">
      {{formatDate(item.created_at)}}
    </template>
      
      <template v-slot:item.cotizacion.solicitud.folio="{ item }">
       

      <span>
        <router-link :to="{name: 'iniciarCotizacion', params:{id:item.cotizacion.id}}">
      <v-chip
      class="mt-1"
        small
       color="primary"
      outlined
      >
      
        ACCEDER A LA COTIZACIÓN <strong class="ml-3">{{ item.cotizacion.solicitud.folio }}</strong>
      
        
      </v-chip>
      </router-link>
      </span>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
        <router-link :to="{name: 'actualizarVentar', params:{id:item.id}}">
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
            </router-link>
          </template>
          <span>ACTUALIZAR ESTATUS</span>
      </v-tooltip>
    </template>
        
        </v-data-table>
    </v-card>
     
    </v-container>
</template>

<script>
   import moment from 'moment'
    export default {
      mounted(){
    this.getVentas()

   },
    data () {
      return {  
        filtro:0,
        item:0,
     
         filtros: [  {nombre : "TODAS LAS VENTAS" , id : 0 },
                     {nombre : "SIN ESTATUS ASIGNADO" , id : 1 },
                     {nombre : "DISPONIBLE PARA COMPRA" , id : 2 },
                     {nombre : "COMPRA REALIZADA" , id : 3 },
                     {nombre : "DISPONIBLE PARA ENTREGA" , id : 4 },
                     {nombre : "ENTREGA REALIZADA" , id : 5 },
                     {nombre : "DISPONIBLE PARA FACTURA" , id : 6  },
                     {nombre : "FACTURA REALIZADA" , id : 7 },
                     {nombre : "COBRADA SIN FACTURAR" , id : 8  },
                     {nombre : "COBRADA" , id : 9 }],
       headers: [
        {
            text: 'Fecha de Solicitud',
            align: 'start',
            filterable: false,
            value: 'cotizacion.solicitud.created_at',
          },
          {
            text: 'Fecha de Venta',
            align: 'start',
            filterable: false,
            value: 'created_at',
          },
          { text: 'Folio', value: 'cotizacion.solicitud.folio' },
          { text: 'Subtotal', value: 'subtotal' },
          { text: 'IVA', value: 'iva' },
          { text: 'IEPS', value: 'ieps' },
          { text: 'TOTAL', value: 'total' },
          { text: 'ACCIONES', value: 'actions' },
        ],
        ventas:[],
        sinAsignar:[],
        disponiblecompra:[],
        comprada:[],
        disponibleentrega:[],
        entregada:[],
        disponiblefactura:[],
        facturada:[],
        cobrada:[],
        cobradasinfacturar:[],

      }
    },
    watch : {
    filtro: function (newVal, oldVal) {
      this.ventas = []
      switch (parseInt(newVal)) {
        case 0:
          this.getVentas()
         break;
        case 1:
         this.ventas = this.sinAsignar
          break;
       
        case 2:
        this.ventas = this.disponiblecompra
          break;
          case 3:
          this.ventas = this.comprada
         break;
         case 4:
          this.ventas = this.disponibleentrega
         break;
         case 5:
          this.ventas = this.entregada
         break;
         case 6:
          this.ventas = this.disponiblefactura
         break;
         case 7:
          this.ventas = this.facturada
         break;
         case 8:
          this.ventas = this.cobrada
         break;
         case 9:
          this.ventas = this.cobradasf
         break;
        default:
          return false;
          break;
      }
    }          

         },
     methods: {
      getLongitud(arreglo){
      
        return arreglo.length;
        
      },
     
       formatDate(value) {
        var localLocale = moment(value);
moment.locale('es');
localLocale.locale(false);
      return localLocale.format('LL').toUpperCase();
  },
  limpiarArreglos(){
    this.ventas = []
    this.sinAsignar = []
    this.disponiblecompra = []
    this.comprada = []
    this.disponibleentrega = []
    this.entregada = []
    this.disponiblefactura = []
    this.facturada = []
    this.cobrada = []
    this.cobradasf = []
    return true;
  },
       
        async getVentas(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getVentas',
                })
                this.limpiarArreglos()

                this.ventas = response.data.response
                $.each(this.ventas, function(key, value) {
 
                          if (value.disponiblecompra != null && value.comprada != null && value.disponibleentrega != null && value.entregada != null && value.disponiblefactura != null && value.facturada != null && value.cobrada != null && value.cobradasf != null && 
  value.disponiblecompra == 0 && value.comprada == 0 && value.disponibleentrega == 0 && value.entregada == 0 && value.disponiblefactura == 0 && value.facturada == 0 && value.cobrada == 0 && value.cobradasf == 0 ) {
                          
                            this.sinAsignar.push(value)
                          }

                          if (value.disponiblecompra != null && value.disponiblecompra != 0  ) {

                            this.disponiblecompra.push(value)
                          }

                          if (value.comprada != null && value.comprada != 0 ) {

                            this.comprada.push(value)
                          }
                          if (value.disponibleentrega != null && value.disponibleentrega != 0 ) {

                            this.disponibleentrega.push(value)
                          }
                          if (value.entregada != null && value.entregada != 0 ) {

                            this.entregada.push(value)
                          }
                          if (value.disponiblefactura != null && value.disponiblefactura != 0) {

                            this.disponiblefactura.push(value)
                          }

                          if (value.facturada != null && value.facturada != 0 ) {

                            this.facturada.push(value)
                          }

                          if (value.cobrada != null && value.cobrada != 0) {

                            this.cobrada.push(value)
                          }

                          if (value.cobradasf != null && value.cobradasf != 0 ) {

                            this.cobradasinfacturar.push(value)
                          }
                           
                }.bind(this));
               
            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        },

        

        

     },
  }
</script>
