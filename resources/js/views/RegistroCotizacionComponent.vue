<template>
    <v-container fluid>

      <div>


    <v-expansion-panels
      v-model="panel"
      :disabled="disablednew"
      multiple
    >
      <v-expansion-panel>
        <v-expansion-panel-header>Acciones disponibles para esta cotización</v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-card
            class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
            width="100%"
            align="center"
            justify="space-around"
          >

          <v-card-title>
            Acciones disponibles para esta cotización
          </v-card-title>
          <v-row>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          :loading="loading3"
          :disabled="loading3"
          color="blue-grey"
          class="ma-2 white--text"
          @click="loader = 'loading3'"
        >
          Disponible Para Compra
          <v-icon

            dark
          >
            mdi-checkbox-marked-outline
          </v-icon>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          :loading="loading3"
          :disabled="loading3"
          color="blue-grey"
          class="ma-2 white--text"
          @click="loader = 'loading3'"
        >
          Disponible Para Facturar
          <v-icon

            dark
          >
            mdi-checkbox-marked-outline
          </v-icon>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          :loading="loading3"
          :disabled="loading3"
          color="blue-grey"
          class="ma-2 white--text"
          @click="loader = 'loading3'"
        >
          Comprada
          <v-icon

            dark

          >
            mdi-checkbox-marked-outline
          </v-icon>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          :loading="loading3"
          :disabled="loading3"
          color="blue-grey"
          class="ma-2 white--text"
          @click="loader = 'loading3'"
        >
          Disponible para Entrega
          <v-icon

            dark

          >
            mdi-checkbox-marked-outline
          </v-icon>
        </v-btn>
         </v-col>

         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          :loading="loading3"
          :disabled="loading3"
          color="blue-grey"
          class="ma-2 white--text"
          @click="loader = 'loading3'"
        >
          Entregada
          <v-icon

            dark

          >
            mdi-checkbox-marked-outline
          </v-icon>
        </v-btn>
         </v-col>
         <v-col
           cols="12"
           sm="12"
           md="4"
         >
         <v-btn
         block
          :loading="loading3"
          :disabled="loading3"
          color="blue-grey"
          class="ma-2 white--text"
          @click="loader = 'loading3'"
        >
          Cobrada
          <v-icon

            dark

          >
            mdi-checkbox-marked-outline
          </v-icon>
        </v-btn>
         </v-col>

       </v-row>
        </v-card>
        </v-expansion-panel-content>
      </v-expansion-panel>

      <v-expansion-panel>
        <v-expansion-panel-header>Datos de la Cotización</v-expansion-panel-header>
        <v-expansion-panel-content>
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
          <v-toolbar-title>
            <v-btn
                  color="primary"
                  dark
                  @click="iniciar"
                  v-if="btniniciar"
                >
                  Iniciar Cotización
                </v-btn>
                <v-btn
                      color="warning"
                      dark
                      v-if="!btniniciar"
                    >
                    Cotización en Proceso
                    </v-btn>
          </v-toolbar-title>
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
           Registro de Partida
           <v-icon>mdi-file-document</v-icon>
         </v-tab>

         <v-tab href="#tab-4">
           Partidas Registradas
           <v-icon>mdi-clipboard-text</v-icon>
         </v-tab>

         <!-- <v-tab href="#tab-5">
          Generar Oficio
           <v-icon>mdi-auto-fix</v-icon>
         </v-tab> -->
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
                         outlined
                         dense
                           v-model="partida"
                           type="number"
                           label="Número de Partida sugerida  "
                           :disabled="esMejorada"
                         ></v-text-field>
                         <strong v-if="esMejorada">Mejora de Partida</strong>
                         <strong v-if="esEdicion">Edición de Partida</strong>
                          <strong v-if="esMejorada == false && esEdicion == false">Registro Normal</strong>
                          <v-switch
          v-model="switch5"
          inset
          label="¿Aplica Políticas de Garantía?"
        ></v-switch>
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
                                 outlined
                                 dense
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
                                     outlined
                                     dense
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
                                         outlined
                                         dense
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
                                                   outlined
                                                   dense
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
                                                       outlined
                                                       dense
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
                                                           outlined
                                                           dense
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
                                                             <v-file-input
        v-model="files"
        placeholder="Documentación soporte"
        label="Ingresa tus archivos"
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
                           outlined
                           dense
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
                           outlined
                           dense
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
                               outlined
                               dense
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

                           label="Importe(1)  "
                           outlined
               dense
               readonly

                         ></v-text-field>
                       </v-col>
                       <v-col
                               cols="12"

                               md="3"
                             >
                             <v-text-field
                               v-model="utilidadgenerada"

                               label="Utilidad  "
                               outlined
               dense
               readonly

                             ></v-text-field>
                           </v-col>
                           <v-col
                                   cols="12"

                                   md="3"
                                 >
                                 <v-text-field
                                   v-model="preciounitario"

                                   label="Precio Unitario  "
                                   outlined
               dense
               readonly

                                 ></v-text-field>
                               </v-col>
                               <v-col
                                       cols="12"

                                       md="3"
                                     >
                                     <v-text-field
                                       v-model="importe2"

                                       label="Importe(2)  "
                                       outlined
                                       dense
                                       readonly

                                     ></v-text-field>
                                   </v-col>
                                   <v-col
                                           cols="12"


                                         >
                                         <v-btn
                                         block
                                         color="primary"
                                         @click="guardarPartida"
                                         v-if="esEdicion == false && esMejorada == false"
                                         >
                                         Guardar Partida
                                         </v-btn>
                                         <v-btn
                                         block
                                         color="warning"
                                         @click="editarPartida"
                                         v-if="esEdicion"
                                         >
                                         Editar Partida
                                         </v-btn>
                                         <v-btn
                                         block
                                         color="warning"
                                         @click="mejorarPartida"
                                         v-if="esMejorada"
                                         >
                                         Mejorar Partida
                                         </v-btn>
                                       </v-col>
                 </v-row>


             </v-card-text>
           </v-card>
         </v-tab-item>

         <v-tab-item

           value="tab-4"
         >
           <v-card flat>
             <v-card-text>
                  <v-row>
                    <v-col
                            cols="12"
                            md="4"
                          >
                          <v-btn
                          block
         depressed
         color="primary"
       >
        SUBTOTAL:  {{subtotalCotizacion}}
       </v-btn>
                        </v-col>

                        <v-col
                                cols="12"
                                md="4"
                              >
                              <v-btn
                              block
         depressed
         color="primary"
       >
         IVA: {{ivaCotizacion}}
       </v-btn>
                            </v-col>

                            <v-col
                                    cols="12"
                                    md="4"
                                  >
                                  <v-btn
                                  block
         depressed
         color="primary"
       >
        IEPS:   {{iepsCotizacion}}
       </v-btn>
                                </v-col>
                                <v-col
                                        cols="12"

                                      >
                                      <v-btn
                                      block
             depressed
             color="primary"
           >
            TOTAL:   {{totalCotizacion}}
           </v-btn>
                                    </v-col>
                    <br>
                  </v-row>
               <v-row>


                 <v-col
                         cols="12"
                       >

                 <v-data-table
                 :headers="headers"
                 :items="partidas"
                 :search="search"
                 :single-select="singleSelect"
        item-key="id"
        show-select
        class="elevation-1"
                   :items-per-page="5"
                 >
                 <template v-slot:[`item.actions`]="{ item }">

                <v-tooltip bottom>
                      <template v-slot:activator="{ on, attrs }">
                          <v-btn class="mx-2" fab small width="32" height="30" v-bind="attrs" v-on="on" @click="cargarEdicion(item)">
                            <v-icon >mdi-pencil</v-icon>
                          </v-btn>
                      </template>
                      <span>Editar Partida</span>
                  </v-tooltip>
                  <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn class="mx-2" fab small width="32" height="30" v-bind="attrs" v-on="on" @click="cargarEdicionMejorada(item)">
                              <v-icon >mdi-checkbox-multiple-marked-circle-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>Mejorar Partida</span>
                    </v-tooltip>


          </template>
               </v-data-table>
               </v-col>


               </v-row>

             </v-card-text>
           </v-card>
         </v-tab-item>

         <!-- <v-tab-item

           value="tab-5"
         >
           <v-card flat>
             <v-card-text>

               <v-row>


                <v-col  cols="12" md="3">
                  <v-card
                      class="mx-auto"
                      max-width="344"
                    >
                      <v-img
                        src="https://banner2.cleanpng.com/20190423/hzg/kisspng-scalable-vector-graphics-computer-icons-computer-f-documents-files-and-folders-png-icons-and-graphics-5cbed2f5cceb05.4165270515560097178394.jpg"
                        height="150px"
                      ></v-img>

                      <v-card-title>
                        Oficio de Cotización
                      </v-card-title>



                      <v-card-actions>
                        <v-btn
                          color="orange lighten-2"
                          text
                        >
                          Generar Oficio
                        </v-btn>

                        <v-spacer></v-spacer>

                        <v-btn
                          icon
                          @click="show = !show"
                        >
                          <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
                      </v-card-actions>

                      <v-expand-transition>
                        <div v-show="show">
                          <v-divider></v-divider>

                          <v-card-text>

                          </v-card-text>
                        </div>
                      </v-expand-transition>
                    </v-card>
                </v-col>

                <v-col  cols="12" md="3">
                  <v-card
                      class="mx-auto"
                      max-width="344"
                    >
                      <v-img
                        src="https://banner2.cleanpng.com/20190423/hzg/kisspng-scalable-vector-graphics-computer-icons-computer-f-documents-files-and-folders-png-icons-and-graphics-5cbed2f5cceb05.4165270515560097178394.jpg"
                        height="150px"
                      ></v-img>

                      <v-card-title>
                        Segundo Oficio
                      </v-card-title>



                      <v-card-actions>
                        <v-btn
                          color="orange lighten-2"
                          text
                        >
                          Generar Oficio
                        </v-btn>

                        <v-spacer></v-spacer>

                        <v-btn
                          icon
                          @click="show = !show"
                        >
                          <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
                      </v-card-actions>

                      <v-expand-transition>
                        <div v-show="show">
                          <v-divider></v-divider>

                          <v-card-text>

                          </v-card-text>
                        </div>
                      </v-expand-transition>
                    </v-card>
                </v-col>

                <v-col  cols="12" md="3">
                  <v-card
                      class="mx-auto"
                      max-width="344"
                    >
                      <v-img
                        src="https://banner2.cleanpng.com/20190423/hzg/kisspng-scalable-vector-graphics-computer-icons-computer-f-documents-files-and-folders-png-icons-and-graphics-5cbed2f5cceb05.4165270515560097178394.jpg"
                        height="150px"
                      ></v-img>

                      <v-card-title>
                        Tercer Oficio
                      </v-card-title>



                      <v-card-actions>
                        <v-btn
                          color="orange lighten-2"
                          text
                        >
                          Generar Oficio
                        </v-btn>

                        <v-spacer></v-spacer>

                        <v-btn
                          icon
                          @click="show = !show"
                        >
                          <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
                      </v-card-actions>

                      <v-expand-transition>
                        <div v-show="show">
                          <v-divider></v-divider>

                          <v-card-text>

                          </v-card-text>
                        </div>
                      </v-expand-transition>
                    </v-card>
                </v-col>

                <v-col  cols="12" md="3">
                  <v-card
                      class="mx-auto"
                      max-width="344"
                    >
                      <v-img
                        src="https://banner2.cleanpng.com/20190423/hzg/kisspng-scalable-vector-graphics-computer-icons-computer-f-documents-files-and-folders-png-icons-and-graphics-5cbed2f5cceb05.4165270515560097178394.jpg"
                        height="150px"
                      ></v-img>

                      <v-card-title>
                        Cuarto Oficio
                      </v-card-title>



                      <v-card-actions>
                        <v-btn
                          color="orange lighten-2"
                          text
                        >
                          Generar Oficio
                        </v-btn>

                        <v-spacer></v-spacer>

                        <v-btn
                          icon
                          @click="show = !show"
                        >
                          <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
                      </v-card-actions>

                      <v-expand-transition>
                        <div v-show="show">
                          <v-divider></v-divider>

                          <v-card-text>

                          </v-card-text>
                        </div>
                      </v-expand-transition>
                    </v-card>
                </v-col>
              </v-row>

             </v-card-text>
           </v-card>
         </v-tab-item> -->



       </v-tabs-items>
     </v-card>


      </v-card>
        </v-expansion-panel-content>
      </v-expansion-panel>

      <v-expansion-panel>
        <v-expansion-panel-header>Opción extra</v-expansion-panel-header>
        <v-expansion-panel-content>
          Espacio Extra
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>




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
          this.ivaGlobal = 16
          this.iepsGlobal = 0
        },
        data: () => ({
          panel: [0, 1],
     disablednew: false,
     readonlynew: false,
          oivapartida:null,
          oiepspartida:null,
          tipoventapartida:null,
          esMejorada:false,
          esEdicion:false,
            switchVariables:false,
            switch1:false,
            switch5:false,
            files:[],
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
            btniniciar:false,
            show:false,
            headers: [
              {
                text: 'No de Partida',
                align: 'center',
                value: 'partida',
              },
              { text: 'Descripción', align: 'center', value: 'descripcion' },
                { text: 'Unidad de Medida', align: 'center', value: 'unidadmedida' },
              { text: 'Cantidad', align: 'center', value: 'cantidad' },
              { text: 'Precio Proveedor', align: 'center', value: 'precioproveedor' },
              { text: 'Marca', align: 'center', value: 'marca' },
              { text: 'Modelo', align: 'center', value: 'modelo' },
              { text: 'Número de Serie', align: 'center', value: 'numserie' },

              { text: 'Tipo de Venta', align: 'center', value: 'utilidadpartida' },
              { text: 'Importe(1)', align: 'center', value: 'importe1' },
              { text: 'Utilidad', align: 'center', value: 'utilidadgenerada' },
              { text: 'Precio Unitario', align: 'center', value: 'preciounitario' },
              { text: 'Importe(2)', align: 'center', value: 'importe2' },

              { text: 'Acciones', align: 'center', value: 'actions' },
            ],
            partidas: [],
            search:"",

            idEditar:null,
            singleSelect: false,
       selected: [],
       ivaCotizacion:0,
       iepsCotizacion:0,
       subtotalCotizacion:0,
       totalCotizacion:0,



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

             }
           },

           precioproveedor :function(newVal,oldVal){
            this.utilidadgenerada = 0
            this.utilidadgenerada = parseFloat(this.utilidadpartida/100)*parseFloat(this.precioproveedor)
            this.utilidadgenerada = this.utilidadgenerada.toFixed(2)

            this.importe1 = 0
            this.importe1 = parseFloat(this.precioproveedor) * parseFloat(this.cantidad)
            this.importe1 = this.importe1.toFixed(2)

            this.preciounitario = 0
            this.preciounitario = parseFloat(this.precioproveedor) + parseFloat(this.utilidadgenerada)
            this.preciounitario = this.preciounitario.toFixed(2)

           },

           cantidad :function(newVal,oldVal){
             this.importe1 = 0
             this.importe1 = parseFloat(this.precioproveedor) * parseFloat(this.cantidad)
             this.importe1 = this.importe1.toFixed(2)

             this.importe2 = 0
             this.importe2 = parseFloat(this.cantidad) * parseFloat(this.preciounitario)
             this.importe2 = this.importe2.toFixed(2)
           },


           utilidadpartida :function(newVal,oldVal){
            this.utilidadgenerada = 0
            this.utilidadgenerada = parseFloat(this.utilidadpartida/100)*parseFloat(this.precioproveedor)
             this.utilidadgenerada = this.utilidadgenerada.toFixed(2)
           },

           utilidadgenerada :function(newVal,oldVal){
             this.preciounitario = 0
             this.preciounitario = parseFloat(this.precioproveedor) + parseFloat(this.utilidadgenerada)
             this.preciounitario = this.preciounitario.toFixed(2)
           },

           preciounitario :function(newVal,oldVal){
             this.importe2 = 0
             this.importe2 = parseFloat(this.cantidad) * parseFloat(this.preciounitario)
             this.importe2 = this.importe2.toFixed(2)
           },


         },
          methods:{
            cargarEdicion(item){
            this.tab='tab-3'

            this.partida = item.partida
            this.descripcion = item.descripcion
            this.unidadmedida = item.unidadmedida
            this.cantidad = item.cantidad
            this.precioproveedor = item.precioproveedor
            this.marca = item.marca
            this.modelo = item.modelo
            this.numserie = item.numserie
            this.notasproducto = item.notasproducto
            this.ivapartida = item.ivapartida
            this.iepspartida = item.iepspartida
            this.utilidadpartida = item.utilidadpartida
            this.idEditar = item.id

            this.esEdicion = true
            this.esMejorada = false


            },
            cargarEdicionMejorada(item){

              this.tab='tab-3'

              this.partida = item.partida
              this.descripcion = item.descripcion
              this.unidadmedida = item.unidadmedida
              this.cantidad = item.cantidad
              this.precioproveedor = item.precioproveedor
              this.marca = item.marca
              this.modelo = item.modelo
              this.numserie = item.numserie
              this.notasproducto = item.notasproducto
              this.ivapartida = item.ivapartida
              this.iepspartida = item.iepspartida
              this.utilidadpartida = item.utilidadpartida
              this.idEditar = item.id

              this.esEdicion = false
              this.esMejorada = true


            },
            async guardarPartida(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'savePartida',
                      data:{
                        idCotizacion:parseFloat(this.$route.params.id),
                        partida:parseFloat(this.partida),
                        descripcion:this.descripcion,
                        unidadmedida:this.unidadmedida,
                        cantidad:parseFloat(this.cantidad),
                        precioproveedor:parseFloat(this.precioproveedor),
                        marca:this.marca,
                        modelo:this.modelo,
                        numserie:this.numserie,
                        notasproducto:this.notasproducto,

                        ivapartida:parseFloat(this.ivapartida),
                        utilidadpartida:parseFloat(this.utilidadpartida),
                        iepspartida:parseFloat(this.iepspartida),

                        importe1:parseFloat(this.importe1),
                        utilidadgenerada:parseFloat(this.utilidadgenerada),
                        preciounitario:parseFloat(this.preciounitario),
                        importe2:parseFloat(this.importe2),
                      }
                    })
                    console.log(response)
                  this.esEdicion = false
                  this.esMejorada = false
                    this.ivaCotizacion = response.data.cotizacion.ivaTotal
                    this.iepsCotizacion = response.data.cotizacion.iepsTotal
                    this.subtotalCotizacion = response.data.cotizacion.subtotal
                    this.totalCotizacion = response.data.cotizacion.total
                      this.partidas = response.data.response

                    swal("Éxito", "La partida #"+this.partida+" se registró con éxito", "success");
                    this.partida = parseFloat(this.partida)+1

                    this.descripcion = null
                    this.unidadmedida = null
                    this.cantidad = 0
                    this.precioproveedor = 0
                    this.marca = null
                    this.modelo = null
                    this.numserie = null
                    this.notasproducto = null

                    this.ivapartida = this.ivaGlobal
                      this.utilidadpartida = this.tipoventapartida
                    this.iepspartida = this.iepsGlobal

                    this.importe1 = 0
                    this.utilidadgenerada = 0
                    this.preciounitario = 0
                    this.importe2 = 0

                    this.ivapartida = this.oivapartida
                    this.iepspartida = this.oiepspartida

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }

            },

            async editarPartida(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'editarPartida',
                      data:{
                        idCotizacion:parseFloat(this.$route.params.id),
                        idPartida:this.idEditar,
                        partida:parseFloat(this.partida),
                        descripcion:this.descripcion,
                        unidadmedida:this.unidadmedida,
                        cantidad:parseFloat(this.cantidad),
                        precioproveedor:parseFloat(this.precioproveedor),
                        marca:this.marca,
                        modelo:this.modelo,
                        numserie:this.numserie,
                        notasproducto:this.notasproducto,

                        ivapartida:parseFloat(this.ivapartida),
                        utilidadpartida:parseFloat(this.utilidadpartida),
                        iepspartida:parseFloat(this.iepspartida),

                        importe1:parseFloat(this.importe1),
                        utilidadgenerada:parseFloat(this.utilidadgenerada),
                        preciounitario:parseFloat(this.preciounitario),
                        importe2:parseFloat(this.importe2),
                      }
                    })
                    this.esEdicion = false
                    this.esMejorada = false

                      this.partidas = response.data.response
                      this.idEditar = null

                      console.log("aqui",response.data.cotizacion)
                      this.ivaCotizacion = response.data.cotizacion.ivaTotal
                      this.iepsCotizacion = response.data.cotizacion.iepsTotal
                      this.subtotalCotizacion = response.data.cotizacion.subtotal
                      this.totalCotizacion = response.data.cotizacion.total

                    swal("Éxito", "La partida #"+this.partida+" se actualizó con éxito", "success");
                    this.partida = parseFloat(this.partida)+1

                    this.descripcion = null
                    this.unidadmedida = null
                    this.cantidad = 0
                    this.precioproveedor = 0
                    this.marca = null
                    this.modelo = null
                    this.numserie = null
                    this.notasproducto = null

                    this.ivapartida = this.ivaGlobal
                      this.utilidadpartida = this.tipoventapartida
                    this.iepspartida = this.iepsGlobal

                    this.importe1 = 0
                    this.utilidadgenerada = 0
                    this.preciounitario = 0
                    this.importe2 = 0

                    this.ivapartida = this.oivapartida
                    this.iepspartida = this.oiepspartida

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }

            },
            async iniciar(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'iniciarCotizacion',
                      data:{
                        id:this.$route.params.id,
                      }
                    })
                    console.log(response.data.response.estatus)
                    if ( parseFloat(response.data.response.estatus) != 0) {
                        this.btniniciar = false
                    }

                  swal("Éxito", "Ha iniciado la cotización de manera correcta", "success");

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
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
                    this.partidas = response.data.response.partidas
                    console.log(response.data.response)

                    this.oivapartida = response.data.response.ivaGlobal
                    this.oiepspartida = response.data.response.iepsGlobal

                    this.ivapartida = this.oivapartida
                    this.iepspartida = this.oiepspartida

                    this.partida = parseFloat(this.partidas.length)+1

                    this.cotizacion = response.data.response

                    if (parseFloat(this.cotizacion.estatus) == 0) {
                        this.btniniciar = true
                    }

                      this.solicitud = this.cotizacion.solicitud
                    this.cliente = this.cotizacion.solicitud.cliente
                      this.solicitante = this.cotizacion.solicitud.solicitante
                        this.agente = this.cotizacion.solicitud.agente
                          this.responsable = this.cotizacion.solicitud.responsable

                          this.ivaGlobal = parseFloat(this.cotizacion.ivaGlobal)
                          this.iepsGlobal = parseFloat(this.cotizacion.iepsGlobal)
                          this.iepspartida = this.iepsGlobal

                          if (this.cotizacion.utilidadGlobal != null) {
                              this.utilidadGlobal = parseFloat(this.cotizacion.utilidadGlobal)
                          }
                          if(this.cotizacion.utilidad != null){
                            if (this.cotizacion.utilidad.porcentaje != null) {
                              this.tipoventapartida = this.cotizacion.utilidad.porcentaje
                              this.utilidadpartida = this.tipoventapartida
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
                  this.tipoventapartida = parseInt(response.data.cotizacion.utilidad.porcentaje)
                  this.oivapartida = parseInt(response.data.cotizacion.ivaGlobal)
                  this.oiepspartida = parseInt(response.data.cotizacion.iepsGlobal)
                  this.ivapartida = this.oivapartida
                  this.iepspartida = this.oiepspartida
                  this.utilidadpartida = this.tipoventapartida

                   swal("Éxito", "Se ha configuradado esta cotización", "success");




              } catch (error) {
                 swal("Error", "Ha ocurrido un error en el servidor", "warning");

                  console.log(error);

              }
            },


          },

    }
</script>
