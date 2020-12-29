<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Registrar Nueva Solicitud</v-card-title>
    
<v-divider></v-divider>
  <v-card-text class="d-flex justify-center">
    
    <v-row>
      <v-col
        cols="12"
      
        md="6"
      >
        <p class="font-weight-black">Atributos de la Solicitud</p>
        <v-form
   
  >
    <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        :return-value.sync="date"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="date"
            label="Fecha de Solicitud"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
        locale="es-419"
          v-model="date"
          no-title
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="primary"
            @click="menu = false"
          >
            Cancel
          </v-btn>
          <v-btn
            text
            color="primary"
            @click="$refs.menu.save(date)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-menu>

    <v-text-field
      v-model="folio"
      
      label="Folio Interno"
      required
    ></v-text-field>

    
  
  </v-form>
      </v-col>
      <v-col
        cols="12"
        md="6"
      >
       <p class="font-weight-black">Información del Cliente</p>
       <v-form
  
  >
<v-select
      v-model="cliente"
      :items="catclientes"
      label="Seleccione un Cliente"
      required
    ></v-select>


<v-select
      v-model="solicitante"
      :items="catsolicitantes"
      label="Seleccione un Solicitante"
      required
    ></v-select>
  

    
  </v-form>
      </v-col>

      <v-col cols="12">
        <v-divider></v-divider>
         <p class="font-weight-black">Configuración de la solicitud</p>
          <v-row>
           <v-col cols="12"
           md="6">
           <v-select
      v-model="responsable"
      :items="empleados"
      label="Empleado Responsable"
      required
    ></v-select>

      </v-col>
      <v-col cols="12"
      md="6">
          <v-select
      v-model="utilidad"
      :items="catutilidades"
      label="Margen de utilidad"
      required
    ></v-select>
      </v-col>
      <v-col cols="12"
     >
          <v-text-field
      v-model="utilidadpersonalizada"
      
      label="Ingrese la utilidad personalizada"
      required
    ></v-text-field>
      </v-col>
      <v-col cols="12"
      md="6">
          <v-select
     v-model="replicas"
      :items="catreplicas"
      label="Desea agregar réplicas?"
      required
    ></v-select>
      </v-col>
      <v-col cols="12"
      md="6">
          <v-select
            v-model="notificar"
            :items="catemails"
            attach
            chips
            label="Notificar Atención por Correo Electrónico?"
            multiple
          ></v-select>
      </v-col>    
          </v-row>
      </v-col>
      
          <v-col cols="12"
     >
     <v-divider></v-divider>
         <p class="font-weight-black">Comentarios</p>
          <v-textarea
          solo
          name="comentarios"
          label="Ingresa Aquí tus Comentarios"
        ></v-textarea>
      </v-col>
    </v-row>



 
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
        <v-row>
            <v-col>
               <v-btn
               cols="6"
               block
      color="primary"
     
    >
      Registrar Solicitud
    </v-btn> 
            </v-col>
        </v-row>
        

    

    
    </v-card-actions>
  </v-card>
    </v-container>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: () => ({ 
           
             date: new Date().toISOString().substr(0, 10),
              menu: false,
            folio:null,
            cliente:null,
            solicitante:null,
            responsable:null,
            utilidad:null,
            utilidadpersonalizada:null, 
            notificar:null,
            replicas:null,
            empleados:['Cotizador 1(Ana)', 'Cotizador 2(José Luis)','Cotizador 4(Juan G)', 'Administrador 1(Diego H)', 'Administrador 2(Fabiola)'],
            catutilidades:['Utilidad por cliente','Utilidad por Precio Total', 'Personalizada'],
            catclientes:['CMAS', 'CFE XALAPA','CFE COATEPEC', 'FGE', 'Dulcería Xalapa'],
            catsolicitantes:['El Propio Cliente','Juan Pablo ', 'Isabela Castillo'],
            catemails:['Sin Notificar','Cliente','Solicitante', 'Administración'],
            catreplicas:[0,1,2,3,4,5],
         }),
    
    }
</script>
