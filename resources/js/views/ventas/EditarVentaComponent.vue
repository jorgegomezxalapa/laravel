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
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">DISPONIBLE PARA COMPRA</p>

                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="disponiblecompra"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!disponiblecompra" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
               
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">COMPRA REALIZADA</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="comprada"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!comprada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">DISPONIBLE PARA ENTREGA</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="disponibleentrega"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!disponibleentrega" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">ENTREGA REALIZADA</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="entregada"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!entregada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">DISPONIBLE PARA FACTURA</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="disponiblefactura"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!disponiblefactura" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">FACTURA REALIZADA</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="facturada"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!facturada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">COBRADA</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="cobrada"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small v-if="!cobrada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="3"
      >
        <v-card
        class="mx-auto"
        outlined
        >
          <v-container fill-height>
            <v-row justify="center" align="center">
                <v-col cols="12" md="7">
                  <p class="font-weight-black">COBRADA SIN FACTURAR</p>
                  
                </v-col>
                <v-col cols="12" md="5" class="float-left">
                  
                    <v-switch
      v-model="cobradasf"
      inset
      color="success"
      class="float-left"
    ></v-switch>
    <small  v-if="!cobradasf" class="float-left red--text"><strong>DESACTIVADO</strong></small>
    <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
                 
                </v-col>
                <v-col cols="12"  class="pl-1 pr-1 mt-1 mb-1">
                  
                   <v-btn
      
        color="primary"
        dark
        block
      >
        CARGAR DOCUMENTO(S)
        <v-icon right dark>
          mdi-cloud-upload
        </v-icon>
      </v-btn>
                 
                </v-col>
            </v-row>
          </v-container>
        </v-card>
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

      <v-dialog
                  v-model="dialog2"
        transition="dialog-bottom-transition"
        max-width="600"
      >
       
      
          <v-card>
            <v-toolbar
              color="primary"
              dark
            >DESCARGA TU SOPORTE DOCUMENTAL AQUÍ</v-toolbar>
            <v-card-text>
                <v-row>
               
                <v-col cols="12">
                  <v-select
      v-model="razon"
      :items="razones"
      item-text="nombre"
      item-value="id"
      label="SELECCIONA UNA RAZÓN SOCIAL"
      data-vv-name="select"
      @click="getRazones()"
      >
      </v-select>
      <hr>
      <v-select
      v-model="formato"
      :items="formatos"
      item-text="nombre"
      item-value="id"
      label="SELECCIONA UN TIPO DE FORMATO"
      data-vv-name="select"
      @click="getFormatos()"
      >
      </v-select>
      <hr>
      <v-select
      v-model="documento"
      :items="documentos"
      item-text="nombre"
      item-value="documento"
      label="SELECCIONA UNA PLANTILLA DEL DOCUMENTO"
      data-vv-name="select"
      @click="getDocumentos()"
      @change="descargarDocumento()"
      >
      </v-select>
  <hr>
  
        <v-btn
        v-if="!url != null"
       
        block
        color="primary"
        :href="url"
        target="_blank"
        >
        DESCARGAR DOCUMENTO WORD
        </v-btn>
                </v-col>
               </v-row>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                 @click="cerrarModalCarga2()"
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
          dialog2:false,
          cotizacion:[],
           disponiblecompra:false,
           comprada:false,
           disponibleentrega:false,
           entregada:false,
           disponiblefactura:false,
           facturada:false,
           cobrada:false,
           cobradasf:false,
         


          
         }),
         watch : {
          

         },
          methods:{
            async turnarVenta(){

                const response = await axios({
                  method: 'post',
                  url: 'turnarVenta',
                  data:{
                    idCotizacion:parseInt(this.$route.params.id),
                  }
                })
                if (parseInt(response.data.response) == 1) {
                   swal("LA COTIZACIÓN FUÉ TURNADA A VENTAS", "", "success");
                }else{
                   swal("LA COTIZACIÓN YA SE ENCUENTRA EN VENTAS", "", "warning");
                }

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
            async getFormatos(){

              this.documentos = []
              this.url = null
              try {
                const response = await axios({
                  method: 'get',
                  url: 'getFormato',
                })

                this.formatos = response.data.response
                


            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "Por favor recarga la página", "error");
                console.log(error);

            }

            },
            async getDocumentos(){
              try {
                const response = await axios({
                  method: 'post',
                  url: 'getDocumentosF',
                  data:{
                    idCotizacion:parseInt(this.$route.params.id),
                    id_razonsocial:parseInt(this.razon),
                    id_formato:parseInt(this.formato),
                  }
                })

                this.documentos = response.data.response
                


            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "Por favor recarga la página", "error");
                console.log(error);

            }

            },
            async descargarDocumento(){
              try {
                  let carpeta = "descargarDocumento"
                  let Valcotizacion = parseInt(this.$route.params.id)
                  let Valrs = parseInt(this.razon)
                  let Valtipo = parseInt(this.formato)
                  let Valdocumento = this.documento
                  this.url = carpeta+"/"+Valcotizacion+"/"+Valrs+"/"+Valtipo+"/"+Valdocumento


            } catch (error) {

               

            }

            },
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
            async cerrarModalCarga2(){
              this.razones = []
              this.razon = null
              this.formatos = []
              this.formato = null
              this.documentos = []
              this.documento = null
              this.url = null
              this.dialog2 = false
             
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
            async modalDescarga(){
              this.dialog2 = true

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
                 this.finalizar = this.cotizacion.finalizada
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
