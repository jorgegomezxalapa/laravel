<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >

      <v-toolbar
      flat
      color="secondary"
      dark
    >
      <v-toolbar-title>Detalle de la Cotización</v-toolbar-title>
    </v-toolbar>
    <v-card>
   <v-tabs
     v-model="tab"

     centered

     icons-and-text
   >
     <v-tabs-slider></v-tabs-slider>

     <v-tab href="#tab-a">
       Detalle de la solicitud
       <v-icon>mdi-import</v-icon>
     </v-tab>

     <v-tab href="#tab-2">
       Configuración de Parámetros
       <v-icon>mdi-settings-box</v-icon>
     </v-tab>

     <v-tab href="#tab-3">
       Registrar Partida
       <v-icon>mdi-file-document</v-icon>
     </v-tab>

     <v-tab href="#tab-4">
       Partidas Registradas
       <v-icon>mdi-clipboard-text</v-icon>
     </v-tab>

     <v-tab href="#tab-5">
       Acciones Disponibles
       <v-icon>mdi-auto-fix</v-icon>
     </v-tab>
   </v-tabs>

   <v-tabs-items v-model="tab">
     <v-tab-item

       value="tab-a"
     >
     <v-container>
       <v-row>

       <br>
       <v-col v-if ="this.solicitud.urgente == 1">
         <v-alert
       dense
       outlined
       type="error"
     >
      Solicitud marcada como urgente
     </v-alert>
       </v-col>


      </v-row>

       <v-row>

           <v-col
             cols="12"
             md="6"
           >
           <v-card
     class="mx-auto"

   >
     <v-card-text>
       <p class="font-weight-black">Folio de la Solicitud <br><br>{{this.solicitud.folio}} </p>
     </v-card-text>

   </v-card>


         </v-col>

         <v-col
           cols="12"
           md="6"
         >
         <v-card
             class="mx-auto"

           >
             <v-card-text>
               <p class="font-weight-black">Persona Solicitante <br><br>{{this.solicitante.nombre}} </p>
             </v-card-text>

           </v-card>


       </v-col>

       <v-col
         cols="12"

       >
       <v-card
           class="mx-auto"

         >
           <v-card-text>
             <p class="font-weight-black">Persona/Empresa a quien se dirige esta cotización<br><br>{{this.cliente.razonSocial}} </p>
           </v-card-text>

         </v-card>


     </v-col>

     <v-col
       cols="12"
       md="12"
     >
     <v-card
         class="mx-auto"

       >
         <v-card-text>
           <p class="font-weight-black">Comentarios: <br>{{this.solicitud.comentario}} </p>
         </v-card-text>

       </v-card>

   </v-col>


       </v-row>


     </v-container>
     </v-tab-item>

     <v-tab-item

       value="tab-2"
     >
       <v-card flat>
         <v-card-text>

           <v-row>
             <v-col
                     cols="12"

                   >
                   <p>Todos los porcentajes se definen en escala del 0 al 100 %, ingresando únicamente el valor numérico.</p>
                   <p>No está permitido el ingreso de símbolo de pesos($), símbolo de porcentaje($) y símbolo de coma (,).</p>
                 </v-col>

             <v-col
                     cols="12"

                     md="4"
                   >
                   <v-select
                   v-model="utilidadGlobal"
                   :items="utilidades"

                   item-text="descripcion"
                   item-value="id"
                   label="Tipo de Venta"

                   ></v-select>
                 </v-col>
             <v-col
                     cols="12"

                     md="4"
                   >
                   <v-text-field
                     v-model="ivaGlobal"
                     type="number"
                     label="PORCENTAJE DE IVA"

                   ></v-text-field>
                 </v-col>
                 <v-col
                         cols="12"

                         md="4"
                       >
                       <v-text-field
                         v-model="iepsGlobal"
                         type="number"
                         label="PORCENTAJE DE IEPS"

                       ></v-text-field>
                     </v-col>
                     <v-col
                             cols="12"

                           >
                           <v-btn
                           block
                           color="primary"
                           @click="guardarConfiguracion"
                           >
                           Guardar Configuración
                           </v-btn>
                         </v-col>


           </v-row>

         </v-card-text>
       </v-card>
     </v-tab-item>

     <v-tab-item

       value="tab-3"
     >
       <v-card flat>
         <v-card-text>
<br>
             <p class="font-weight-black mb-3"  align="center">Llena el Formulario para registrar una nueva Partida</p>
             <p>El ingreso de los símbolos(Peso $ | Coma , | Porcentaje %) en campos numérico(EJ: Precio) no están permitidos</p>
             <br>
             <v-row>
               <v-col
                       cols="12"

                       md="4"
                     >
                     <v-text-field
                       v-model="partida"
                       type="number"
                       label="Número de Partida sugerida  "

                     ></v-text-field>
                   </v-col>
                   <v-col
                           cols="12"

                           md="8"
                         >
                         <v-textarea
                         solo
                           v-model="descripcion"
                         label="Descripción"
                         :counter="65535"
                         ></v-textarea>
                       </v-col>

                       <v-col
                               cols="12"
                               sm="6"
                               md="4"
                             >
                             <v-text-field
                               v-model="unidadmedida"

                               label="Unidad de Medida  "

                             ></v-text-field>
                           </v-col>

                           <v-col
                                   cols="12"
                                   sm="6"
                                   md="4"
                                 >
                                 <v-text-field
                                   v-model="cantidad"
                                   type="number"
                                   label="Cantidad "

                                 ></v-text-field>
                               </v-col>

                               <v-col
                                       cols="12"
                                       sm="6"
                                       md="4"
                                     >
                                     <v-text-field
                                       v-model="precioproveedor"
                                       type="number"
                                       label="Precio del Proveedor "

                                     ></v-text-field>
                                     <v-switch
                   v-model="switch1"
                   label="¿Desea restar el valor del IVA al Precio del Proveedor?"
                      color="warning"
                 ></v-switch>
                                   </v-col>


                                       <v-col
                                               cols="12"
                                               md="4"
                                             >
                                             <v-text-field
                                               v-model="marca"
                                               type="text"
                                               label="Marca"

                                             ></v-text-field>

                                           </v-col>
                                           <v-col
                                                   cols="12"
                                                   md="4"
                                                 >
                                                 <v-text-field
                                                   v-model="modelo"
                                                   type="text"
                                                   label="Modelo"

                                                 ></v-text-field>

                                               </v-col>
                                               <v-col
                                                       cols="12"
                                                       md="4"
                                                     >
                                                     <v-text-field
                                                       v-model="numserie"
                                                       type="text"
                                                       label="Número de Serie"

                                                     ></v-text-field>

                                                   </v-col>
                                                   <v-col
                                                           cols="12"


                                                         >
                                                         <v-textarea
                                                         solo
                                                           v-model="notasproducto"
                                                         label="Notas para esta partida"
                                                         ></v-textarea>
                                                       </v-col>
             </v-row>
             <v-row>
                 <v-divider></v-divider>
             </v-row>
             <v-row>
               <v-switch
               v-model="switchVariables"
               label="¿Desea personalizar los parámetros de TIPO DE VENTA, IVA, IEPS?"
               color="warning"

               hide-details
             ></v-switch>
               <br>
             </v-row>
             <v-row v-show="switchVariables">
               <v-col
                       cols="12"

                       md="4"
                     >
                     <v-text-field
                       v-model="utilidadpartida"
                       type="number"
                       label="Tipo de Venta / Utilidad (En escala del 0 al 100 %)"

                     ></v-text-field>
                   </v-col>
               <v-col
                       cols="12"

                       md="4"
                     >
                     <v-text-field
                       v-model="ivapartida"
                       type="number"
                       label="PORCENTAJE DE IVA(En escala del 0 al 100 %) "

                     ></v-text-field>
                   </v-col>
                   <v-col
                           cols="12"

                           md="4"
                         >
                         <v-text-field
                           v-model="iepspartida"
                           type="number"
                           label="PORCENTAJE DE IEPS(En escala del 0 al 100 %) "

                         ></v-text-field>
                       </v-col>


             </v-row>
             <v-row>
                 <v-divider></v-divider>
             </v-row>
             <v-row>
               <p class="font-weight-black mb-3"  align="center">Cálculo automático a partir de los datos capturados</p>
               <br>
             </v-row>
             <v-row>
               <v-col
                       cols="12"

                       md="3"
                     >
                     <v-text-field
                       v-model="importe1"
                       type="number"
                       label="Importe(1)  "

                     ></v-text-field>
                   </v-col>
                   <v-col
                           cols="12"

                           md="3"
                         >
                         <v-text-field
                           v-model="utilidadgenerada"
                           type="number"
                           label="Utilidad  "

                         ></v-text-field>
                       </v-col>
                       <v-col
                               cols="12"

                               md="3"
                             >
                             <v-text-field
                               v-model="preciounitario"
                               type="number"
                               label="Precio Unitario  "

                             ></v-text-field>
                           </v-col>
                           <v-col
                                   cols="12"

                                   md="3"
                                 >
                                 <v-text-field
                                   v-model="importe2"
                                   type="number"
                                   label="Importe(2)  "

                                 ></v-text-field>
                               </v-col>
                               <v-col
                                       cols="12"


                                     >
                                     <v-btn
                                     block
                                     color="primary"
                                     @click="guardarPartida"
                                     >
                                     Guardar Partida
                                     </v-btn>
                                   </v-col>
             </v-row>


         </v-card-text>
       </v-card>
     </v-tab-item>


   </v-tabs-items>
 </v-card>


  </v-card>
    </v-container>
</template>


<script>
const axios = require('axios');
import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
import swal from 'sweetalert';
    export default {
        mounted() {
          this.getCotizacion()
          this.gettipoventas()
        },
        data: () => ({
          switchVariables:false,
          switch1:false,
          tab:null,
            utilidadGlobal:null,
            ivaGlobal:16,
            iepsGlobal:0,
            utilidades:[],
            cotizacion:[],
            cliente:[],
            solicitante:[],
            agente:[],
            responsable:[],
            solicitud:[],
            partida:1,
            descripcion:null,
            unidadmedida:null,
            cantidad:null,
            precioproveedor:null,
            notasproducto:null,
            utilidadpartida:null,
            iepspartida:0,
            ivapartida:16,
            importe1:null,
            utilidadgenerada:null,
            preciounitario:null,
            importe2:null,
            marca:null,
            modelo:null,
            numserie:null,
            restariva:null,




         }),
         watch : {
           switch1 :function (newVal, oldVal){

             if (this.precioproveedor != null && this.precioproveedor != "" && this.ivapartida != 0) {
               if (newVal) {
                 // resta
                    this.restariva = 0
                    this.restariva = parseFloat(this.precioproveedor) * parseFloat(parseFloat(this.ivapartida)/100)
                   this.precioproveedor = parseFloat(this.precioproveedor) - this.restariva
               }else{
                 //recuperar interval
                 this.precioproveedor = this.precioproveedor + this.restariva
               }
               alert(this.restariva)
             }
           }
         },
          methods:{
            async guardarPartida(){

            },
            async getCotizacion(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'getCotizacion',
                      data:{
                        id:this.$route.params.id,
                      }
                    })
                    console.log(response.data.response)

                    this.cotizacion = response.data.response

                      this.solicitud = this.cotizacion.solicitud
                    this.cliente = this.cotizacion.solicitud.cliente
                      this.solicitante = this.cotizacion.solicitud.solicitante
                        this.agente = this.cotizacion.solicitud.agente
                          this.responsable = this.cotizacion.solicitud.responsable

                          this.ivaGlobal = parseInt(this.cotizacion.ivaGlobal)
                          this.iepsGlobal = parseInt(this.cotizacion.iepsGlobal)
                          if (this.cotizacion.utilidadGlobal != null) {
                              this.utilidadGlobal = parseInt(this.cotizacion.utilidadGlobal)
                          }
                          if(this.cotizacion.utilidad != null){
                            if (this.cotizacion.utilidad.porcentaje != null) {
                              this.utilidadpartida = this.cotizacion.utilidad.porcentaje
                            }
                          }








                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async gettipoventas(){
              try {
                    const response = await axios({
                      method: 'get',
                      url: 'getUtilidades',

                    })

                    this.utilidades = response.data.response



                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async guardarConfiguracion () {
              try {
                  const response = await axios({
                    method: 'post',
                    url: 'saveConfigCotizacion',
                    data: {
                      id:this.$route.params.id,
                      utilidadGlobal : this.utilidadGlobal,
                      ivaGlobal:this.ivaGlobal,
                      iepsGlobal:this.iepsGlobal,
                    }
                  })
                if (response.data.utilidad.porcentaje != null) {
                  this.utilidadpartida = response.data.utilidad.porcentaje
                }
                   swal("Éxito", "Se ha configuradado esta cotización", "success");




              } catch (error) {
                 swal("Error", "Ha ocurrido un error en el servidor", "warning");

                  console.log(error);

              }
            },


          },

    }
</script>
