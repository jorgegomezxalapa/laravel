<template>
    <v-container fluid>
        
        
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Módulo de Cotizaciones<v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{parseInt(this.solicitadas.length)+parseInt(this.proceso.length)+parseInt(this.cotizadas.length)}} EN TOTAL
    </v-chip></v-card-title>

<v-divider></v-divider>
<v-card-text>
  <v-tabs grow color="primary" background-color="grey lighten-3" >
            <v-tab @click="getSolicitadas">PENDIENTES <v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.solicitadas.length}}
    </v-chip> </v-tab>
            <v-tab @click="getProceso">EN PROCESO <v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.proceso.length}}
    </v-chip> </v-tab>
            <v-tab @click="getCotizadas">COTIZADAS <v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.cotizadas.length}}
    </v-chip> </v-tab>

            <v-tab-item>
              <v-card
                elevation="2"
                class="mt-5 mb-5"
              >
              <v-divider></v-divider>
              <v-text-field
        v-model="search1"
        append-icon="mdi-magnify"
        label="BUSCAR DATOS POR COLUMNA"
        single-line
        hide-details
      ></v-text-field>
      <v-divider></v-divider>
                <v-data-table
                :items-per-page="5"
      :headers="headersSolicitadas"
      :items="solicitadas"
      :search="search1"
    >
     <template v-slot:item.solicitud.urgente="{ item }">

       <v-chip
      class="ma-2"
      color="orange"
      dark
      v-if="item.solicitud.urgente == 1"
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
   
    <template v-slot:item.solicitud.folio="{ item }">

       <v-chip
      class="ma-2"
      color="primary"
     
      dark
    >
      {{item.solicitud.folio}}
    </v-chip>

    </template>

    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
        <router-link :to="{name: 'iniciarCotizacion', params:{id:item.id}}">
      <v-btn
       v-bind="attrs"
          v-on="on"
               small
                color="primary"
                dark

                fab
              >
                <v-icon>mdi-file-send-outline</v-icon>
              </v-btn>
            </router-link>
          </template>
          <span>Acceder a la Cotización</span>
      </v-tooltip>

    </template>
    </v-data-table>
              </v-card>
            </v-tab-item>
            <v-tab-item>
              <v-card
                elevation="2"
                class="mt-5 mb-5"
              >
              <v-divider></v-divider>
              <v-text-field
        v-model="search2"
        append-icon="mdi-magnify"
        label="BUSCAR DATOS POR COLUMNA"
        single-line
        hide-details
      ></v-text-field>
      <v-divider></v-divider>
                <v-data-table
                :items-per-page="5"
      :headers="headersProceso"
      :items="proceso"
      :search="search2"
    >
    <template v-slot:item.solicitud.folio="{ item }">

       <v-chip
      class="ma-2"
      color="primary"
     
      dark
    >
      {{item.solicitud.folio}}
    </v-chip>

    </template>
    <template v-slot:item.partidas="{ item }">

       <v-chip
      class="ma-2"
      color="primary"
     
      dark
    >
      {{item.partidas.length}}
    </v-chip>

    </template>

    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
        <router-link :to="{name: 'iniciarCotizacion', params:{id:item.id}}">
      <v-btn
       v-bind="attrs"
          v-on="on"
               small
                color="primary"
                dark

                fab
              >
                <v-icon>mdi-file-send-outline</v-icon>
              </v-btn>
            </router-link>
          </template>
          <span>Acceder a la Cotización</span>
      </v-tooltip>

    </template>
    </v-data-table>
              </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card
                elevation="2"
                class="mt-5 mb-5"
              >
              <v-divider></v-divider>
              <v-text-field
        v-model="search3"
        append-icon="mdi-magnify"
        label="BUSCAR DATOS POR COLUMNA"
        single-line
        hide-details
      ></v-text-field>
      <v-divider></v-divider>
                <v-data-table
                :items-per-page="5"
      :headers="headersCotizadas"
      :items="cotizadas"
      :search="search3"
    >
    <template v-slot:item.partidas="{ item }">

       <v-chip
      class="ma-2"
      color="primary"
     
      dark
    >
      {{item.partidas.length}}
    </v-chip>

    </template>
    <template v-slot:item.solicitud.folio="{ item }">

       <v-chip
      class="ma-2"
      color="primary"
     
      dark
    >
      {{item.solicitud.folio}}
    </v-chip>

    </template>

    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
        <router-link :to="{name: 'iniciarCotizacion', params:{id:item.id}}">
      <v-btn
       v-bind="attrs"
          v-on="on"
               small
                color="primary"
                dark

                fab
              >
                <v-icon>mdi-file-send-outline</v-icon>
              </v-btn>
            </router-link>
          </template>
          <span>ACCEDER A LA COTIZACIÓN</span>
      </v-tooltip>

    </template>
    
    </v-data-table>
              </v-card>
            </v-tab-item>

        </v-tabs>
</v-card-text>
  
    <v-divider></v-divider>
    <v-card-actions>


    </v-card-actions>
  </v-card>
    </v-container>
</template>

<script>
    export default {
      mounted(){
   this.getSolicitadas()
   this.getProceso()
   this.getCotizadas()

   },
    data () {
      return {
        value:0,
        search1: '',
        search2: '',
        search3: '',
        headersSolicitadas: [
          {
            text: 'FOLIO',
            align: 'center',
            value: 'solicitud.folio', class: "primary"
          },
         
          { text: 'TIPO DE SOLICITUD', align: 'center', value: 'solicitud.urgente', class: "primary" },
         { text: 'FECHA DE SOLICITUD', align: 'center', value: 'solicitud.fecha', class: "primary" },
          { text: 'CLIENTE', align: 'center', value: 'solicitud.cliente.razonSocial', class: "primary" },
          { text: 'PERSONA SOLICITANTE', align: 'center', value: 'solicitud.solicitante.nombre', class: "primary" },
          { text: 'AGENTE DE VENTAS', align: 'center', value: 'solicitud.agente.name', class: "primary" },
          { text: 'RESPONSABLE', align: 'center', value: 'solicitud.responsable.name', class: "primary" },
          { text: 'ACCIONES', align: 'center', value: 'acciones', class: "primary" },
        ],
        headersProceso: [
         {
            text: 'FOLIO',
            align: 'center',
            value: 'solicitud.folio', class: "primary"
          },
          {
            text: 'PARTIDAS REGISTRADAS',
            align: 'center',
            value: 'partidas', class: "primary"
          },
         { text: 'FECHA DE SOLICITUD', align: 'center', value: 'solicitud.fecha', class: "primary" },
          { text: 'CLIENTE', align: 'center', value: 'solicitud.cliente.razonSocial', class: "primary" },
          { text: 'PERSONA SOLICITANTE', align: 'center', value: 'solicitud.solicitante.nombre', class: "primary" },
          { text: 'AGENTE DE VENTAS', align: 'center', value: 'solicitud.agente.name', class: "primary" },
          { text: 'RESPONSABLE', align: 'center', value: 'solicitud.responsable.name', class: "primary" },
          { text: 'ACCIONES', align: 'center', value: 'acciones', class: "primary" },
        ],
        headersCotizadas: [
          {
            text: 'FOLIO',
            align: 'center',
            value: 'solicitud.folio', class: "primary"
          },
         { text: 'FECHA DE SOLICITUD', align: 'center', value: 'solicitud.fecha', class: "primary" },
         { text: 'FECHA DE FINALIZADO', align: 'center', value: 'fechafinalizado', class: "primary" },
         {
            text: 'PARTIDAS REGISTRADAS',
            align: 'center',
            value: 'partidas', class: "primary"
          },
          { text: 'CLIENTE', align: 'center', value: 'solicitud.cliente.razonSocial', class: "primary" },
          { text: 'PERSONA SOLICITANTE', align: 'center', value: 'solicitud.solicitante.nombre', class: "primary" },
          { text: 'AGENTE DE VENTAS', align: 'center', value: 'solicitud.agente.name', class: "primary" },
          { text: 'RESPONSABLE', align: 'center', value: 'solicitud.responsable.name', class: "primary" },
          { text: 'ACCIONES', align: 'center', value: 'acciones', class: "primary" },
        ],
        solicitadas: [],
        proceso: [],
        cotizadas: [],
      }
    },
     methods: {
        capturarCotizacion(){
            this.$router.push({ name: 'capturarCotizacion' }).catch(()=>{});
        },
        async getSolicitadas(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getSolicitadas',
                })

                this.solicitadas = response.data.response
               
            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        },

        async getProceso(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getProceso',
                })

                this.proceso = response.data.response
                console.log(this.cotizaciones)


            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        },

        async getCotizadas(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getCotizadas',
                })

                this.cotizadas = response.data.response
                console.log(this.cotizaciones)


            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        }

     },
  }
</script>
