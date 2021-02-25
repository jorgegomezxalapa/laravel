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
          class="mb-2"
          color="primary darken-5"
          dark
          flat
        >
          <v-toolbar-title>
            Detalle de Solicitudes
          </v-toolbar-title>
        </v-toolbar>

        <v-btn-toggle

        v-model="toggle_exclusive2"
        color="primary darken-5"
      >
        <v-btn>
          Registradas
        </v-btn>


      </v-btn-toggle>

      <v-text-field
        v-model="search1"
        append-icon="mdi-magnify"
        label="Buscar"
        class="mb-5 pl-1 pr-1"
        single-line
        hide-details
      ></v-text-field>
      <v-data-table
      :items-per-page="1"

      :headers="hsolicitudes"
      :items="solicitudes"
      :search="search1"
    ></v-data-table>



          </v-card>
        </v-col>

        <v-col
          cols="12"
          md="6"
        >
        <v-card>

      <v-toolbar
        class="mb-2"
        color="primary darken-5"
        dark
        flat
      >
        <v-toolbar-title>
          Detalle de Cotizaciones
        </v-toolbar-title>
      </v-toolbar>

      <v-btn-toggle

      v-model="toggle_exclusive3"
      color="primary darken-5"
    >
      <v-btn>
        Pendientes
      </v-btn>

      <v-btn>
        En Proces
      </v-btn>

      <v-btn>
        Cotizadas
      </v-btn>

    </v-btn-toggle>

    <v-text-field
      v-model="search2"
      append-icon="mdi-magnify"
      label="Buscar"
      class="mb-5 pl-1 pr-1"
      single-line
      hide-details
    ></v-text-field>
    <v-data-table
    :items-per-page="1"

    :headers="hcotizaciones"
    :items="cotizaciones"
    :search="search2"
  ></v-data-table>



        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="6"
      >
      <v-card>

    <v-toolbar
      class="mb-2"
      color="primary darken-5"
      dark
      flat
    >
      <v-toolbar-title>
        Detalle de Ventas
      </v-toolbar-title>
    </v-toolbar>

    <v-btn-toggle

    v-model="toggle_exclusive4"
    color="primary darken-5"
  >
    <v-btn>
      Pagadas
    </v-btn>

    <v-btn>
      Hojas de Entrega SF
    </v-btn>

    <v-btn>
      Facturas PDP
    </v-btn>


  </v-btn-toggle>

  <v-text-field
    v-model="search3"
    append-icon="mdi-magnify"
    label="Buscar"
    class="mb-5 pl-1 pr-1"
    single-line
    hide-details
  ></v-text-field>
  <v-data-table
  :items-per-page="1"

  :headers="hventas"
  :items="ventas"
  :search="search3"
></v-data-table>



      </v-card>
    </v-col>
    <v-col
      cols="12"
      md="6"
    >
    <v-card>

  <v-toolbar
    class="mb-2"
    color="primary darken-5"
    dark
    flat
  >
    <v-toolbar-title>
      Tipos de Venta
    </v-toolbar-title>
  </v-toolbar>

  <v-btn-toggle
  v-model="toggle_exclusive5"
  color="primary darken-5"
>
  <v-btn>
    Registrados
  </v-btn>


</v-btn-toggle>

<v-text-field
  v-model="search4"
  append-icon="mdi-magnify"
  label="Buscar"
  class="mb-5 pl-1 pr-1"
  single-line
  hide-details
></v-text-field>
<v-data-table
:items-per-page="1"

:headers="htiposventa"
:items="tiposventa"
:search="search4"
></v-data-table>



    </v-card>
  </v-col>
  <v-col
    cols="12"
    md="6"
  >
  <v-card>

<v-toolbar
  class="mb-2"
  color="primary darken-5"
  dark
  flat
>
  <v-toolbar-title>
    Formatos PDF
  </v-toolbar-title>
</v-toolbar>

<v-btn-toggle

v-model="toggle_exclusive"
color="primary darken-5"

>
<v-btn>
  Registrados
</v-btn>


</v-btn-toggle>

<v-text-field
v-model="search5"
append-icon="mdi-magnify"
label="Buscar"
class="mb-5 pl-1 pr-1"
single-line
hide-details
></v-text-field>
<v-data-table
:items-per-page="1"

:headers="hformatos"
:items="formatos"
:search="search5"
></v-data-table>



  </v-card>
</v-col>

        </v-row>
    </v-container>
</template>

<script>


  export default {

    data: () => ({
       toggle_exclusive: 0,
       toggle_exclusive2: 0,
       toggle_exclusive3: 0,
       toggle_exclusive4: 0,
       toggle_exclusive5: 0,
      tab: null,
      tab2:null,
      search: '',
      search1:'',
      search2:'',
      search3:'',
      search4:'',
      search5:'',
      hsolicitudes: [
        {
          text: 'Fecha de recepción',
          align: 'center',

          value: 'fecha',
        },
        { text: 'Folio asignado', align: 'center', value: 'folio' },
          { text: 'Responsable', align: 'center', value: 'responsable.name' },
        { text: 'Agente de Venta', align: 'center', value: 'agente.name' },
        { text: 'Con Atención a', align: 'center', value: 'cliente.razonSocial' },
        { text: 'Solicitante', align: 'center', value: 'solicitante.nombre' },
        { text: 'Acciones', align: 'center', value: 'acciones' },
      ],
      solicitudes: [],
      hcotizaciones: [
        {
          text: 'Folio',
          align: 'center',
          value: 'solicitud.folio',
        },
        { text: 'Fecha de Solicitud', align: 'center', value: 'solicitud.fecha' },
        { text: 'Fecha de Finalizado', align: 'center', value: 'fechafinalizado' },
        { text: 'Dirigido A(Cliente)', align: 'center', value: 'solicitud.cliente.razonSocial' },
        { text: 'Solicitante', align: 'center', value: 'solicitud.solicitante.nombre' },
        { text: 'Responsable', align: 'center', value: 'solicitud.responsable.name' },
        { text: 'Agente de venta', align: 'center', value: 'solicitud.agente.name' },
        { text: 'Acciones', align: 'center', value: 'acciones' },
      ],
      cotizaciones: [],
      hventas: [
        {
          text: 'Folio',
          align: 'center',
          value: 'solicitud.folio',
        },
        { text: 'Fecha de Solicitud', align: 'center', value: 'solicitud.fecha' },
        { text: 'Fecha de Finalizado', align: 'center', value: 'fechafinalizado' },
        { text: 'Dirigido A(Cliente)', align: 'center', value: 'solicitud.cliente.razonSocial' },
        { text: 'Solicitante', align: 'center', value: 'solicitud.solicitante.nombre' },
        { text: 'Responsable', align: 'center', value: 'solicitud.responsable.name' },
        { text: 'Agente de venta', align: 'center', value: 'solicitud.agente.name' },
        { text: 'Acciones', align: 'center', value: 'acciones' },
      ],
      ventas: [],
      htiposventa: [
        {
          text: 'Fecha de registro',
          align: 'center',

          value: 'created_at',
        },
        { text: 'Descripción', align: 'center', value: 'descripcion' },
          { text: 'Porcentaje %', align: 'center', value: 'porcentaje' },

        { text: 'Acciones', align: 'center', value: 'acciones' },
      ],
      tiposventa: [],
      hformatos:[],
      formatos:[],




    }),

    computed: {

    },
  }
</script>
