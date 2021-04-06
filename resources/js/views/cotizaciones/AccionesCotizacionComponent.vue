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
        <v-chip
        small
        @click="verDocumento(item)"
         v-for="(item, i) in evidencia1"
          :key="i"
      class="ma-2"
      color="primary"
    >
      {{item}}
    </v-chip>

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
          Disponible Para Factura
          <v-switch
          @click="disponiblefacturamethod()"
      v-model="disponiblefactura"
     color="success"
     class="ml-5"
    ></v-switch>
        </v-btn>
        <v-chip
        small
        @click="verDocumento(item)"
         v-for="(item, i) in evidencia2"
          :key="i"
      class="ma-2"
      color="primary"
    >
      {{item}}
    </v-chip>
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
        <v-chip
        small
        @click="verDocumento(item)"
         v-for="(item, i) in evidencia3"
          :key="i"
      class="ma-2"
      color="primary"
    >
      {{item}}
    </v-chip>
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
        <v-chip
        small
        @click="verDocumento(item)"
         v-for="(item, i) in evidencia4"
          :key="i"
      class="ma-2"
      color="primary"
    >
      {{item}}
    </v-chip>
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
        <v-chip
        small
        @click="verDocumento(item)"
         v-for="(item, i) in evidencia5"
          :key="i"
      class="ma-2"
      color="primary"
    >
      {{item}}
    </v-chip>
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
        <v-chip
        small
        @click="verDocumento(item)"
         v-for="(item, i) in evidencia6"
          :key="i"
      class="ma-2"
      color="primary"
    >
      {{item}}
    </v-chip>
         </v-col>   
                  
                </v-row>
                <v-row>
                 
        
        <v-col cols="12" md="6" style="cursor: pointer" @click="modalCarga()">
          <center>
             <hr>
          <h5 class="text-center"><strong>CARGA DE DOCUMENTOS</strong></h5>
          <img :src="'img/carga.png'" width="50%">
          </center>
          
        </v-col>
         <v-col cols="12" md="6">
                    <center>
                       <hr>
          <h5 class="text-center"><strong>DESCARGA DE DOCUMENTOS</strong></h5>
          <img :src="'img/documento2.png'" width="50%" style="cursor: pointer">
                    </center>
          
        </v-col>
                </v-row>

                <v-dialog
                  v-model="dialog"
        transition="dialog-bottom-transition"
        max-width="600"
      >
       
      
          <v-card>
            <v-toolbar
              color="primary"
              dark
            >CARGA TU SOPORTE DOCUMENTAL AQUÍ</v-toolbar>
            <v-card-text>
                <v-row>
                <!--  <h5 class="font-weight-black ml-4 mt-5"><strong>SELECCIONA UNA OPCIÓN</strong></h5> -->
               <!--  <v-col cols="12">
                  <hr>
                </v-col> -->
                <v-col cols="12">
                  <v-select
      v-model="categoria"
      :items="categorias"
      item-text="nombre"
      item-value="id"
      label="CATEGORÍA"
      data-vv-name="select"
      >
      </v-select>
      <hr>
      <v-file-input
    v-model="files"
    placeholder="DOCUMENTOS ADJUNTOS A LAS NOTAS"
    label="INGRESA TUS ARCHIVOS"
    multiple
    prepend-icon="mdi-paperclip"
  >
    <template v-slot:selection="{ text }">
      <v-chip
      small
        small
        label
        color="primary"
      >
        {{ text }}
      </v-chip>
    </template>
  </v-file-input>
  <hr>
   <v-btn
       
        block
        color="primary"
        @click="guardarDocumentos()"
        >
        GUARDAR SOPORTE DOCUMENTAL
        </v-btn>
                </v-col>
               </v-row>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                 @click="cerrarModalCarga()"
              >CERRAR</v-btn>
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
          categoria:null,
          categorias:[
          { id: 1, nombre: "DISPONIBLE PARA COMPRA"},
          { id: 2, nombre: "DISPONIBLE PARA FACTURA"},
          { id: 3, nombre: "COMPRADA"},
          { id: 4, nombre: "DISPONIBLE PARA ENTREGA"},
          { id: 5, nombre: "ENTREGADA"},
          { id: 6, nombre: "COBRADA"}
          ],
          files:[],
          dialog:false,
        cotizacion:[],
        disponiblecompra:false,
        disponiblefactura:false,
        comprada:false,
        disponibleentrega:false,
        entregada:false,
        cobrada:false,
        evidencia1:null,
        evidencia2:null,
        evidencia3:null,
        evidencia4:null,
        evidencia5:null,
        evidencia6:null,
         


          
         }),
         watch : {
          

         },
          methods:{
            verDocumento(imagen){
              let idCotizacion = this.$route.params.id
             
              // var url = process.env.MIX_ARCHIVOS_URL;
              var url = 'http://localhost/laravel/storage/app/cotizaciones/'+idCotizacion+'/soporteDocumental/'
              window.open(url+imagen,'popup','width=600,height=600')
              // falta poner la ruta real

            },
            async cerrarModalCarga(){
              this.dialog = false
              this.categoria = null
              this.files.splice(0)
            },
            async guardarDocumentos(){
              try {
                     let formData = new FormData()
                      formData.append( 'id' , parseInt(this.$route.params.id))
                      formData.append( 'categoria' , parseInt(this.categoria))
                      if(this.files.length != 0){
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            formData.append('archivo['+i+']',file)
                        }
                      }

                    const response = await axios({
                      method: 'post',
                      url: 'guardarDocumentos',
                      data:formData
                    })
                this.dialog = false
              this.categoria = null
              this.files.splice(0)

              this.cotizacion = response.data.response

                 if (this.cotizacion != null) {
                  this.disponiblecompra = this.cotizacion.disponiblecompra
                 this.disponiblefactura = this.cotizacion.disponiblefactura
                 this.comprada = this.cotizacion.comprada
                 this.disponibleentrega = this.cotizacion.disponibleentrega
                 this.entregada = this.cotizacion.entregada
                 this.cobrada = this.cotizacion.cobrada
                 }
                
                this.evidencia1 =  (this.cotizacion.disponiblecompraEvidencia != null)? this.cotizacion.disponiblecompraEvidencia.split(",") : null; 
                this.evidencia2 =  (this.cotizacion.disponiblefacturaEvidencia != null)? this.cotizacion.disponiblefacturaEvidencia.split(",") : null;
                this.evidencia3 =  (this.cotizacion.compradaEvidencia != null)? this.cotizacion.compradaEvidencia.split(",") : null;
                this.evidencia4 =  (this.cotizacion.disponibleentregaEvidencia != null)? this.cotizacion.disponibleentregaEvidencia.split(",") : null;
                this.evidencia5 =  (this.cotizacion.entregadaEvidencia != null)? this.cotizacion.entregadaEvidencia.split(",") : null;
                this.evidencia6 =  (this.cotizacion.cobradaEvidencia != null)? this.cotizacion.cobradaEvidencia.split(",") : null;

                 swal("ÉXITO", "SE HA ACTUALIZADO EL SOPORTE DOCUMENTAL", "success");
                

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async modalCarga(){
              this.dialog = true

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

                 if (this.cotizacion != null) {
                  this.disponiblecompra = this.cotizacion.disponiblecompra
                 this.disponiblefactura = this.cotizacion.disponiblefactura
                 this.comprada = this.cotizacion.comprada
                 this.disponibleentrega = this.cotizacion.disponibleentrega
                 this.entregada = this.cotizacion.entregada
                 this.cobrada = this.cotizacion.cobrada
                 this.evidencia1 =  (this.cotizacion.disponiblecompraEvidencia != null)? this.cotizacion.disponiblecompraEvidencia.split(",") : null; 
                this.evidencia2 =  (this.cotizacion.disponiblefacturaEvidencia != null)? this.cotizacion.disponiblefacturaEvidencia.split(",") : null;
                this.evidencia3 =  (this.cotizacion.compradaEvidencia != null)? this.cotizacion.compradaEvidencia.split(",") : null;
                this.evidencia4 =  (this.cotizacion.disponibleentregaEvidencia != null)? this.cotizacion.disponibleentregaEvidencia.split(",") : null;
                this.evidencia5 =  (this.cotizacion.entregadaEvidencia != null)? this.cotizacion.entregadaEvidencia.split(",") : null;
                this.evidencia6 =  (this.cotizacion.cobradaEvidencia != null)? this.cotizacion.cobradaEvidencia.split(",") : null;
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
