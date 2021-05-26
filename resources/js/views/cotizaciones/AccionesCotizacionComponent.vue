<template>
    <v-container fluid>
       <v-row>
        <center>
          <h5 class="font-weight-black ml-4 mt-5"><strong>ACCIONES DISPONIBLES PARA ESTA COTIZACIÓN</strong></h5>
        </center>
         
       </v-row>
      
                <v-row>
                 
        
       
         <v-col cols="12" md="6">
                    <center>
                      <v-btn  @click="modalDescarga()" color="primary" block>
                        DESCARGAR FORMATO DE COTIZACIÓN
                      </v-btn>
                    </center>
          
        </v-col>

         
        
                </v-row>
                <v-row>
                  <v-col
    cols="12"
    md="6"
    >
      <v-card
      class="mx-auto"
      outlined
      >
        <v-container fill-height>
          <v-row justify="center" align="center">
            <v-col cols="12" md="7">
              <p class="font-weight-black">ACTUALIZAR EL ESTATUS A COTIZADA</p>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="finalizarCotizacion()"
              v-model="finalizar"
              inset
              color="success"
              class="float-left"
              v-bind:disabled="esFinalizada"
              ></v-switch>
            <p class="mt-5" v-if="esFinalizada"><strong>COTIZACIÓN FINALIZADA</strong></p>
            </v-col>
            
           
          </v-row>

        </v-container>
      </v-card>
    </v-col>
                </v-row>
                <v-row>
                  <v-col
    cols="12"
    md="6"
    >
      <v-card
      class="mx-auto"
      outlined
      >
        <v-container fill-height>
          <v-row justify="center" align="center">
            <v-col cols="12" md="7">
              <p class="font-weight-black">TURNAR COTIZACIÓN Y HABILITAR EN VENTAS</p>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="turnarCotizacion()"
              v-model="turnar"
              inset
              color="success"
              class="float-left"
              v-bind:disabled="esVenta"
              ></v-switch>
              <p class="mt-5" v-if="esVenta"><strong>TURNADA A VENTAS</strong></p>
            
            </v-col>
            
           
          </v-row>
          
        </v-container>
      </v-card>
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
          
        cotizacion:[],
        finalizar:false,
        turnar:false,
        esFinalizada:false,
        esVenta:false,

     
         }),
         watch : {
          

         },
          methods:{
            async turnarCotizacion(){

                const response = await axios({
                  method: 'post',
                  url: 'turnarVenta',
                  data:{
                    idCotizacion:parseInt(this.$route.params.id),
                  }
                })
                swal("LA COTIZACIÓN FUÉ TURNADA A VENTAS", "", "success");
                this.esVenta = true

            },
            async getRazones(){
              this.formatos = []
              this.documentos = []
              this.url = null
               try {
                const response = await axios({
                  method: 'get',
                  url: 'getRazon',
                })

                this.razones = response.data.response
                


            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "Por favor recarga la página", "error");
                console.log(error);

            }
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
                 if (parseInt(this.cotizacion.estatus) == 2) {
                  this.esFinalizada = true
                  this.finalizar = true
                 }else{
                  this.finalizar = false
                 }
              
                
                 if (this.cotizacion.venta) {
                  if (this.cotizacion.venta.idCotizacion) {
                    this.esVenta = true
                  this.turnar = true
                  }
                  
                 }else{
                  this.turnar = false

                 }
               

                
               
                

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

            async finalizarCotizacion(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'finalizarCotizacion',
                      data:{
                        id:this.$route.params.id,
                        accion:this.finalizar
                      }
                    })
             swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");
             this.esFinalizada = true

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);
                }
            },

           

            
             

         
            


            
          },

    }
</script>
