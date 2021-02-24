<template>
  <v-container
    id="dashboard-view1"
    fluid
    tag="section"
  >
    <v-row>

          <v-col
            cols="12"
            md="6"
          >
          <v-card>
      <v-toolbar
        color="primary"
        dark
        flat
      >

        <v-toolbar-title>Solicitudes</v-toolbar-title>

        <template v-slot:extension>
          <v-tabs
            v-model="tab"
            align-with-title
          >
            <v-tabs-slider color="yellow"></v-tabs-slider>
            <v-tab
            href="#tab-0"
            >
            Registradas
            </v-tab>

          </v-tabs>
        </template>
      </v-toolbar>

      <v-tabs-items v-model="tab">
        <v-tab-item
        value="tab-0"
        >
          <v-card flat>
            <v-card-text>
              <v-text-field
       v-model="search"
       append-icon="mdi-magnify"
       label="Buscar por parámetro"
       single-line
       hide-details
     ></v-text-field>

     <v-data-table
     :headers="solicitudesH"
     :items="desserts"
     :search="search"
   ></v-data-table>
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
          </v-col>

          <!-- <v-col
            cols="12"
            md="6"
          >
          <v-card>
      <v-toolbar
        color="primary"
        dark
        flat
      >

        <v-toolbar-title>Cotizaciones</v-toolbar-title>

        <template v-slot:extension>
          <v-tabs
            v-model="tab"
            align-with-title
          >
            <v-tabs-slider color="yellow"></v-tabs-slider>
            <v-tab
            href="#tab-0"
            >
            En Proceso
            </v-tab>
            <v-tab
            href="#tab-0"
            >
            En Proceso
            </v-tab>
            <v-tab
            href="#tab-0"
            >
            En Proceso
            </v-tab>

          </v-tabs>
        </template>
      </v-toolbar>

      <v-tabs-items v-model="tab">
        <v-tab-item
        value="tab-0"
        >
          <v-card flat>
            <v-card-text>
              <v-text-field
       v-model="search"
       append-icon="mdi-magnify"
       label="Buscar por parámetro"
       single-line
       hide-details
     ></v-text-field>

     <v-data-table
     :headers="solicitudesH"
     :items="desserts"
     :search="search"
   ></v-data-table>
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
          </v-col> -->




  </v-row>
  </v-container>
</template>

<script>


  export default {

    data: () => ({
      tab: null,
             items: [
               'web', 'shopping', 'videos', 'images', 'news',
             ],
             text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
             search: '',
       solicitudesH: [
         {
           text: 'Fecha',
           align: 'start',
           filterable: false,
           value: 'name',
         },
         { text: 'Folio', value: 'calories' },
         { text: 'Responsable', value: 'fat' },
         { text: 'Agente de Ventas', value: 'carbs' },
         { text: 'Con Atención A', value: 'protein' },
         { text: 'Solicitante', value: 'iron' },

       ],
        desserts: [],


    }),

    computed: {

    },
  }
</script>
