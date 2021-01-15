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
    <v-card-title class="font-weight-black">Registro de Cotizaciones</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="capturarCotizacion"
            >
              Módulo registro de cotización
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
      :items="desserts"
      :search="search"
    >
      
   

    
    <template v-slot:item.acciones="{ item }">
      
        
     
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
        value:0,
        search: '',
        headers: [
          {
            text: 'Fecha de solicitud',
            align: 'center',
           
            value: 'nombre',
          },
          { text: 'Folio', align: 'center', value: 'usuario' },
          { text: 'Cliente', align: 'center', value: 'rol' },
          { text: 'Solicitante', align: 'center', value: 'solicitante' },
          { text: 'Responsable', align: 'center', value: 'responsable' },
          { text: '% Utilidad', align: 'center', value: 'areaTrabajo' },
          { text: '# Réplicas', align: 'center', value: 'replicas' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
        ],
        desserts: [
          {
            nombre: '01-01-2021',
            usuario: "XAV/V/F1/2020",
            rol: "CFE XALAPA",
            solicitante: "JUAN VALDEZ ORTEGA",
            responsable: "Cotizador 2(Jorge Iván)",
            areaTrabajo: '10%',
            replicas:2,
            cotizaciones: 3,
            cotizaciones2: 10,
            cotizaciones3: 5,
            ventas:10,
            acciones: "Acciones",
          },
          
        ],
      }
    },
     methods: {
        capturarCotizacion(){
            this.$router.push({ name: 'capturarCotizacion' }).catch(()=>{});
        }
     },
  }
</script>
