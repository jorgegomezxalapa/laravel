<template>
    <v-container fluid>
        <v-bottom-navigation :value="value"
    color="primary"
    horizontal>
    <v-btn  @click="mostrarTabla('ocliente')">
      <span>Cliente</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

    <v-btn  @click="mostrarTabla('osolicitante')">
      <span>Solicitante</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

    <v-btn  @click="mostrarTabla('omonto')">
      <span>Monto</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

      <v-btn  @click="mostrarTabla('ocampania')">
      <span>Campaña</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>

      <v-btn  @click="mostrarTabla('opersonalizada')">
      <span>Personalizada</span>

      <v-icon>mdi-history</v-icon>
    </v-btn>
  </v-bottom-navigation>
   
   <componente-clientes v-if="mostrarclientes"></componente-clientes>
   <componente-solicitantes v-if="mostrarsolicitantes"></componente-solicitantes>
   <componente-solicitudes v-if="mostrarPersonalizados"></componente-solicitudes>

      <v-card v-if="mostrarcampanias"
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Registro de Utilidades(Campaña)</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevaCampania"
            >
              Registrar Nueva Utilidad
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
      :headers="headers2"
      :items="desserts2"
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
        <v-btn
         v-bind="attrs"
          v-on="on"
               small
                color="primary"
                dark
                
                fab
              >
                <v-icon>mdi-information-outline</v-icon>
              </v-btn>
          </template>
          <span>Ver Información</span>
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

   <v-card v-if="mostrarMontos"
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Registro de Utilidades(Monto)</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevoMonto"
            >
              Registrar Nueva Utilidad
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
      :headers="headers3"
      :items="desserts3"
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
        <v-btn
         v-bind="attrs"
          v-on="on"
               small
                color="primary"
                dark
                
                fab
              >
                <v-icon>mdi-information-outline</v-icon>
              </v-btn>
          </template>
          <span>Ver Información</span>
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
        mostrarsolicitudes:false,
        mostrarsolicitantes:false,
        mostrarclientes:true,
        mostrarMontos:false,
        mostrarPersonalizados:false,
        mostrarcampanias:false,
        search: '',
        headers: [
          {
            text: 'Empresa',
            align: 'center',
           
            value: 'nombre',
          },
          { text: 'Representante', align: 'center', value: 'usuario' },
          { text: 'RFC', align: 'center', value: 'rol' },
          { text: '% Utilidad', align: 'center', value: 'areaTrabajo' },
          { text: 'Cotizaciones', align: 'center', value: 'cotizaciones' },
          { text: 'Ventas', align: 'center', value: 'ventas' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
        ],

        headers2: [
          {
            text: 'Nombre de la Campaña',
            align: 'center',
           
            value: 'item1',
          },
          { text: 'Fecha', align: 'center', value: 'item2' },
          { text: '% Utilidad', align: 'center', value: 'item3' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
         
        ],

        desserts2: [{
          item1: 'Descuento Verano 10%',
          item2: '12-06-2021',
          item3: '10%',
          item4: 'item',

        }],
         headers3: [
          {
            text: 'Nombre',
            align: 'center',
           
            value: 'item1',
          },
          { text: 'Fecha', align: 'center', value: 'item2' },
          { text: 'Cantidad a superar', align: 'center', value: 'item3' },
          { text: '% Utilidad', align: 'center', value: 'item4' },
          { text: 'Acciones', align: 'center', value: 'acciones' },
         
        ],
        desserts3: [{
          item1: 'Utilidad menor o igual a 1999',
          item2: '12-06-2021',
          item3: '$2000',
          item4: '10',

        },
        {
          item1: 'Utilidad menor o igual a 4999',
          item2: '12-06-2021',
          item3: '$5000',
          item4: '25',

        }],
        
        desserts: [
          {
            nombre: 'CFE',
            usuario: "JUAN VALDEZ",
            rol: "FADJFASDEQ1VS",
            areaTrabajo: 30,
            cotizaciones: 3,
            cotizaciones2: 10,
            cotizaciones3: 5,
            ventas:10,
            acciones: "Acciones",
          },
          
        ],
        ocliente:false,
        osolicitante:false,
        omonto:false,
        ocampania:false,
        opersonalizada:false,

      }
    },
     methods: {
        
        nuevoMonto(){
            this.$router.push({ name: 'nuevoMonto' }).catch(()=>{})
        },
        nuevaCampania(){
            this.$router.push({ name: 'nuevaCampania' }).catch(()=>{})
        },
        mostrarTabla(mostrar){
            if (mostrar == 'ocliente') {

                 this.mostrarclientes = true
                 this.mostrarsolicitantes = false
                 this.mostrarMontos = false
                 this.mostrarcampanias = false
                 this.mostrarPersonalizados = false
                  console.log(this.mostrarclientes, this.mostrarsolicitantes,this.mostrarMontos,this.mostrarcampanias,this.mostrarPersonalizados)
            }
            if (mostrar == 'osolicitante') {

              this.mostrarclientes = false
                 this.mostrarsolicitantes = true
                 this.mostrarPersonalizados = false
                 this.mostrarcampanias = false
                 this.mostrarPersonalizados = false
                  console.log(this.mostrarclientes, this.mostrarsolicitantes,this.mostrarMontos,this.mostrarcampanias,this.mostrarPersonalizados)
            }
            if (mostrar == 'omonto') {

                this.mostrarclientes = false
                 this.mostrarsolicitantes = false
                 this.mostrarMontos = true
                 this.mostrarcampanias = false
                 this.mostrarPersonalizados = false
                  console.log(this.mostrarclientes, this.mostrarsolicitantes,this.mostrarMontos,this.mostrarcampanias,this.mostrarPersonalizados)
            }
            if (mostrar == 'ocampania') {

               this.mostrarclientes = false
                 this.mostrarsolicitantes = false
                 this.mostrarMontos = false
                 this.mostrarcampanias = true
                 this.mostrarPersonalizados = false
                  console.log(this.mostrarclientes, this.mostrarsolicitantes,this.mostrarMontos,this.mostrarcampanias,this.mostrarPersonalizados)
            }
            if (mostrar == 'opersonalizada') {

               this.mostrarclientes = false
                 this.mostrarsolicitantes = false
                 this.mostrarMontos = false
                 this.mostrarcampanias = false
                 this.mostrarPersonalizados = true
                  console.log(this.mostrarclientes, this.mostrarsolicitantes,this.mostrarMontos,this.mostrarcampanias,this.mostrarPersonalizados)
            }
        }
     },
  }
</script>
