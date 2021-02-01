<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Módulo de Tipos de Venta(Utilidades)</v-card-title>

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
            </v-btn>
          </router-link>
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
      :items="utilidades"
      :search="search"
    >




    <template v-slot:item.acciones="{ item }">

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarUtilidad', params:{id:item.id}}">
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
          <span>Editar Tipo de Venta</span>
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
            text: 'Fecha de registro',
            align: 'center',

            value: 'created_at',
          },
          { text: 'Descripción', align: 'center', value: 'descripcion' },
            { text: 'Porcentaje %', align: 'center', value: 'porcentaje' },

          { text: 'Acciones', align: 'center', value: 'acciones' },
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

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        },
     },
  }
</script>
