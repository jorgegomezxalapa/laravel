<template>
    <v-container fluid>
       <v-row>

         <h5 class="font-weight-black ml-4 mt-5"><strong>ACCIONES DISPONIBLES PARA ESTA COTIZACIÓN</strong></h5>
        <v-col cols="12">
          <hr>
        </v-col>
        <v-col cols="12">
          <h5 class="text-center"><strong>ACTUALIAZCIÓN DE ESTATUS</strong></h5>
        </v-col>
       </v-row>
      <v-row>
        <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          
          color="grey lighten-4"
          class="ma-2"
         
        >
        <v-icon
        class="mr-5"
        left
        dark
      >
       mdi-account-cash-outline
      </v-icon>
          Disponible Para Compra
           <v-switch
           @click="disponiblecompramethod()"
      v-model="disponiblecompra"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          
          color="grey lighten-4"
          class="ma-2"
         
        >
         <v-icon
         class="mr-5"
        left
        dark
      >
        mdi-ballot-outline
      </v-icon>
          Disponible Para Facturar
          <v-switch
          @click="disponiblefacturamethod()"
      v-model="disponiblefactura"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          
          color="grey lighten-4"
          class="ma-2"
         
        >
         <v-icon
         class="mr-5"
        left
        dark
      >
        mdi-cash-usd-outline
      </v-icon>
          Comprada
          <v-switch
          @click="compradamethod()"
      v-model="comprada"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          
          color="grey lighten-4"
          class="ma-2"
         
        >
         <v-icon
         class="mr-5"
        left
        dark
      >
        mdi-car
      </v-icon>
          Disponible para Entrega
          <v-switch
          @click="disponibleentregamethod()"
      v-model="disponibleentrega"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
         </v-col>

         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          
          color="grey lighten-4"
          class="ma-2"
         
        >
         <v-icon
         class="mr-5"
        left
        dark
      >
        mdi-cube-send
      </v-icon>
          Entregada
         <v-switch
         @click="entregadamethod()"
      v-model="entregada"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          
          color="grey lighten-4"
          class="ma-2"
         
        >
         <v-icon
         class="mr-5"
        left
        dark
      >
        mdi-account-check
      </v-icon>
          Cobrada
          <v-switch
          @click="cobradamethod()"
      v-model="cobrada"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
         </v-col>   
                  
                </v-row>
                <v-row>
                  <v-col cols="12" md="6">
                    <center>
                       <hr>
          <h5 class="text-center"><strong>GENERACIÓN DE DOCUMENTOS</strong></h5>
          <img :src="'img/documento.png'" width="50%" style="cursor: pointer">
                    </center>
          
        </v-col>
        
        <v-col cols="12" md="6">
          <center>
             <hr>
          <h5 class="text-center"><strong>CARGA DE DOCUMENTOS</strong></h5>
          <img :src="'img/carga.png'" width="50%" style="cursor: pointer">
          </center>
          
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
        disponiblecompra:false,
        disponiblefactura:false,
        comprada:false,
        disponibleentrega:false,
        entregada:false,
        cobrada:false,
         


          
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
                        id:this.$route.params.id,
                      }
                    })
                 this.cotizacion = response.data.response

                 if (this.cotizacion != null) {
                  this.disponiblecompra = this.cotizacion.disponiblecompra
                 this.disponiblefactura = this.cotizacion.disponiblefactura
                 this.comprada = this.cotizacion.comprada
                 this.disponibleentrega = this.cotizacion.disponibleentrega
                 this.entregada = this.cotizacion.entregada
                 this.cobrada = this.cotizacion.cobrada
                 }
               
                

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async disponiblecompramethod(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'disponiblecompra',
                      data:{
                        id:this.$route.params.id,
                        accion:this.disponiblecompra
                      }
                    })
             swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

            
             async disponiblefacturamethod(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'disponiblefactura',
                      data:{
                        id:this.$route.params.id,
                        accion:this.disponiblefactura
                      }
                    })
              swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

             async compradamethod(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'comprada',
                      data:{
                        id:this.$route.params.id,
                        accion:this.comprada
                      }
                    })
               swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

             async disponibleentregamethod(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'disponibleentrega',
                      data:{
                        id:this.$route.params.id,
                        accion:this.disponibleentrega
                      }
                    })
                swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

             async entregadamethod(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'entregada',
                      data:{
                        id:this.$route.params.id,
                        accion:this.entregada
                      }
                    })
               swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

             async cobradamethod(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'cobrada',
                      data:{
                        id:this.$route.params.id,
                        accion:this.cobrada
                      }
                    })
                swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE HA ACTUALIZADO", "success");

                } catch (error) {
                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            


            
          },

    }
</script>
