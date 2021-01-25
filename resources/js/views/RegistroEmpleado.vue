<template>
    <v-container fluid>

      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
      <validation-observer
    ref="observer"
    v-slot="{ invalid }"
  >
   <form @submit.prevent="submit">
    <v-card-title class="font-weight-black">Nuevo Empleado</v-card-title>
    <v-card-title class="font-weight-black" hidden="true">Información de Empleado</v-card-title>
<v-divider></v-divider>
<v-row>
       <v-col
        cols="12"
      >
      <p><strong>Por favor complete el formulario, los campos marcados con un asterisco (*) son obligatorios </strong></p>
    </v-col>
    </v-row>
  <v-card-text class="d-flex justify-center">


    <v-row>
      <v-col
        cols="12"
      
        md="6"
      >
        <p class="font-weight-black">Atributos del Usuario</p>
       <validation-provider
        v-slot="{ errors }"
        name="Nombre de Usuario"
        rules="required"
      >
    <v-text-field
      v-model="userName"
      label="Nombre de Usuario *"
       :error-messages="errors"
      @blur="compararUsuario"
    ></v-text-field>
  </validation-provider>
  <validation-provider
        v-slot="{ errors }"
        name="Email de Usuario"
        rules="required"
      >

    <v-text-field
      v-model="email"
      :error-messages="errors"
      label="Email de Usuario*"
      @blur="compararEmail"
    ></v-text-field>
  </validation-provider>

    
<validation-provider
        v-slot="{ errors }"
        name="Rol de Usuario"
        rules="required"
      >
    <v-select
      v-model="rol"
      :items="catroles"
      label="Rol de Usuario *"
      :error-messages="errors"
    ></v-select>
  </validation-provider>

   
  

      </v-col>
      <v-col
        cols="12"
        md="6"
      >
       <p class="font-weight-black">Información Personal</p>
      <validation-provider
        v-slot="{ errors }"
        name="Nombre Completo"
        rules="required"
      >
    <v-text-field
      v-model="name"
     :error-messages="errors"
      label="Nombre Completo *"
      
    ></v-text-field>
  </validation-provider>

    <v-text-field
      v-model="telefono"
     
      label="Teléfono"
      
    ></v-text-field>
     <validation-provider
        v-slot="{ errors }"
        name="Contraseña"
        rules="required"
      >

    <v-text-field
      v-model="password"
     :error-messages="errors"
      label="Contraseña *"
      
    ></v-text-field>
  </validation-provider>

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
     type="submit"
     
    >
      Registrar
    </v-btn> 
            </v-col>
        </v-row>
        

    

    
    </v-card-actions>
  </form>
</validation-observer>
  </v-card>
    </v-container>
</template>

<script>
    const axios = require('axios');
    import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  import swal from 'sweetalert';

  setInteractionMode('eager')
  extend('digits', {
    ...digits,
    message: '{_field_} needs to be {length} digits. ({_value_})',
  })
  extend('required', {
    ...required,
    message: '{_field_} no puede quedarse vacío',
  })
  extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
  })
  extend('regex', {
    ...regex,
    message: '{_field_} {_value_} does not match {regex}',
  })
  extend('email', {
    ...email,
    message: 'El formato de email debe ser válido',
  })

    export default {
      components: {
      ValidationProvider,
      ValidationObserver,
    },
        mounted() {
            console.log('Component mounted.')
        },
        data: () => ({ 
            selectedItem: 7,
            userName:null,
            email:null,
            rol:null,
            name:null,
            telefono:null,
            password:null,
            sexo:null,
            catroles:['ADMINISTRADOR', 'COTIZADOR'],
         }),
         methods: {
          async submit (evt) {

      
        evt.preventDefault();
        const result = await this.$refs.observer.validate()
        if (result) {
         this.registrar()
        }
      },
          async registrar(){

            try {
                const response = await axios({
                  method: 'post',
                  url: 'createUser',
                  data: {
                    userName: this.userName,
                    email: this.email,
                    rol: this.rol,
                    name: this.name,
                    telefono: this.telefono,
                    password: this.password,
                    sexo: this.sexo,

                  }
                })
               //correcto
               swal("Éxito", "El empleado se ha registrado de manera correcta", "success");
               this.$router.push({ name: 'empleados' });
               
            } catch (error) {
                // Error 😨
                if (error.response) {
                  if (error.response.status == 500) {
                    swal("Error", "El email o nombre de usuario ya existe en la base de datos", "warning");
                  }
                  
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    
                } else if (error.request) {

                    swal("Error", "Ha ocurrido un error de conexión!", "warning");
                    console.log("console.log 5",error.request);
                } else {
                    swal("Eror!", "Ha ocurrido un error interno!", "warning");
                   
                    console.log("console.log 6", error.message);
                }
                console.log(error);
                
            }

          },
          async compararEmail(){

            try {
                const response = await axios({
                  method: 'post',
                  url: 'compararEmail',
                  data: {
                    email: this.email,
                  }
                })
               
               if (response.data == 1) {
                swal("Error", this.email+" ya existe registrado en la base de datos", "warning")
                this.email = null
               }
               
            } catch (error) {
               swal("Error", "Ha ocurrido un error en el servidor", "warning");
                
                console.log(error);
                
            }
           

          },
          async compararUsuario(){
            try {
                const response = await axios({
                  method: 'post',
                  url: 'compararUsuario',
                  data: {
                    userName: this.userName,
                  }
                })
               
               if (response.data == 1) {
                swal("Error", this.userName+" ya existe registrado en la base de datos", "warning")
                this.userName = null
               }
               
            } catch (error) {
               swal("Error", "Ha ocurrido un error en el servidor", "warning");
                
                console.log(error);
                
            }
           
          },

         },
    
    }
</script>
