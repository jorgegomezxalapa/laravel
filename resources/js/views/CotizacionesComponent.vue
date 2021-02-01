<template>
    <v-container fluid>
        <v-bottom-navigation :value="value"
    color="primary"
    horizontal>
    <v-btn  @click="mostrarTabla('ocliente')">
      <span>Pendientes</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

    <v-btn  @click="mostrarTabla('osolicitante')">
      <span>En Proceso</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

    <v-btn  @click="mostrarTabla('omonto')">
      <span>Cotizadas</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

  </v-bottom-navigation>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Módulo de Cotizaciones</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>

        <v-col cols="12" md="12">
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
      :items="cotizaciones"
      :search="search"
    >




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
      mounted(){
   this.getCotizaciones()

   },
    data () {
      return {
        value:0,
        search: '',
        headers: [
          {
            text: 'Folio',
            align: 'center',
            value: 'solicitud.folio',
          },
          { text: 'Fecha de Solicitud', align: 'center', value: 'solicitud.fecha' },
          { text: 'Fecha de Finalizado', align: 'center', value: 'fechafinalizado' },
          { text: 'Dirigido A(Cliente)', align: 'center', value: 'solicitud.cliente.razonSocial' },
          { text: 'Solicitante', align: 'center', value: 'solicitud.solicitante.nombre' },
          { text: 'Responsable', align: 'center', value: 'solicitud.responsable.name' },
          { text: 'Agente de venta', align: 'center', value: 'solicitud.agente.name' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
        ],
        cotizaciones: [],
      }
    },
     methods: {
        capturarCotizacion(){
            this.$router.push({ name: 'capturarCotizacion' }).catch(()=>{});
        },
        async getCotizaciones(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getCotizaciones',
                })

                this.cotizaciones = response.data.response
                console.log(this.cotizaciones)


            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        }

     },
  }
</script>
