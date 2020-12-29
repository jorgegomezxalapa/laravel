<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Registro de Empleados</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevoEmpleado"
            >
              Registrar Nuevo Empleado
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
                <v-icon>mdi-folder-multiple-outline</v-icon>
              </v-btn>
          </template>
          <span>Ver Detalle</span>
      </v-tooltip>
     
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
                <v-icon>mdi-pencil-box-outline</v-icon>
              </v-btn>
          </template>
          <span>Editar Usuario</span>
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
            text: 'Nombre Completo',
            align: 'center',
           
            value: 'nombre',
          },
          { text: 'Usuario', align: 'center', value: 'usuario' },
          { text: 'Rol', align: 'center', value: 'rol' },
          { text: 'Área de Trabajo', align: 'center', value: 'areaTrabajo' },
          { text: 'Cotizaciones', align: 'center', value: 'cotizaciones' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
        ],
        desserts: [
          {
            nombre: 'Jonh Doe',
            usuario: "Cotizador1",
            rol: "Cotizador",
            areaTrabajo: "Cotizaciones",
            cotizaciones: 3,
            cotizaciones2: 10,
            cotizaciones3: 5,
            acciones: "Acciones",
          },
          
        ],
      }
    },
     methods: {
        nuevoEmpleado(){
            this.$router.push({ name: 'nuevoEmpleado' }).catch(()=>{});
        }
     },
  }
</script>
