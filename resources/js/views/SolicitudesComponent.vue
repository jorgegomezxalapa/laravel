<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Registro de Solicitudes</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevaSolicitud"
            >
              Registrar Nueva Solicitud
            </v-btn>
        </v-col>
        <v-col cols="12" md="8">
            <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Buscar por parámetro"
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
    >




    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarSolicitud', params:{id:item.id}}">
      <v-btn
       v-bind="attrs"
          v-on="on"
               small
                color="warning"
                dark

                fab
              >
                <v-icon>mdi-pencil-box-outline</v-icon>
              </v-btn>
            </router-link>
          </template>
          <span>Editar Solicitud</span>
      </v-tooltip>

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
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
          </template>
          <span>Ver Cotización</span>
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
          {
            text: 'Fecha de recepción',
            align: 'center',

            value: 'fecha',
          },
          { text: 'Folio asignado', align: 'center', value: 'folio' },
            { text: 'Responsable', align: 'center', value: 'responsable' },
          { text: 'Agente de Venta', align: 'center', value: 'agente' },
          { text: 'Con Atención a', align: 'center', value: 'cliente' },
          { text: 'Solicitante', align: 'center', value: 'solicitante' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
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
