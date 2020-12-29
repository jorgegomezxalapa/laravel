<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Nuevo Empleado</v-card-title>
    <v-card-title class="font-weight-black" hidden="true">Información de Empleado</v-card-title>
<v-divider></v-divider>
  <v-card-text class="d-flex justify-center">
    
    <v-row>
      <v-col
        cols="12"
      
        md="6"
      >
        <p class="font-weight-black">Atributos del Usuario</p>
        <v-form
   
  >
    <v-text-field
      v-model="nombreUsuario"
      label="Nombre de Usuario"
      required
    ></v-text-field>

    <v-text-field
      v-model="email"
      
      label="Correo de Usuario"
      required
    ></v-text-field>

    

    <v-select
      v-model="rol"
      :items="catroles"
      label="Rol de Usuario"
      required
    ></v-select>

     <v-select
      v-model="areatrabajo"
      :items="catareas"
      label="Área de Trabajo"
      required
    ></v-select>

  
  </v-form>
      </v-col>
      <v-col
        cols="12"
        md="6"
      >
       <p class="font-weight-black">Información Personal</p>
       <v-form
  
  >
    <v-text-field
      v-model="nombreCompleto"
     
     
      label="Nombre Completo"
      required
    ></v-text-field>

    <v-text-field
      v-model="telefono"
     
      label="Teléfono"
      required
    ></v-text-field>

    <v-text-field
      v-model="password"
     
      label="Contraseña"
      required
    ></v-text-field>

<label>Seleccionar Sexo</label>
<v-card
      class="d-flex justify-center mb-6"
     
      flat
      tile
    >
      <v-radio-group
      v-model="sexo"
      row
    >
      <v-radio
        label="Masculino"
        value="masc"
      ></v-radio>
      <v-radio
        label="Femenino"
        value="fem"
      ></v-radio>
    </v-radio-group>
    </v-card>
  

    
  </v-form>
      </v-col>
    </v-row>

 
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
