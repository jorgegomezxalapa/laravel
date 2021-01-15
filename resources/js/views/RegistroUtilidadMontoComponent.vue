<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Nueva Regla de Utilidad(Monto)</v-card-title>
   
<v-divider></v-divider>
  <v-card-text>
    
    
   
    <v-container>
      <p class="font-weight-black">Información de la regla</p>
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
          <v-text-field
      v-model="razonSocial"
      label="Nombre del regla de utilidad"
      required
    ></v-text-field>
        </v-col>

        

        

        

        <v-col
          cols="12"
          md="6"
        >
        <v-text-field
      v-model="giro"
      
      label="Cantidad a superar"
      required
    ></v-text-field>

        </v-col>

        <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="giro"
      
      label="Porcentaje de Utilidad"
      required
    ></v-text-field>
        </v-col>

       

        
       
      </v-row>
     
    </v-container>



 
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
        <v-row>
            <v-col>
                <v-btn
      
      color="warning"
      cols="6"
      block
      
    >
      Editar
    </v-btn>
            </v-col>
            <v-col>
                <v-btn
      color="error"
      cols="6"
      block
      
    >
     Eliminar
    </v-btn>
            </v-col>
            <v-col>
               <v-btn
               cols="6"
               block
      color="primary"
     
    >
      Registrar
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
            selectedItem: 7,
            nombreUsuario:null,
            email:null,
            rol:null,
            areatrabajo:null,
            nombreCompleto:null,
            telefono:null,
            password:null,
            sexo:null,
            catareas:['ADMINISTRACIÓN', 'COTIZACIONES', 'VENTAS'],
            catroles:['ADMINISTRADOR', 'COTIZADOR'],
             catclientes:['Utilidad por Campaña', 'Utilidad por Monto Total'],
         }),
    
    }
</script>
