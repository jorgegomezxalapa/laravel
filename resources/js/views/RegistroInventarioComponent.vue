<template>
    <v-container>

      <v-card flat>
        <v-card-text>
<br>
            <p class="font-weight-black mb-3"  align="center">Llena el Formulario para registrar un nuevo producto</p>
            <p>El ingreso de los símbolos(Peso $ | Coma , | Porcentaje %) en campos numérico(EJ: Precio) no están permitidos</p>
            <br>
            <v-row>
              <v-col
                      cols="12"

                      md="4"
                    >
                    <v-select
            v-model="segmento"
            :items="segmentos"
            item-text="nombre"
            item-value="id"

            label="Seleccione un segmento"
            data-vv-name="select"

          >

          </v-select>


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
              <v-btn
              block
              color="primary"
              @click="guardarIventario"

              >
              Guardar Producto
              </v-btn>
            </v-row>




        </v-card-text>
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
          this.getSegmentos()

        },
        data: () => ({
          panel: [0, 1],
          segmentos:[],
          segmento:null,
     disablednew: false,
     readonlynew: false,
          oivapartida:16,
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

                   async getSegmentos () {
                     try {
                         const response = await axios({
                           method: 'get',
                           url: 'getSegmentos',

                         })

                      this.segmentos = response.data.response

                     } catch (error) {
                        swal("Error", "Ha ocurrido un error en el servidor", "warning");

                         console.log(error);

                     }

                   },


            async guardarIventario(){
              console.log(this.segmento)
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'registroinventario',
                      data:{
                        idEmpleado:parseInt(localStorage.getItem('idPerfil')),
                        idSegmento:this.segmento,
                        descripcion:this.descripcion,
                        unidaddemedida:this.unidadmedida,
                        cantidad:parseFloat(this.cantidad),
                        preciodelproveedor:parseFloat(this.precioproveedor),
                        marca:this.marca,
                        modelo:this.modelo,
                        numerodeserie:this.numserie,
                        politicasdegarantia:this.switch5,
                        notasdelproducto:this.notasproducto,
                        archivosdenotas:null,
                        miniatura:null,
                      }
                    })

                    swal("Éxito", "La partida se registró con éxito", "success");


                    this.descripcion = null
                    this.unidadmedida = null
                    this.cantidad = 0
                    this.precioproveedor = 0
                    this.marca = null
                    this.modelo = null
                    this.numserie = null
                    this.notasproducto = null
                    this.switch5 = false


                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }

            },




          },

    }
</script>
