<template>
  <div>
    <p class="font-weight-black" style="cursor: pointer" @click="ocultar()">SOLICITANTES<v-icon
          
          right
        >
         mdi-arrow-expand

        </v-icon></p>
    <v-row class="pl-3 pr-3">
     
     <v-col cols="12" v-if="mostrar">
       <v-select
      v-model="mes"
      :items="meses"
      item-text="nombre"
      item-value="id"
      label="SELECCIONAR MES"
      data-vv-name="select"
      class="ml-3 mr-3"
      small
      >
      </v-select>
      <v-select
      v-model="anio"
      :items="anios"
      item-text="nombre"
      item-value="id"
      label="SELECCIONAR AÑO"
      data-vv-name="select"
      class="ml-3 mr-3"
      small
      >
      </v-select>
      <v-btn
       
        class="ml-3 mr-3 mt-3"
        color="primary"
       
        >
        FILTRAR
        </v-btn>
       
     </v-col>

        <v-col
        cols="12"
        
      >
        <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Buscar"
        single-line
        hide-details
      ></v-text-field>
      <v-data-table
      class="mt-3"
      :headers="headers"
      :items="solicitantes"
      :search="search"
      :items-per-page="5"
    ></v-data-table>

      </v-col>
    </v-row>
  </div>
</template>

<script>
  const axios = require('axios');
  export default {
    data: () => ({
      mostrar:false,
      mes:0,
      anio:0,
      solicitantes:[],
      headers: [
          {
            text: 'NOMBRE',
            align: 'start',
            value: '1',
          },
          { text: 'RAZÓN SOCIAL', value: '2' },
          { text: 'SOLICITUDES', value: '3' },
          { text: 'COTIZACIONES', value: '4' },
         
          { text: 'VENTAS', value: '6' },
        ],
    meses:[
          { id: 0, nombre: "TOTAL"},
          { id: 1, nombre: "ENERO"},
          { id: 2, nombre: "FEBRERO"},
          { id: 3, nombre: "MARZO"},
          { id: 4, nombre: "ABRIL"},
          { id: 5, nombre: "MAYO"},
          { id: 6, nombre: "JUNIO"},
          { id: 7, nombre: "JULIO"},
          { id: 8, nombre: "AGOSTO"},
          { id: 9, nombre: "SEPTIEMBRE"},
          { id: 10, nombre: "OCTUBRE"},
          { id: 11, nombre: "NOVIEMBRE"},
          { id: 12, nombre: "DICIEMBRE"},
          ],
          anios:[
          { id: 0, nombre: "TOTAL"},
          { id: 2020, nombre: "2020"},
          { id: 2021, nombre: "2021"},
          { id: 2022, nombre: "2022"},
          { id: 2023, nombre: "2023"},
          { id: 2024, nombre: "2024"},
          { id: 2025, nombre: "2025"},
         
          ],

       }),
    watch: {

    },
    methods: {
      ocultar(){
        this.mostrar = !this.mostrar

      },
     
     

    },
    beforeMount: function () {
   

  },
  mounted: function () {
 
}
  }
</script>

