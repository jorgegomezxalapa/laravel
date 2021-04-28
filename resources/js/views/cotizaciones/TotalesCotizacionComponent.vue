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
             
             
              
              { text: 'DESCRIPCIÓN', align: 'center', value: 'descripcion' },
             
                { text: 'UNIDAD DE MEDIDA', align: 'center', value: 'unidadmedida' },
               
              { text: 'CANTIDAD SOLICITADA', align: 'center', value: 'solicitadas' },

              { text: 'PRECIO DE PROVEEDOR', align: 'center', value: 'precioproveedor' },
             
             
             

              
              { text: 'IIMPORTE 1', align: 'center', value: 'importe1' },
              { text: 'UTILIDAD', align: 'center', value: 'utilidadgenerada' },
              { text: 'PRECIO UNITARIO', align: 'center', value: 'preciounitario' },
              { text: 'IMPORTE 2', align: 'center', value: 'importe2' },

             
            ],
            costocompra:null,
            gananciapesos:null,
            gananciaporcentaje:null,
         


          
         }),
         watch : {
          

         },
          methods:{
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
                 this.partidas = this.cotizacion.partidas

                 let list=[];
                 this.costocompra = 0
                  $.each(this.partidas, function(key, value) {
                   
                    if ( value.esMejora  == 0 ) {
                      list.push(value);
                    }
                       
                     });
                  this.partidas = list
                 console.log("partidas", this.partidas)
                

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            
          },

    }
</script>
