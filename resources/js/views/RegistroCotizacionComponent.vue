<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Cotizar Folio XAF/F1/1/2021(Ver Detalle)</v-card-title>
   
<v-divider></v-divider>
  <v-card-text>
    
    
   
    <v-container>
      <p class="font-weight-black">Datos del producto</p>
      <v-row>
        <v-col
          cols="4"
          md="4"
        >
          <v-text-field
      v-model="razonSocial"
      label="Partida"
      required
    ></v-text-field>
        </v-col>
        <v-col
          cols="8"
          md="8"
        >
          <v-text-field
      v-model="razonSocial"
      label="Descripción"
      required
    ></v-text-field>
        </v-col>

        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Unidad de Medida"
      required
    ></v-text-field>
        </v-col>

        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Cantidad"
      required
    ></v-text-field>
        </v-col>
        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Precio del provedor"
      required
    ></v-text-field>
        </v-col>
        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Importe"
      required
    ></v-text-field>
        </v-col>
        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Utilidad"
      required
    ></v-text-field>
        </v-col>
        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Precio Unitario"
      required
    ></v-text-field>
        </v-col>
        <br>

        <v-col
          cols="6"
          md="6"
        >
         <v-checkbox
          v-model="includeFiles"
          hide-details
          class="shrink mr-2 mt-0"
        ></v-checkbox>¿Incluye IVA?
        <v-text-field label="Ingrese IVA variable"></v-text-field>
        </v-col>

        <v-col
          cols="6"
          md="6"
        >
       <v-checkbox
          v-model="includeFiles"
          hide-details
          class="shrink mr-2 mt-0"
        ></v-checkbox>¿Incluye IEPS?
        <v-text-field label="Ingrese IEPS variable"></v-text-field>
        </v-col>


       
      </v-row>
      <p class="font-weight-black mt-5">Detalle general</p>
      <v-row>
        <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="Subtotal"
      required
    ></v-text-field>
        </v-col>

         <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="IVA"
      required
    ></v-text-field>
        </v-col>

         <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="IEPS"
      required
    ></v-text-field>
        </v-col>
         <v-col
          cols="6"
          md="6"
        >
          <v-text-field
      v-model="razonSocial"
      label="TOTAL"
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
