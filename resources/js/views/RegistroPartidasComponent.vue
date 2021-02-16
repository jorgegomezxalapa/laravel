<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >

      <v-toolbar
      flat
      color="secondary"
      dark
    >
      <v-toolbar-title>Detalle de la Cotización</v-toolbar-title>
    </v-toolbar>
    <v-card>
   <v-tabs
     v-model="tab"

     centered

     icons-and-text
   >
     <v-tabs-slider></v-tabs-slider>

     <v-tab href="#tab-1">
       Detalle de la solicitud
       <v-icon>mdi-import</v-icon>
     </v-tab>

     <v-tab href="#tab-2">
       Detalle de las Partidas
       <v-icon>mdi-clipboard-text</v-icon>
     </v-tab>

     <v-tab href="#tab-3">
       Acciones Disponibles
       <v-icon>mdi-auto-fix</v-icon>
     </v-tab>
   </v-tabs>



 </v-card>


  </v-card>
    </v-container>
</template>
