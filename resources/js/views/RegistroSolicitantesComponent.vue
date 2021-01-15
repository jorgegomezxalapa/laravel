<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Nuevo Solicitante</v-card-title>
   
<v-divider></v-divider>
  <v-card-text>
    
    
   
    <v-container>
      <p class="font-weight-black">Información del Solicitante</p>
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
          <v-text-field
      v-model="razonSocial"
      label="Nombre del solicitante"
      required
    ></v-text-field>
        </v-col>

        

        

        

        <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="giro"
      
      label="Giro Comercial"
      required
    ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="giro"
      
      label="RFC"
      required
    ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="giro"
      
      label="Correo Electrónico"
      required
    ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="giro"
      
      label="Teléfono"
      required
    ></v-text-field>
        </v-col>
       
      </v-row>
      <p class="font-weight-black mt-5">Configuración para cotizaciones</p>
      <v-row>
        <v-col
          cols="12"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Porcentaje de utilidad"
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
         }),
    
    }
</script>
