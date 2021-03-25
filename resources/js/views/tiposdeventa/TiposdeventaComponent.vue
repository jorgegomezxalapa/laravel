<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">MÓDULO TIPOS DE VENTA<v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.utilidades.length}} REGISTRADAS
    </v-chip></v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
           <router-link :to="{name: 'nuevaUtilidad'}">
            <v-btn
              color="primary"
              dark
            >
              Registrar Nuevo Tipo de Venta
              <v-icon
        right
        dark
      >
        mdi-database-plus
      </v-icon>
            </v-btn>
          </router-link>
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
      :items="utilidades"
      :search="search"
      :items-per-page="5"
    >




    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarUtilidad', params:{id:item.id}}">
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
          <span>EDITAR TIPO DE VENTA</span>
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
            text: 'FECHA DE REGISTRO',
            align: 'center',

            value: 'created_at',class: "primary"
          },
          { text: 'DESCRIPCIÓN', align: 'center', value: 'descripcion', class: "primary" },
            { text: 'PORCENTAJE DE UTILIDAD', align: 'center', value: 'porcentaje', class: "primary" },

          { text: 'ACCIONES', align: 'center', value: 'acciones', class: "primary" },
        ],
        utilidades: [],
      }
    },
    mounted(){
 this.getUtilidades()

 },
     methods: {

        async getUtilidades(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getUtilidades',
                })

                this.utilidades = response.data.response
                console.log(this.utilidades)


            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIRO", "POR FAVOR RECARGA LA PÁGINA", "error");
                console.log(error);

            }
        },
     },
  }
</script>
