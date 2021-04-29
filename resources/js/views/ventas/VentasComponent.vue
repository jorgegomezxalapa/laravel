<template>
    <v-container fluid>
        
        
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"
      >
    <v-card-title class="font-weight-black">MÓDULO DE VENTAS<v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.ventas.length
      }} EN TOTAL
    </v-chip>
    <div class="text-center">
    <v-row>
     
    <v-col cols="12">
      <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.sinAsignar.length}}
      </v-avatar>
      VENTAS SIN ESTATUS ASIGNADO 
                            
                        

                           

      
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
         {{this.disponiblecompra.length}}
      </v-avatar>
      DISPONIBLE PARA COMPRA
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.comprada.length}}
      </v-avatar>
      COMPRADAS
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.disponibleentrega.length}}
      </v-avatar>
      DISPONIBLE PARA ENTREGA
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.entregada.length}}
      </v-avatar>
      ENTREGADAS
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.disponiblefactura.length}}
      </v-avatar>
      DISPONIBLE PARA FACTURA
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.facturada.length}}
      </v-avatar>
      FACTURADAS
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.cobrada.length}}
      </v-avatar>
      COBRADA
    </v-chip>
    </v-col>
    <v-col cols="6"  md="3" class="d-flex justify-center">
    <v-chip
      class="ma-2"
      color="primary"
      text-color="white"
      style="min-width: 100%!important;  text-align: center!important;"
      small

    >
      <v-avatar
        left
        class="primary darken-1"
      >
        {{this.cobradasinfacturar.length}}
      </v-avatar>
      COBRADAS SIN FACTURAR
    </v-chip>
    </v-col>
  </v-row>
  <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Buscar"
        single-line
        hide-details
      ></v-text-field>
  </div>
  </v-card-title>

<v-divider></v-divider>
<v-card-text>
<h4 class="mb-5 mt-5">{{mensaje}}</h4>
  <v-data-table
      :headers="headers"
      :items="ventas"
      :search="search"
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
         <v-chip
        
        color="primary"
      >
      
        {{ item.cotizacion.solicitud.folio }}
      
        
      </v-chip>
      </span>
      <span>
        <router-link :to="{name: 'iniciarCotizacion', params:{id:item.cotizacion.id}}">
      <v-chip
        
        color="primary"
      >
      
        ACCEDER A LA COTIZACIÓN
      
        
      </v-chip>
      </router-link>
      </span>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
        <router-link :to="{name: 'iniciarCotizacion', params:{id:item.id}}">
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
  
  
</v-card-text>
  
    <v-divider></v-divider>
    <v-card-actions>


    </v-card-actions>
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
        mensaje:"MOSTRANDO TODOS LOS RESULTADOS",
        value:0,
        search: '',
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
     methods: {
      mostrarTipo(){

      },
       formatDate(value) {
        var localLocale = moment(value);
moment.locale('es');
localLocale.locale(false);
      return localLocale.format('LL').toUpperCase();
  },
       
        async getVentas(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getVentas',
                })

                this.ventas = response.data.response
                $.each(this.ventas, function(key, value) {
 
                          if (value.disponiblecompra == null && value.comprada == null && value.disponibleentrega == null && value.entregada == null && value.disponiblefactura == null && value.facturada == null && value.cobrada == null && value.cobradasf == null ) {
                          
                            this.sinAsignar.push(value)
                          }

                          if (value.disponiblecompra != null  ) {

                            this.disponiblecompra.push(value)
                          }

                          if (value.comprada != null ) {

                            this.comprada.push(value)
                          }
                          if (value.disponibleentrega != null ) {

                            this.disponibleentrega.push(value)
                          }
                          if (value.entregada != null ) {

                            this.entregada.push(value)
                          }
                          if (value.disponiblefactura != null) {

                            this.disponiblefactura.push(value)
                          }

                          if (value.facturada != null ) {

                            this.facturada.push(value)
                          }

                          if (value.cobrada != null) {

                            this.cobrada.push(value)
                          }

                          if (value.cobradasf != null ) {

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
