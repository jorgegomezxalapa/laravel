<template>
    <v-container fluid>
      <v-row>
        <v-col
          cols="12"
          md="6"
          sm="12"
        >
        <v-checkbox v-model="iniciar" @change="iniciarCotizacion" :disabled="iniciar">
      <template v-slot:label>
        <div>
          ¿Iniciar el proceso de la cotización?
          
        </div>
      </template>
    </v-checkbox>
      </v-col>
       
      <v-col
          cols="12"
          md="6"
          sm="12"
        >
        <v-select
           
                     :items="catUtilidades"
          label="Seleccione un tipo de venta"
          v-model = "utilidadGlobal"
          item-text="descripcion" item-value="id"
            
          >
           <template slot="selection" slot-scope="data">
            {{data.item.descripcion}} (<strong>{{data.item.porcentaje}} %</strong>  )
           </template>
           
          </v-select>
      
      </v-col>
      <v-col
          cols="12"
          md="6"
          sm="12"
        >
       
      <v-text-field
                         v-model="ivaCotizacion"
                         type="number"
                         label="DETERMINE EL PORCENTAJE DE IVA(ESCALA 0 A 100 %)"
                         
                       ></v-text-field>
      </v-col>
       <v-col
          cols="12"
          md="6"
          sm="12"
        >
       <v-text-field
                         v-model="iepsCotizacion"
                         type="number"
                         label="DETERMINE EL PORCENTAJE DE IEPS(ESCALA 0 A 100 %)"
                        
                       ></v-text-field>
      
      </v-col>

      <v-col
          cols="12"
         
          sm="12"
          
        >
          <v-btn color="primary" block @click="guardarConfiguraciones()">
    GUARDAR CONFIGURACIÓN
  </v-btn>
      </v-col>
    </v-row>
      
     
    </v-container>
</template>


<script>
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
          this.getUtilidades()
         
        },
        data: () => ({
           cotizacion:[],
           iniciar:false,
           utilidadGlobal:null,
           ivaCotizacion:0,
           iepsCotizacion:0,
           catUtilidades:[],
          
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
                 if (parseInt(this.cotizacion.estatus) == 0) {
                  this.iniciar = false
                 }else{
                  this.iniciar = true
                 }
                 this.utilidadGlobal = parseInt(this.cotizacion.utilidadGlobal)
                 this.ivaCotizacion = parseInt(this.cotizacion.ivaGlobal)
                 this.iepsCotizacion = parseInt(this.cotizacion.iepsGlobal)
                

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async guardarConfiguraciones(){
             
               try {
                 this.setTipoVenta()
              this.setIva()
              this.setIeps()
              swal("ÉXITO", "LA CONFIGURACIÓN SE ASIGNÓ CON ÉXITO", "success");
               } catch(error) {

               }
            },

            async setTipoVenta(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'setTipoVenta',
                      data:{
                        id:this.$route.params.id,
                        utilidad:this.utilidadGlobal,
                      }
                    })
                    

                 

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

            async iniciarCotizacion(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'iniciarCotizacion',
                      data:{
                        id:this.$route.params.id,
                      }
                    })
                    
                    swal("ÉXITO", "EL ESTATUS DE LA COTIZACIÓN SE ACTUALIZÓ A INICIADA/EN PROCESO", "success");
                 

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async setIva(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'setIvaCotizacion',
                      data:{
                        id:this.$route.params.id,
                        iva:this.ivaCotizacion,
                      }
                    })
                    

                 

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            async setIeps(){
              try {
                    const response = await axios({
                      method: 'post',
                      url: 'setIepsCotizacion',
                      data:{
                        id:this.$route.params.id,
                        ieps:this.iepsCotizacion,
                      }
                    })
                    

                  swal("ÉXITO", "LA CONFIGURACIÓN SE ASIGNÓ CON ÉXITO", "success");

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

            async getUtilidades(){
              try {
                     const response = await axios({
                  method: 'get',
                  url: 'getUtilidades',
                })

                    this.catUtilidades = response.data.response



                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },
            
            
          },

    }
</script>
