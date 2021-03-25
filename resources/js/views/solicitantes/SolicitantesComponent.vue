<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">MÓDULO DE PERSONAS SOLICITANTES<v-chip
      class="ma-2"
      color="secondary"
      dark
      
    >
      {{this.solicitantes.length}} REGISTRADAS
    </v-chip></v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="5">
            <v-btn
              color="primary"
              dark
             @click="nuevoSolicitante"
            >
              REGISTRAR NUEVA PERSONA SOLICITANTE
               <v-icon
        right
        dark
      >
        mdi-account-plus
      </v-icon>
            </v-btn>
        </v-col>
        <v-col cols="12" md="7">
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
      :items="solicitantes"
      :search="search"
      :items-per-page="5"
    >



    <template v-slot:item.acciones="{ item }">
      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarSolicitante', params:{id:item.id}}">
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
          <span>EDITAR DATOS DE SOLICITANTE</span>
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
   this.getsolicitantes()

   },
    data () {
      return {
        search: '',
        headers: [
        { text: 'FECHA DE REGISTRO', align: 'center', value: 'created_at', class: "primary" },
          {
            text: 'NOMBRE COMPLETO',
            align: 'center',

            value: 'nombre', class: "primary"
          },
          { text: 'EMAIL DE CONTACTO', align: 'center', value: 'email', class: "primary" },
          { text: 'TELÉFONO DE CONTACTO', align: 'center', value: 'telefono', class: "primary" },



          { text: 'ACCIONES', align: 'center', value: 'acciones', class: "primary" },
        ],
        solicitantes: [],
      }
    },
     methods: {
        nuevoSolicitante(){
            this.$router.push({ name: 'nuevoSolicitante' }).catch(()=>{});
        },
        async getsolicitantes(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getSolicitantes',
                })

                this.solicitantes = response.data.response



            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "POR FAVOR RECARGA LA PÁGINA", "error");
                console.log(error);

            }
        },
     },
  }
</script>
