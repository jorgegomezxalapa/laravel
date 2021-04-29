<template>
    <v-container fluid>
       <v-row>
         <h5 class="ml-4"><strong>Información de la cotización</strong></h5>
       </v-row>
      <v-row>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="SUBTOTAL"
                      filled
                      dense
                      readonly
                      light
                      v-model="subtotal"

                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="IVA"
                      filled
                      dense
                      readonly
                      light
                      v-model="iva"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="IEPS"
                      filled
                      dense
                      readonly
                      light
                      v-model="ieps"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="TOTAL"
                      filled
                      dense
                      readonly
                      light
                      v-model="total"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="4"
                    sm="6"
                  >
                     <v-text-field
                      label="COSTO DE COMPRA"
                      filled
                      dense
                      readonly
                      light
                      v-model="costocompra"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="4"
                    sm="6"
                  >
                     <v-text-field
                      label="GANANCIA EN PESOS"
                      filled
                      dense
                      readonly
                      light
                      v-model="gananciapesos"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="4"
                    sm="6"
                  >
                     <v-text-field
                      label="GANANCIA EN PROCENTAJE"
                      filled
                      dense
                      readonly
                      light
                      v-model="gananciaporcentaje"
                    ></v-text-field>
                  </v-col>
                </v-row>
                 <v-row>
         
       </v-row>



                <v-row>
                  <v-col
                    cols="12"
                    
                  >
                    <hr>
                    <v-data-table
                 :headers="headers"
                 :items="partidas"
                 :search="search"
                 
        class="elevation-1"
                   :items-per-page="5"
                 >
                  <template v-slot:item.esMejora="{ item }">
                    <span v-if="item.esMejora  == 0"><p>PARTIDA NORMAL</p></span>
                  <span v-else><p>PARTIDA MEJORADA</p></span>
                  </template>
                  
          
               </v-data-table>
                  </v-col>
                 
                </v-row>
    </v-container>
</template>


<script>

 import moment from 'moment'
const axios = require('axios');
    import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  import swal from 'sweetalert';

  setInteractionMode('eager')
  extend('digits', {
    ...digits,
    message: '{_field_} needs to be {length} digits. ({_value_})',
  })
  extend('required', {
    ...required,
    message: '{_field_} no puede quedarse vacío',
  })
  extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
  })
  extend('regex', {
    ...regex,
    message: '{_field_} {_value_} does not match {regex}',
  })
  extend('email', {
    ...email,
    message: 'El formato de email debe ser válido',
  })
    export default {
        components: {
          ValidationProvider,
          ValidationObserver,
        },
        mounted() {
         this.getCotizacion()
         
        
        },
        data: () => ({
          subtotal:null,
          iva:null,
          ieps:null,
          total:null,
          partidas:[],
          search:"",
          headers: [
              {
                text: '# PARTIDA',
                align: 'center',
                value: 'partida',
              },
             
              { text: 'TIPO DE PARTIDA', align: 'center', value: 'esMejora' },
              
              { text: 'DESCRIPCIÓN', align: 'center', value: 'descripcion' },
             
                { text: 'UNIDAD DE MEDIDA', align: 'center', value: 'unidadmedida' },
               
              { text: 'CANTIDAD SOLICITADA', align: 'center', value: 'solicitadas' },

              { text: 'PRECIO DE PROVEEDOR', align: 'center', value: 'precioproveedor' },
             
             
             

              
              { text: 'IIMPORTE 1', align: 'center', value: 'importe1' },
              { text: 'UTILIDAD', align: 'center', value: 'utilidadgenerada' },
              { text: 'PRECIO UNITARIO', align: 'center', value: 'preciounitario' },
              { text: 'IMPORTE 2', align: 'center', value: 'importe2' },

             
            ],
            costocompra:0,
            gananciapesos:0,
            gananciaporcentaje:0,
             Arraynormal : [],
                 Arraymejora : [],


          
         }),
         watch : {
          costocompra: function (newQuestion, oldQuestion) {
            this.gananciapesos = parseFloat(this.total)  - parseFloat(this.costocompra)
            this.gananciapesos = this.gananciapesos.toFixed(2)
            this.gananciaporcentaje = parseFloat(this.gananciapesos)/parseFloat(this.total)
            this.gananciaporcentaje = this.gananciaporcentaje.toFixed(2)
            this.gananciaporcentaje = (this.gananciaporcentaje * 100).toFixed(2)
            this.gananciaporcentaje = this.gananciaporcentaje.toString() + "%"

    }
          

         },
          methods:{
            enviardato(importe){
              
              this.costocompra = this.costocompra + importe
              // console.log(this.costocompra)
            },
            async getCotizacion(){
             
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'getCotizacion',
                      data:{
                        id:parseInt(this.$route.params.id),
                      }
                    })
                 this.cotizacion = response.data.response
                 this.subtotal = this.cotizacion.subtotal
                 this.iva = this.cotizacion.ivaTotal
                 this.ieps = this.cotizacion.iepsTotal
                 this.total = this.cotizacion.total
                 // this.partidas = this.cotizacion.partidas

                 const response2 = await axios({
                      method: 'post',
                      url: 'getPartidasCotizacion',
                      data:{
                        id:parseInt(this.$route.params.id),
                      }
                    })
                 this.partidas = response2.data.response
                
                 let suma = 0
                 let normales = []
                 let mejoradas = []

                 $.each(this.partidas, function(key, value) {
                  if (value.esMejora == 0) {
                    //es normal
                    normales.push(value)
                  }else{
                    //es mejora
                    mejoradas.push(value)
                  }
                  });

                 this.Arraynormal = normales
                 this.Arraymejora = mejoradas

                 var totaldecompra = 0;
                 
                  $.each(normales, function(key, value) {
                    var partidanormal = 0
                      var importenormal = 0
                      var importemejora = 0
                      var importefinal = 0
                     
                    
                    if (value.importe2 != 'NO COTIZA') {
                      
                      var partidanormal = value.partida
                      var importenormal = parseFloat(value.importe1) + ( parseFloat(value.importe1) * (parseFloat(value.ivapartida)/100) )
                      importefinal = importenormal
                      // console.log("importe normal", importenormal)
                      

                      $.each(mejoradas, function(key, value) {
                        if (parseInt(value.partida) == partidanormal) {
                          if (parseFloat(value.importe1) != 'NO COTIZA') {
                            var importemejora = 0
                            var importemejora = parseFloat(value.importe1) + ( parseFloat(value.importe1) * (parseFloat(value.ivapartida)/100) )
                            importefinal = importemejora
                          }
                         
                        }
                        
                        }.bind(this));
                      console.log(importefinal)
                     this.enviardato(importefinal)
                     
                    


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
