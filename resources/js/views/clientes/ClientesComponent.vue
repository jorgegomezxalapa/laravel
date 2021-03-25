<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">MÓDULO DE CLIENTES<v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.clientes.length}} REGISTRADOS
    </v-chip></v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevoCliente"
            >
              REGISTRAR NUEVO CLIENTE
              <v-icon
        right
        dark
      >
        mdi-account-plus
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
      :items="clientes"
      :search="search"
      :items-per-page="5"
    >


    <template v-slot:item.acciones="{ item }">
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <router-link :to="{name: 'editarCliente', params:{id:item.id}}">
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
          <span>EDITAR INFORMACIÓN DEL CLIENTE</span>
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
   this.getClientes()

   },
    data () {
      return {
        search: '',
        headers: [
        {
            text: 'FECHA DE REGISTRO',
            align: 'center',

            value: 'created_at', class: "primary"
          },
          {
            text: 'RAZÓN SOCIAL',
            align: 'center',

            value: 'razonSocial', class: "primary"
          },
          { text: 'DIRIGIDO A', align: 'center', value: 'representante', class: "primary" },
            { text: 'CON ATENCIÓN A', align: 'center', value: 'conatencion', class: "primary" },
          { text: 'RFC', align: 'center', value: 'rfc', class: "primary" },
          { text: 'EMAIL', align: 'center', value: 'email', class: "primary" },
            { text: 'TELÉFONO', align: 'center', value: 'telefono', class: "primary" },


          { text: 'ACCIONES', align: 'center', value: 'acciones', class: "primary" },
        ],
        clientes: [],
      }
    },
     methods: {
       async getClientes(){
         try {
               const response = await axios({
                 method: 'get',
                 url: 'getClientes',
               })

               this.clientes = response.data.response
               console.log(this.clientes)


           } catch (error) {

              swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
               console.log(error);

           }
       },
        nuevoCliente(){
            this.$router.push({ name: 'nuevoCliente' }).catch(()=>{});
        }
     },
  }
</script>
