<template>
    <v-container fluid>
       <v-row>
     <v-col
        cols="12"
      >
         <v-tabs v-model="tab"
          align-with-title>
         <v-tab>NUEVA PARTIDA</v-tab>
         <v-tab @click="getPartidas">PARTIDAS REGISTRADAS <v-chip
        small
        label
        color="primary"
      >
        {{ totalpartidas }}
      </v-chip></v-tab>
       </v-tabs>
       <v-tabs-items v-model="tab">
         <v-tab-item
        >
        <!-- inicia partida -->
         <v-row class="pl-2 pr-2">
     <v-col
        cols="12"
      >
       <p class="font-weight-black mb-3"  align="center">FORMULARIO PARA CAPTURA DE PARTIDAS</p>
       <p align="center">PARA MARCAR COMO "NO COTIZA", DEJAR EL CAMPO EN LIMPIO, LOS VALORES PARTICIPANTES SON CANTIDAD, PRECIO DE PROVEEDOR.</p>
    </v-col>
     <v-col
        cols="12"
        md="6"
      >
       <v-switch 
          v-model="politicas"
          inset
          label="¿INCLUYE POLÍTICAS DE GARANTÍA?"
        ></v-switch>
    </v-col>
      <v-col
        cols="12"
        md="6"
      >
      <v-text-field
        v-model="partida"
        type="number"
        label="NÚMERO DE PARTIDA SUGERIDA"
      ></v-text-field>
       
    </v-col>
    
     <v-col
        cols="12"
      >
      <v-textarea
      solo
      v-model="descripcion"
      label="DESCRIPCIÓN"
      :counter="65535"
      ></v-textarea>
    </v-col>
    <v-col
        cols="12"
      >
      <v-select
      v-model="segmento"
      :items="segmentos"
      item-text="nombre"
      item-value="id"
      @click="getSegmentos()"
      label="SELECCIONE UN SEGMENTO"
      data-vv-name="select"
      >
      </v-select>
    </v-col>
     <v-col
        cols="12"
        md="4"
      >
       <v-text-field
        outlined
        dense
        v-model="unidaddemedida"
        label="UNIDAD DE MEDIDA"
        ></v-text-field>
    </v-col>
     <v-col
        cols="12"
        md="4"
      >
       <v-text-field
        outlined
        dense
        v-model="cantidad"
        type="number"
        label="CANTIDAD"
        ></v-text-field>
    </v-col>
    <v-col
        cols="12"
        md="4"
      >
       <v-text-field
        outlined
        dense
        v-model="preciodeproveedor"
        type="number"
        label="PRECIO DE PROVEEDOR"
        ></v-text-field>
        <v-switch
          v-model="restariva"
          label="¿DESEA RESTAR EL VALOR DEL IVA?"
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
        label="MARCA"
        outlined
        dense>
        </v-text-field>
    </v-col>
    <v-col
        cols="12"
        md="4"
      >
       <v-text-field
    v-model="modelo"
    type="text"
    label="MODELO"
    outlined
    dense
  ></v-text-field>
    </v-col>
    <v-col
        cols="12"
        md="4"
      >
       <v-text-field
        v-model="numerodeserie"
        type="text"
        label="NÚMERO DE SERIE"
        outlined
        dense
      ></v-text-field>
    </v-col>
    <v-col
        cols="12"
      >
       <v-textarea
      solo
      v-model="notasdelproducto"
      label="NOTAS PARA ESTA PARTIDA"
      ></v-textarea>
    </v-col>
    <v-col
        cols="12"
        
      >
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
        label
        color="primary"
      >
        {{ text }}
      </v-chip>
    </template>
  </v-file-input>
    </v-col>
    <v-col
        cols="12"
       
      >
       <v-switch
                   v-model="personalizarglobal"
                   label="¿PERSONALIZAR VALORES DE TIPO DE VENTA, IVA, IEPS PARA ESTA PARTIDA?"
                   color="warning"

                   hide-details
                 ></v-switch>
    </v-col>
    <v-col
    v-if="personalizarglobal"
        cols="12"
        md="4"
      >
       <v-text-field
          v-model="utilidadglobal"
          type="number"
          label="TIPO DE VENTA (0 A 100 %)"
          outlined
          dense
        ></v-text-field>
    </v-col>
    <v-col
    v-if="personalizarglobal"
        cols="12"
        md="4"
      >
       <v-text-field
        v-model="ivaglobal"
        type="number"
        label="IVA (0 A 100 %)"
        outlined
        dense
        ></v-text-field>
    </v-col>
    <v-col
    v-if="personalizarglobal"
        cols="12"
        md="4"
      >
       <v-text-field
        v-model="iepsglobal"
        type="number"
        label="IEPS (0 A 100 %)"
        outlined
        dense
      ></v-text-field>
    </v-col>
     <v-col
        cols="12"
      
      >
       <p class="font-weight-black mb-3"  align="center">DETALLE CALCULADO POR LA APLICACIÓN</p>
    </v-col>
     <v-col
        cols="12"
        md="3"
      >
       <v-text-field
        v-model="importe1"
        label="IMPORTE 1"
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
        label="UTILIDAD"
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
        label="PRECIO UNITARIO"
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
        label="IMPORTE 2"
        outlined
        dense
        readonly
      ></v-text-field>
    </v-col>
    <v-col
        cols="12"
        
      >
        <v-btn
        v-if="!esEdicion && !esMejorada"
        block
        color="primary"
        @click="guardarPartida()"
        >
        GUARDAR PARTIDA
        </v-btn>
        <v-btn
        v-if="esEdicion"
        block
        color="primary"
        @click="editarPartida()"
        >
        EDITAR PARTIDA
        </v-btn>
        <v-btn
        v-if="esMejorada"
        block
        color="primary"
        @click="mejorarPartida()"
        >
        MEJORAR PARTIDA
        </v-btn>
    </v-col>


  </v-row>
        <!-- termina partida -->
          
        </v-tab-item>
        <v-tab-item
        >
          <hr>
          <v-data-table
                 :headers="headers"
                 :items="partidas"
                 :search="search"
                 
        class="elevation-1"
                   :items-per-page="5"
                 >
                 <template v-slot:[`item.utilidadpartida`]="{ item }">

              {{item.utilidadpartida}} %


          </template>
          <template v-slot:[`item.notasproducto`]="{ item }">

              {{item.notasproducto}}
                <div v-if="item.producto.archivosdenotas != null">
                  
                  <v-chip small class="mb-1" v-for="(imagen, index) in item.producto.archivosdenotas.split(',')" 
                :key="index"
                @click="abrirpopup(item.idCotizacion,item.partida,imagen)"
                >{{
                    imagen
                }}</v-chip>
                </div>
             


          </template>
          <template v-slot:[`item.politicas`]="{ item }">

              <p v-if="item.politicas == 1"> SÍ INCLUYE</p>
              <p v-else>NO INCLUYE</p>


          </template>
          <template v-slot:[`item.partida`]="{ item }">

              <v-chip
      class="ma-2"
      color="secondary"
    >
      {{item.partida}}
    </v-chip>
    <div v-if="item.esMejora == 1" class="secondary darken-2 text-center">
    <span class="white--text">PARTIDA MEJORADA</span>
  </div>
    
   


          </template>
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
          <hr>
        </v-tab-item>
       </v-tabs-items>
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
          this.getPartidas()
          this.getSegmentos()
        
        
        },
        data: () => ({
          totalpartidas:null,
          esEdicion:false,
          esMejorada:false,
          tab:1,
          idPartida:null,
          idProducto:null,
          segmentos:[],
          politicas :false ,
          partida : 0,
          descripcion : null,
          segmento : null,
          unidaddemedida : null,
          cantidad : null,
          preciodeproveedor : null,
          restariva : false,
          restaiva:0,
          marca : null,
          modelo : null,
          numerodeserie : null,
          notasdelproducto : null,
          files : [],
          personalizarglobal : false,
          utilidadglobal : null,
          ivaglobal : null,
          iepsglobal : null,
          importe1 : null,
          utilidadgenerada : null,
          preciounitario : null,
          importe2 : null,
          search:"",
          partidas:[],
          cotizacion:[],
          headers: [
              {
                text: '# PARTIDA',
                align: 'center',
                value: 'partida',
              },
             
              { text: 'SEGMENTO', align: 'center', value: 'producto.segmento.nombre' },
              { text: 'POLÍTICAS', align: 'center', value: 'politicas' },
              { text: 'DESCRIPCIÓN', align: 'center', value: 'descripcion' },
              { text: 'COMENTARIOS', align: 'center', value: 'notasproducto' },
                { text: 'UNIDAD DE MEDIDA', align: 'center', value: 'unidadmedida' },
                { text: 'ALMACÉN', align: 'center', value: 'disponible' },
              { text: 'CANTIDAD SOLICITADA', align: 'center', value: 'cantidad' },

              { text: 'PRECIO DE PROVEEDOR', align: 'center', value: 'precioproveedor' },
              { text: 'MARCA', align: 'center', value: 'marca' },
              { text: 'MODELO', align: 'center', value: 'modelo' },
              { text: 'NÚMERO DE SERIE', align: 'center', value: 'numserie' },

              { text: 'TIPO DE VENTA', align: 'center', value: 'utilidadpartida' },
              { text: 'IIMPORTE 1', align: 'center', value: 'importe1' },
              { text: 'UTILIDAD', align: 'center', value: 'utilidadgenerada' },
              { text: 'PRECIO UNITARIO', align: 'center', value: 'preciounitario' },
              { text: 'IMPORTE 2', align: 'center', value: 'importe2' },

              { text: 'ACCIONES', align: 'center', value: 'actions' },
            ],
         }),
         watch : {
          restariva :function (newVal, oldVal){

             if (this.preciodeproveedor != null && this.preciodeproveedor != "") {
               if (newVal) {
                 // resta
                    this.restaiva = 0
                    this.restaiva = parseFloat(this.preciodeproveedor) * parseFloat(parseFloat(this.ivaglobal)/100)
                   this.preciodeproveedor = parseFloat(this.preciodeproveedor) - this.restaiva
               }else{
                 //recuperar interval
                 this.preciodeproveedor = this.preciodeproveedor + this.restaiva
               }

             }
           },

           preciodeproveedor :function(newVal,oldVal){
            this.utilidadgenerada = 0
            this.utilidadgenerada = parseFloat(this.utilidadglobal/100)*parseFloat(this.preciodeproveedor)
            this.utilidadgenerada = this.utilidadgenerada.toFixed(2)

            this.importe1 = 0
            this.importe1 = parseFloat(this.preciodeproveedor) * parseFloat(this.cantidad)
            this.importe1 = this.importe1.toFixed(2)

            this.preciounitario = 0
            this.preciounitario = parseFloat(this.preciodeproveedor) + parseFloat(this.utilidadgenerada)
            this.preciounitario = this.preciounitario.toFixed(2)

           },

           cantidad :function(newVal,oldVal){
             this.importe1 = 0
             this.importe1 = parseFloat(this.preciodeproveedor) * parseFloat(this.cantidad)
             this.importe1 = this.importe1.toFixed(2)

             this.importe2 = 0
             this.importe2 = parseFloat(this.cantidad) * parseFloat(this.preciounitario)
             this.importe2 = this.importe2.toFixed(2)
           },


           utilidadglobal :function(newVal,oldVal){
            this.utilidadgenerada = 0
            this.utilidadgenerada = parseFloat(this.utilidadglobal/100)*parseFloat(this.preciodeproveedor)
             this.utilidadgenerada = this.utilidadgenerada.toFixed(2)
           },

           utilidadgenerada :function(newVal,oldVal){
             this.preciounitario = 0
             this.preciounitario = parseFloat(this.preciodeproveedor) + parseFloat(this.utilidadgenerada)
             this.preciounitario = this.preciounitario.toFixed(2)
           },

           preciounitario :function(newVal,oldVal){
             this.importe2 = 0
             this.importe2 = parseFloat(this.cantidad) * parseFloat(this.preciounitario)
             this.importe2 = this.importe2.toFixed(2)
           },
          

         },
          methods:{
            abrirpopup(idCotizacion,idPartida,imagen){
             
              // var url = process.env.MIX_ARCHIVOS_URL;
              var url = 'http://localhost/laravel/storage/app/cotizaciones/'+idCotizacion+'/'+idPartida+'/'
              window.open(url+imagen,'popup','width=600,height=600')
              // falta poner la ruta real

            },
             cargarEdicion(item){
            this.tab=0
            if (item.producto != null) {
              if (item.producto.segmento != null) {
                  this.segmento = (item.producto.segmento.id != null ) ? parseInt(item.producto.segmento.id )  : null
              }
            }
            
            this.politicas = item.politicas
            this.partida = item.partida
            this.descripcion = item.descripcion
            this.unidaddemedida = item.unidadmedida
            this.cantidad = item.cantidad
            this.preciodeproveedor = item.precioproveedor
            this.marca = item.marca
            this.modelo = item.modelo
            this.numerodeserie = item.numserie
            this.notasdelproducto = item.notasproducto
            this.ivaglobal = item.ivapartida
            this.iepsglobal = item.iepspartida
            this.utilidadglobal = item.utilidadpartida
            this.idPartida = item.id
            this.idProducto = item.producto.id

            this.esEdicion = true
            this.esMejorada = false


            },
            cargarEdicionMejorada(item){
            this.tab=0
             if (item.producto != null) {
              if (item.producto.segmento != null) {
                  this.segmento = (item.producto.segmento.id != null ) ? parseInt(item.producto.segmento.id )  : null
              }
            }
            this.politicas = item.politicas
            this.partida = item.partida
            this.descripcion = item.descripcion
            this.unidaddemedida = item.unidadmedida
            this.cantidad = item.cantidad
            this.preciodeproveedor = item.precioproveedor
            this.marca = item.marca
            this.modelo = item.modelo
            this.numerodeserie = item.numserie
            this.notasdelproducto = item.notasproducto
            this.ivaglobal = item.ivapartida
            this.iepsglobal = item.iepspartida
            this.utilidadglobal = item.utilidadpartida
            this.idPartida = item.id
            this.idProducto = item.producto.id

            this.esEdicion = false
            this.esMejorada = true


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
                 this.cotizacion = response.data.response
                 if (this.cotizacion != null) {

                  if (this.cotizacion.ivaGlobal != null) {
                      this.ivaglobal = parseInt(this.cotizacion.ivaGlobal)
                  }
                  if (this.cotizacion.iepsGlobal != null) {
                       this.iepsglobal = parseInt(this.cotizacion.iepsGlobal)
                  }
                  if (this.cotizacion.utilidad != null) {
                    if (this.cotizacion.utilidad.porcentaje != null) {
                        this.utilidadglobal = parseInt(this.cotizacion.utilidad.porcentaje)
                    }
                  }
                 }
                 
                 // this.utilidadglobal = parseInt(this.cotizacion.utilidad.porcentaje)
                 // this.ivaglobal = parseInt(this.cotizacion.ivaGlobal)
                 // this.iepsglobal = parseInt(this.cotizacion.iepsGlobal)
                

                } catch (error) {

                   swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                    console.log(error);

                }
            },

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

                   async guardarPartida(){
                    console.log(this.cantidad,this.marca,this.numerodeserie)
                    
                    let formData = new FormData()
                      formData.append( 'idCotizacion' , parseInt(this.$route.params.id))
                      formData.append( 'idEmpleado' , parseInt(localStorage.getItem('idPerfil')) )
                      formData.append( 'politicas' ,(this.politicas == false) ? 0 : 1)
                      formData.append( 'partida' ,parseFloat(this.partida))
                      formData.append( 'descripcion' ,this.descripcion)
                      formData.append( 'segmento' ,this.segmento)
                      formData.append( 'unidaddemedida' ,this.unidaddemedida)
                      formData.append( 'cantidad' ,(this.cantidad == null || this.cantidad == "")  ? null : parseFloat(this.cantidad))
                      formData.append( 'preciodeproveedor' ,(this.preciodeproveedor == null || this.preciodeproveedor == "")  ? null : parseFloat(this.preciodeproveedor))
                      formData.append( 'marca' ,this.marca)
                      formData.append( 'modelo' ,this.modelo)
                      formData.append( 'numerodeserie' ,this.numerodeserie)
                      formData.append( 'notasdelproducto' ,this.notasdelproducto)
                      formData.append( 'ivaglobal' , (this.ivaglobal != null) ? parseFloat(this.ivaglobal) : null )
                      formData.append( 'utilidadglobal' ,(this.utilidadglobal != null) ? parseFloat(this.utilidadglobal) : null)
                      formData.append( 'iepsglobal' ,(this.iepsglobal != null) ? parseFloat(this.iepsglobal) : null)
                      formData.append( 'importe1' ,(this.importe1 != null) ? parseFloat(this.importe1) : null)
                      formData.append( 'utilidadgenerada' ,(this.utilidadgenerada != null) ? parseFloat(this.utilidadgenerada) : null)
                      formData.append( 'preciounitario' ,(this.preciounitario != null) ? parseFloat(this.preciounitario) : null)
                      formData.append( 'importe2' ,(this.importe2 != null) ? parseFloat(this.importe2) : null)
                      if(this.files.length != 0){
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            formData.append('archivo['+i+']',file)
                        }
                      }

                      try {
                        const response = await axios({
                        method: 'post',
                        url: 'savePartidaCotizacion',
                        data:formData
                        })


                        //ok
                         swal("ÉXITO", "LA PARTIDA SE HA GUARDADO CON ÉXITO", "success");
                         this.getPartidas()

                        this.politicas = false
                        this.partida = this.partida + 1
                        this.descripcion = null
                        this.segmento = null
                        this.unidaddemedida = null
                        this.cantidad = null
                        this.preciodeproveedor = null
                        this.restariva = false
                        this.marca = null
                        this.modelo = null
                        this.numerodeserie = null
                        this.notasdelproducto = null
                        this.files.splice(0)
                        this.personalizarglobal = false
                        
                        this.importe1 = null
                        this.utilidadgenerada = null
                        this.preciounitario = null
                        this.importe2 = null
                        this.utilidadglobal = parseInt(this.cotizacion.utilidad.porcentaje)
                        this.ivaglobal = parseInt(this.cotizacion.ivaGlobal)
                        this.iepsglobal = parseInt(this.cotizacion.iepsGlobal)


                      } catch(error) {

                      }

                   },
                    async getPartidas(){
                      try {
                         const response = await axios({
                      method: 'post',
                      url: 'getPartidasCotizacion',
                      data:{
                        id:this.$route.params.id,
                       
                      }
                    })
                         this.partidas = response.data.response
                         let contador = 0
                         $.each(this.partidas, function(key, value) {
                          console.log(value.esMejora)
                          if (value.esMejora != 1) {
                            contador = contador + 1
                          }
                           
                         });
                         this.totalpartidas = contador
                         this.partida = contador + 1
                         console.log("contador", contador)

                     } catch (error) {
                        swal("Error", "Ha ocurrido un error en el servidor", "warning");

                         console.log(error);

                     }

                   },
                   async editarPartida(){
                    
                    
                    let formData = new FormData()
                      formData.append( 'idCotizacion' , parseInt(this.$route.params.id))
                      formData.append( 'idPartida' , parseInt(this.idPartida))
                      formData.append( 'idProducto' , parseInt(this.idProducto))
                      formData.append( 'idEmpleado' , parseInt(localStorage.getItem('idPerfil')) )
                      formData.append( 'politicas' ,(this.politicas == false) ? 0 : 1)
                      formData.append( 'partida' ,parseFloat(this.partida))
                      formData.append( 'descripcion' ,this.descripcion)
                      formData.append( 'segmento' ,this.segmento)
                      formData.append( 'unidaddemedida' ,this.unidaddemedida)
                      formData.append( 'cantidad' ,(this.cantidad == null || this.cantidad == "" || this.cantidad == "NO COTIZA")  ? null : parseFloat(this.cantidad))
                      formData.append( 'preciodeproveedor' ,(this.preciodeproveedor == null || this.preciodeproveedor == "" || this.preciodeproveedor == "NO COTIZA")  ? null : parseFloat(this.preciodeproveedor))
                      formData.append( 'marca' ,this.marca)
                      formData.append( 'modelo' ,this.modelo)
                      formData.append( 'numerodeserie' ,this.numerodeserie)
                      formData.append( 'notasdelproducto' ,this.notasdelproducto)
                      formData.append( 'ivaglobal' , (this.ivaglobal != null) ? parseFloat(this.ivaglobal) : null )
                      formData.append( 'utilidadglobal' ,(this.utilidadglobal != null) ? parseFloat(this.utilidadglobal) : null)
                      formData.append( 'iepsglobal' ,(this.iepsglobal != null) ? parseFloat(this.iepsglobal) : null)
                      formData.append( 'importe1' ,(this.importe1 != null) ? parseFloat(this.importe1) : null)
                      formData.append( 'utilidadgenerada' ,(this.utilidadgenerada != null) ? parseFloat(this.utilidadgenerada) : null)
                      formData.append( 'preciounitario' ,(this.preciounitario != null) ? parseFloat(this.preciounitario) : null)
                      formData.append( 'importe2' ,(this.importe2 != null) ? parseFloat(this.importe2) : null)
                      if(this.files.length != 0){
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            formData.append('archivo['+i+']',file)
                        }
                      }

                      try {
                        const response = await axios({
                        method: 'post',
                        url: 'editarPartida',
                        data:formData
                        })


                        //ok
                         swal("ÉXITO", "LA PARTIDA SE HA EDITADO CON ÉXITO", "success");
                         this.esEdicion = false
                        this.idProducto = null
                        this.idPartida = null
                        this.politicas = false
                        this.partida = null
                        this.descripcion = null
                        this.segmento = null
                        this.unidaddemedida = null
                        this.cantidad = null
                        this.preciodeproveedor = null
                        this.restariva = false
                        this.marca = null
                        this.modelo = null
                        this.numerodeserie = null
                        this.notasdelproducto = null
                        this.files.splice(0)
                        this.personalizarglobal = false
                        
                        this.importe1 = null
                        this.utilidadgenerada = null
                        this.preciounitario = null
                        this.importe2 = null
                        this.utilidadglobal = parseInt(this.cotizacion.utilidad.porcentaje)
                        this.ivaglobal = parseInt(this.cotizacion.ivaGlobal)
                        this.iepsglobal = parseInt(this.cotizacion.iepsGlobal)


                      } catch(error) {

                      }

                   },
                   async mejorarPartida(){
                    
                    
                    let formData = new FormData()
                      formData.append( 'idCotizacion' , parseInt(this.$route.params.id))
                      formData.append( 'idPartida' , parseInt(this.idPartida))
                      formData.append( 'idProducto' , parseInt(this.idProducto))
                      formData.append( 'idEmpleado' , parseInt(localStorage.getItem('idPerfil')) )
                      formData.append( 'politicas' ,(this.politicas == false) ? 0 : 1)
                      formData.append( 'partida' ,parseFloat(this.partida))
                      formData.append( 'descripcion' ,this.descripcion)
                      formData.append( 'segmento' ,this.segmento)
                      formData.append( 'unidaddemedida' ,this.unidaddemedida)
                      formData.append( 'cantidad' ,(this.cantidad == null || this.cantidad == "" || this.cantidad == "NO COTIZA")  ? null : parseFloat(this.cantidad))
                      formData.append( 'preciodeproveedor' ,(this.preciodeproveedor == null || this.preciodeproveedor == "" || this.preciodeproveedor == "NO COTIZA")  ? null : parseFloat(this.preciodeproveedor))
                      formData.append( 'marca' ,this.marca)
                      formData.append( 'modelo' ,this.modelo)
                      formData.append( 'numerodeserie' ,this.numerodeserie)
                      formData.append( 'notasdelproducto' ,this.notasdelproducto)
                      formData.append( 'ivaglobal' , (this.ivaglobal != null) ? parseFloat(this.ivaglobal) : null )
                      formData.append( 'utilidadglobal' ,(this.utilidadglobal != null) ? parseFloat(this.utilidadglobal) : null)
                      formData.append( 'iepsglobal' ,(this.iepsglobal != null) ? parseFloat(this.iepsglobal) : null)
                      formData.append( 'importe1' ,(this.importe1 != null) ? parseFloat(this.importe1) : null)
                      formData.append( 'utilidadgenerada' ,(this.utilidadgenerada != null) ? parseFloat(this.utilidadgenerada) : null)
                      formData.append( 'preciounitario' ,(this.preciounitario != null) ? parseFloat(this.preciounitario) : null)
                      formData.append( 'importe2' ,(this.importe2 != null) ? parseFloat(this.importe2) : null)
                      if(this.files.length != 0){
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            formData.append('archivo['+i+']',file)
                        }
                      }

                      try {
                        const response = await axios({
                        method: 'post',
                        url: 'mejorarPartida',
                        data:formData
                        })


                        //ok
                         swal("ÉXITO", "LA PARTIDA SE HA MEJORADO CON ÉXITO", "success");
                         this.esEdicion = false
                         this.esMejorada = false
                        this.idProducto = null
                        this.idPartida = null
                        this.politicas = false
                        this.partida = null
                        this.descripcion = null
                        this.segmento = null
                        this.unidaddemedida = null
                        this.cantidad = null
                        this.preciodeproveedor = null
                        this.restariva = false
                        this.marca = null
                        this.modelo = null
                        this.numerodeserie = null
                        this.notasdelproducto = null
                        this.files.splice(0)
                        this.personalizarglobal = false
                        
                        this.importe1 = null
                        this.utilidadgenerada = null
                        this.preciounitario = null
                        this.importe2 = null
                        this.utilidadglobal = parseInt(this.cotizacion.utilidad.porcentaje)
                        this.ivaglobal = parseInt(this.cotizacion.ivaGlobal)
                        this.iepsglobal = parseInt(this.cotizacion.iepsGlobal)


                      } catch(error) {

                      }

                   },
           
            
            
          },

    }
</script>
