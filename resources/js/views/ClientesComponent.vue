<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Módulo de Clientes</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevoCliente"
            >
              Registrar Nuevo Cliente
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
      :items="clientes"
      :search="search"
    >

    <template v-slot:item.cotizaciones="{ item }">
     <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
      <v-chip
       v-bind="attrs"
          v-on="on"
        :color="'grey'"
        dark
      >
        {{ item.cotizaciones }}
      </v-chip>
      </template>
       <span>Pendientes</span>
  </v-tooltip>
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
        <v-chip
         v-bind="attrs"
          v-on="on"
        :color="'orange'"
        dark
      >
        {{ item.cotizaciones2 }}
      </v-chip>
      </template>
       <span>En Proceso</span>
  </v-tooltip>
       <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
        <v-chip
         v-bind="attrs"
          v-on="on"
        :color="'green'"
        dark
      >
        {{ item.cotizaciones3 }}
      </v-chip>
      </template>
       <span>Cotizadas</span>
  </v-tooltip>


    </template>

    <template v-slot:item.ventas="{ item }">
     <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
      <v-chip
       v-bind="attrs"
          v-on="on"
        :color="'green'"
        dark
      >
        {{ item.ventas }}
      </v-chip>
      </template>
       <span>Realizadas</span>
  </v-tooltip>




    </template>
    <template v-slot:item.acciones="{ item }">
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <router-link :to="{name: 'editarCliente', params:{id:item.id}}">
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
          <span>Editar Cliente</span>
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
            text: 'Razón Social(Empresa)',
            align: 'center',

            value: 'razonSocial',
          },
          { text: 'Representante', align: 'center', value: 'representante' },
            { text: 'Con Atención A', align: 'center', value: 'conatencion' },
          { text: 'RFC(Empresa)', align: 'center', value: 'rfc' },
          { text: 'Email(Empresa)', align: 'center', value: 'email' },
            { text: 'Teléfono(Empresa)', align: 'center', value: 'telefono' },
          { text: 'Cotizaciones', align: 'center', value: 'cotizaciones' },
          { text: 'Ventas', align: 'center', value: 'ventas' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
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
