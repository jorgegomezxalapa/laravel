<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">MÓDULO DE SOLICITUDES</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevaSolicitud"
            >
              REGISTRAR NUEVA SOLICITUD
              <v-icon
        right
        dark
      >
        mdi-import
      </v-icon>
            </v-btn>
        </v-col>
        <v-col cols="12" md="8">
            <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="BUSCAR DATOS POR COLUMNA"
        single-line
        hide-details
      ></v-text-field>
        </v-col>
    </v-row>

    <v-row>
       <v-col cols="12">
          <v-data-table
      :headers="headers"
      :items="solicitudes"
      :search="search"
       :items-per-page="5"
    >

    <template v-slot:item.folio="{ item }">

     
    <v-chip
      class="ma-2"
      color="primary"
     
      dark
    >
      {{item.folio}}
    </v-chip>

     

    </template>

    <template v-slot:item.urgente="{ item }">

      <v-chip
      class="ma-2"
      color="orange"
      dark
      v-if="item.urgente == 1"
    >
      URGENTE
    </v-chip>
    <v-chip
      class="ma-2"
      color="primary"
      v-else
      dark
    >
      NORMAL
    </v-chip>

     

    </template>
    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarSolicitud', params:{id:item.id}}">
      <v-btn
      v-bind="attrs"
          v-on="on"
      class="ma-2 blue--text"
      fab
        
        
    >
      <v-icon dark>mdi-pencil-box-outline</v-icon>
    </v-btn>
            </router-link>
          </template>
          <span>EDITAR INFORMACIÓN DE LA SOLICITUD</span>
      </v-tooltip>

     

    </template>
    </v-data-table>
       </v-col>
    </v-row>


    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>


    </v-card-actions>
  </v-card>
    </v-container>
</template>

<script>
    export default {
    data () {
      return {
        search: '',
        headers: [
        { text: 'FOLIO', align: 'center', value: 'folio' },
         { text: 'PRIORIDAD', align: 'center', value: 'urgente' },
        
          {
            text: 'FECHA DE RECEPCIÓN',
            align: 'center',

            value: 'fecha',
          },

           { text: 'RAZÓN SOCIAL', align: 'center', value: 'cliente.razonSocial' },
           { text: 'SOLICITANTE', align: 'center', value: 'solicitante.nombre' },
          { text: 'AGENTE DE VENTA', align: 'center', value: 'agente.name' },
            { text: 'RESPONSABLE', align: 'center', value: 'responsable.name' },
          
         
          
          { text: 'ACCIONES', align: 'center', value: 'acciones' },
        ],
        solicitudes: [],
      }
    },
    mounted(){
 this.getsolicitudes()

 },
     methods: {
        nuevaSolicitud(){
            this.$router.push({ name: 'nuevaSolicitud' }).catch(()=>{});
        },
        async getsolicitudes(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getSolicitudes',
                })

                this.solicitudes = response.data.response
                console.log(this.solicitudes)


            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        },
     },
  }
</script>
