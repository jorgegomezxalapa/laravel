<template>
  <div>
    <p class="font-weight-black" style="cursor: pointer" @click="ocultar()">RAZONES SOCIALES<v-icon
          
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
       @click="filtrar()"
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
      :items="datos"
      :search="search"
      :items-per-page="5"
    >
       <template v-slot:item.solicitudes="{ item }">
      <v-chip
        color="primary"
      >
        {{ item.solicitudes.length }}
      </v-chip>
    </template>
    <template v-slot:item.cotizaciones="{ item }">
      <v-chip
        color="secondary"
      >
        {{ getPendientes(item.cotizaciones) }}
      </v-chip>
      <v-chip
        color="primary"
      >
        {{ getProceso(item.cotizaciones) }}
      </v-chip>
      <v-chip
        color="success"
      >
        {{ getFinalizadas(item.cotizaciones) }}
      </v-chip>
    </template>
    <template v-slot:item.ventas="{ item }">
      <v-chip
        color="success"
      >
        {{ item.ventas.length }}
      </v-chip>
    </template>

    </v-data-table>
    </v-data-table>

      </v-col>
    </v-row>
  </div>
</template>

<script>
  const axios = require('axios');
  export default {
    data: () => ({
      search:"",
      mostrar:false,
      mes:0,
      anio:0,
      datos:[],
      headers: [
          { text: 'RAZÓN SOCIAL', value: 'nombre' },
          { text: 'SOLICITUDES', value: 'solicitudes' },
          { text: 'COTIZACIONES', value: 'cotizaciones' },
          { text: 'VENTAS', value: 'ventas' },
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
      async filtrar(){
        if (this.mes == 0 && this.anio == 0) {
          this.getClientes();
        }else{
         
           const response = await axios({
                  method: 'post',
                  url: 'filtrarBusquedaRazones',
                  data:{
                    mes:this.mes,
                    anio:this.anio
                  }
                })
               this.datos = response.data.response
        }
        this.mes = null
        this.anio = null
        this.mostrar = false

      },
      getPendientes(item){
        var contador = 0
        $.each(item, function(key, value) {
       
         if (parseInt(value.estatus) == 0) {
          contador = contador + 1
         }
       });
        return contador;
      },
       getProceso(item){
       var contador = 0
        $.each(item, function(key, value) {
       
         if (parseInt(value.estatus) == 1) {
          contador = contador + 1
         }
       });
        return contador;
      },
       getFinalizadas(item){
       var contador = 0
        $.each(item, function(key, value) {
       
         if (parseInt(value.estatus) == 2) {
          contador = contador + 1
         }
       });
        return contador;
      },
      async getRazones(){
      const response = await axios({
                  method: 'get',
                  url: 'getRazonesDasboard',
                })
               this.datos = response.data.response
    },
      ocultar(){
        this.mostrar = !this.mostrar

      },
     

    },
    beforeMount: function () {
   

  },
  mounted: function () {
  this.getRazones()
}
  }
</script>

