<template>
  <v-container fluid>
    <v-row>
      <h5 class="font-weight-black ml-4 mt-5"><strong>ACCIONES DISPONIBLES PARA ESTA VENTA</strong></h5>
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
              <v-chip
              v-if="disponiblecompra == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('disponiblecompra', 1)"
              v-model="disponiblecompra"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!disponiblecompra" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.disponiblecompraEvidencia != null">
              <v-chip
              v-if="disponiblecompra == 1"
              v-for="(item, i) in venta.disponiblecompraEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('disponiblecompra',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="comprada == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('comprada', 2)"
              v-model="comprada"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!comprada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.compradaEvidencia != null">
              <v-chip
              v-if="comprada == 1"
              v-for="(item, i) in venta.compradaEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('comprada',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="disponibleentrega == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('disponibleentrega', 3)"
              v-model="disponibleentrega"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!disponibleentrega" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.disponibleentregaEvidencia != null">
              <v-chip
              v-if="disponibleentrega == 1"
              v-for="(item, i) in venta.disponibleentregaEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('disponibleentrega',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="entregada == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('entregada', 4)"
              v-model="entregada"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!entregada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.entregadaEvidencia != null">
              <v-chip
              v-if="entregada == 1"
              v-for="(item, i) in venta.entregadaEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('entregada',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="disponiblefactura == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('disponiblefactura', 5)"
              v-model="disponiblefactura"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!disponiblefactura" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.disponiblefacturaEvidencia != null">
              <v-chip
              v-if="disponiblefactura == 1"
              v-for="(item, i) in venta.disponiblefacturaEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('disponiblefactura',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="facturada == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('facturada', 6)"
              v-model="facturada"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!facturada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.facturadaEvidencia != null">
              <v-chip
              v-if="facturada == 1"
              v-for="(item, i) in venta.facturadaEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('facturada',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="cobrada == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('cobrada', 7)"
              v-model="cobrada"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small v-if="!cobrada" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.cobradaEvidencia != null">
              <v-chip
              v-if="cobrada == 1"
              v-for="(item, i) in venta.cobradaEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('cobrada',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
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
              <v-chip
              v-if="cobradasf == 1"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
              >
                Añadir documentos
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
            <v-col cols="12" md="5" class="float-left">
              <v-switch
              @change="openModal('cobradasf', 8)"
              v-model="cobradasf"
              inset
              color="success"
              class="float-left"
              ></v-switch>
              <small  v-if="!cobradasf" class="float-left red--text"><strong>DESACTIVADO</strong></small>
              <small v-else class="float-left green--text"><strong>ACTIVADO</strong></small>
            </v-col>
            <v-col cols="12" v-if="venta.cobradasfEvidencia != null">
              <v-chip
              v-if="cobradasf == 1"
              v-for="(item, i) in venta.cobradasfEvidencia.split(',')"
              :key="i"
                class="ma-2"
                color="primary"
                outlined
                pill
                small
                @click="abrirDocto('cobradasf',item)"
              >
                {{item}}
                <v-icon right>
                  mdi-folder-plus
                </v-icon>
              </v-chip>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-col>
  </v-row>
  <v-dialog
  persistent
      v-model="dialog"
      width="500"
    >
     

      <v-card>
        <v-card-title class="headline grey lighten-2">
          MODIFICACIÓN DE ESTATUS
        </v-card-title>

        <v-card-text>
          <p><strong>Selecciona tus archivos de soporte documental para adjuntar a la modificación de estatus</strong></p>
          <v-file-input
          v-model="files"
            multiple
            dense
            label="SELECCIONA TUS ARCHIVOS"
          ></v-file-input>
          <v-btn block v-if = "parseInt(files.length) == 0" @click="updateValue()">
            MODIFICAR ESTATUS SIN SOPORTE
            <v-icon dark>
              mdi-image-broken
            </v-icon>
          </v-btn>
          <v-btn class="primary"  block v-else @click="updateValue()">
            MODIFICAR ESTATUS
            <v-icon dark>
              mdi-tooltip-edit
            </v-icon>
          </v-btn>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog = false, asignarValores()"
          >
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>
<script>
const axios = require('axios');
 
  import swal from 'sweetalert';


 
    export default {
        components: {
          
        },
        mounted() {
          this.aidi = this.$route.params.id
          this.getVenta()
        
        },
        data: () => ({
          dialog:false,
          venta:[],
          arreglo:[1,2,3],
          files:[],
          cotizacion:[],
          disponiblecompra:false,
          comprada:false,
          disponibleentrega:false,
          entregada:false,
          disponiblefactura:false,
          facturada:false,
          cobrada:false,
          cobradasf:false,
          enviarvalor:null,
          opcion:null,
          aidi:0,
         


          
         }),
         watch : {          

         },
          methods:{
            abrirDocto(carpeta,item){
              var url = 'storage/ventas/'+this.aidi+'/'+carpeta+'/'+item
              window.open(url,'popup','width=600,height=600')
            },
            asignarValores(){
              this.disponiblecompra = this.venta.disponiblecompra
              this.comprada = this.venta.comprada
              this.disponibleentrega = this.venta.disponibleentrega
              this.entregada = this.venta.entregada
              this.disponiblefactura = this.venta.disponiblefactura
              this.facturada = this.venta.facturada
              this.cobrada = this.venta.cobrada
              this.cobradasf = this.venta.cobradasf
              this.files = []
              return true;
            },
            async getVenta() {
              const response = await axios({
                  method: 'post',
                  url: 'getVenta',
                  data:{
                    id:parseInt(this.$route.params.id),
                  }
                })
              this.venta = response.data.response
              return this.asignarValores()
            },
            async openModal(valor, option) {
              this.enviarvalor = null
              this.opcion = null
              if (valor) {
                this.enviarvalor = valor
                this.opcion = option 
                this.dialog = true
                return true
              }else{
                this.enviarvalor = valor
                this.opcion = option
                swal("¿DESEA CAMBIAR EL ESTATUS ACTUAL? EL SOPORTE DOCUMENTAL TAMBIÉN SERÁ MODIFICADO ", {
                  buttons: {
                    cancel: "CANCELAR",
                    catch: {
                      text: "ACTUALIZAR",
                      value: "eliminar",
                    },

                  },
                   icon: "warning",
                  })
                  .then((value) => {
                  switch (value) {

                    case "eliminar":
                    this.deleteValue()
                      break;

                    default:
                    this.asignarValores()

                  }
                });
                  return true
              }
            },
            async deleteValue(){
              let formData = new FormData()
              formData.append( 'id' , parseInt(this.$route.params.id))
              formData.append( 'columna' , parseInt(this.opcion) )
              formData.append( 'valor' , (this.enviarvalor == true) ? 1 : 0 )
             
              const response = await axios({
                  method: 'post',
                  url: 'updateVenta',
                  data:formData
              })
             
              this.getVenta()
              
              swal("ACTUALIZADO CON ÉXITO", "", "success");

            },
            async updateValue(){
              let formData = new FormData()
              formData.append( 'id' , parseInt(this.$route.params.id))
              formData.append( 'columna' , parseInt(this.opcion) )
              formData.append( 'valor' , (this.enviarvalor == true) ? 1 : 0 )
              if(this.files.length != 0){
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            formData.append('archivo['+i+']',file)
                        }
                      }
              const response = await axios({
                  method: 'post',
                  url: 'updateVenta',
                  data:formData
              })
              this.dialog = false
              this.getVenta()
              this.asignarValores()
              swal("ACTUALIZADO CON ÉXITO", "", "success");
            },
            async uploadFile(valor, columna) {
              const response = await axios({
                  method: 'post',
                  url: 'getVenta',
                  data:{
                    id:parseInt(this.$route.params.id),
                  }
                })
              this.getVenta()
              return this.asignarValores()
            },
           
          },

    }
</script>