<template>
    <v-container fluid>
       <v-row>
         <h5>Información de la solicitud</h5>
       </v-row>
      <v-row>
                  <v-col
                    cols="12"
                  >
                    <v-chip
      class="ma-2"
      color="secondary"
      v-if="disponiblecompra != 0"
      small
    >
      DISPONIBLE PARA COMPRA
    </v-chip>
    <v-chip
      class="ma-2"
      color="secondary"
       v-if="disponiblefactura != 0"
       small
    >
      DISPONIBLE PARA FACTURA
    </v-chip>
    <v-chip
      class="ma-2"
      color="secondary"
      small
      v-if="comprada != 0"
    >
      COMPRADA
    </v-chip>
    <v-chip
      class="ma-2"
      color="secondary"
       small
      v-if="disponibleentrega != 0"
    >
      DISPONIBLE PARA ENTREGA
    </v-chip>
    <v-chip
      class="ma-2"
      color="secondary"
       small
      v-if="entregada != 0"
    >
      ENTREGADA
    </v-chip>
    <v-chip
      class="ma-2"
      color="secondary"
       small
      v-if="cobrada != 0"
    >
      COBRADA
    </v-chip>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="ESTATUS"
                      filled
                      dense
                      readonly
                      light
                      v-model="estatus"

                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="TIPO DE SOLICITUD"
                      filled
                      dense
                      readonly
                      light
                      v-model="tipoSolicitud"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="FOLIO"
                      filled
                      dense
                      readonly
                      light
                      v-model="folio"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                     <v-text-field
                      label="FECHA DE SOLICITUD"
                      filled
                      dense
                      readonly
                      light
                      v-model="fechaSolicitud"
                    ></v-text-field>
                  </v-col>
                </v-row>
                 <v-row>
         <h5>Involucrados</h5>
       </v-row>

                <v-row>
                  <v-col
                    cols="12"
                    md="4"
                    sm="6"
                  >
                     <v-text-field
                      label="CLIENTE"
                      filled
                      dense
                      readonly
                      light
                      v-model="cliente"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="4"
                    sm="6"
                  >
                     <v-text-field
                      label="PERSONA QUE SOLICITA"
                      filled
                      dense
                      readonly
                      light
                      v-model="solicitante"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="4"
                    sm="6"
                  >
                     <v-text-field
                      label="AGENTE DE VENTAS"
                      filled
                      dense
                      readonly
                      light
                      v-model="agenteventas"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    md="12"
                    sm="12"
                  >
                     <v-text-field
                      label="RESPONSABLE"
                      filled
                      dense
                      readonly
                      v-model="responsable"
                    ></v-text-field>
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
          solicitud:[],
          cliente:[],
          datossolicitante:[],
          datosresponsable:[],
          datosagente:[],
          datoscliente:[],
          tipoSolicitud:null,
          folio:null,
          fechaSolicitud:null,
          cliente:null,
          solicitante:null,
          agenteventas:null,
          responsable:null,
          estatus:null,
          disponiblecompra:0,
          disponiblefactura:0,
          comprada:0,
          disponibleentrega:0,
          entregada:0,
          cobrada:0,


          
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
                 this.solicitud = this.cotizacion.solicitud
                this.datossolicitante = this.solicitud.solicitante
                this.datoscliente = this.solicitud.cliente   
                this.datosresponsable = this.solicitud.responsable
                  this.datosagente =  this.solicitud.agente
                 if (parseInt(this.cotizacion.estatus) == 0) {
                  this.estatus = 'SIN INICIAR'
                 }else if(parseInt(this.cotizacion.estatus) == 1){
                  this.estatus = 'EN PROCESO'
                 }else{
                  this.estatus = 'COTIZADA'
                 }
                 
                 if (parseInt(this.solicitud.urgente) == 0) {
                  this.tipoSolicitud = 'URGENTE'
                 }else{
                  this.tipoSolicitud = 'NORMAL'
                 }
                 this.folio = this.solicitud.folio
                 this.fechaSolicitud = moment(String(this.solicitud.fecha)).format('DD/MM/YYYY')
                 this.cliente = this.datoscliente.razonSocial
                 this.solicitante = this.datossolicitante.nombre
                 this.agenteventas = this.datosagente.name
                 this.responsable = this.datosresponsable.name



                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            
          },

    }
</script>
