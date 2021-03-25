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
    <v-card-title class="font-weight-black">INFORMACIÓN DEL EMPLEADO</v-card-title>

<v-divider></v-divider>
<v-row>
       <v-col
        cols="12"
      >
      <p><strong>FORMULARIO DE EMPLEADO, LOS CAMPOS MARCADOS CON UN ASTERISCTO (*) SON REQUERIDOS PARA CONTINUAR.</strong></p>
    </v-col>
    </v-row>
  <v-card-text class="d-flex justify-center">


    <v-row>
      <v-col
        cols="12"

        md="6"
      >
        <p class="font-weight-black">Información del Empleado</p>
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


    <v-text-field
      v-model="email"

      label="Email de Usuario"
      @blur="compararEmail"
    ></v-text-field>



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
     v-if="!editar"
        v-slot="{ errors }"
        name="Contraseña"
        rules="required"
      >

    <v-text-field
    v-if="!editar"
      v-model="password"
     :error-messages="errors"

      label="Contraseña(Mínimo 8 caracteres) *"

    ></v-text-field>


  </validation-provider>
  <v-row v-if="editar" align="center">
       <label class="mr-3">¿Actualizar contraseña?</label>
        <v-checkbox
          v-model="checkbox"
        ></v-checkbox>
      </v-row>
      <validation-provider
        v-if="checkbox"
        v-slot="{ errors }"
        name="Contraseña"
        rules="required"
      >
      <v-text-field
      v-if="checkbox"
        v-model="password"
       :error-messages="errors"
       :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
      @click:append="show1 = !show1"
        label="Contraseña(Mínimo 8 caracteres) *"
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
      cols="12"
      block
     v-if="editar"
       type="submit"

    >
      Editar
    </v-btn>



               <v-btn
               cols="12"
               block
      color="primary"
     type="submit"
     v-if="!editar"
    >
      REGISTRAR EMPLEADO
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

            this.verificar()
        },
        watch: {
    checkbox: function (val) {
      if (val == false) {
        this.password = null
      }
    },

  },
        data: () => ({
          idusuario:0,
           editar:false,
           checkbox:false,
           show1:false,
           usuario:[],
            userName:null,
            email:null,
            rol:null,
            name:null,
            telefono:null,
            password:null,
            sexo:null,
            catroles:['ADMINISTRADOR', 'COTIZADOR', 'ALMACÉN'],
         }),
         methods: {
          async verificar(){
             if (this.$route.params.id != undefined) {
                this.editar = true
                this.getEditar()
            }else{

            }
          },
          async getEditar(){
            try {
                const response = await axios({
                  method: 'post',
                  url: 'getUsuario',
                  data: {
                    id: this.$route.params.id,
                  }
                })

              this.usuario = response.data
              this.usuario = this.usuario.response
              this.userName = this.usuario.userName
              this.email = this.usuario.email
              this.rol = this.usuario.rol
              this.name = this.usuario.name
              this.telefono = this.usuario.telefono
              this.password = this.usuario.password
              this.sexo = this.usuario.sexo


            } catch (error) {
               swal("ERROR", "HA OCURRIDO UN ERROR EN EL SERVIDOR", "warning");

                console.log(error);

            }

          },
          async submit (evt) {

        evt.preventDefault();
        const result = await this.$refs.observer.validate()

        if (result) {
          if (this.editar == true ) {
            this.editarUsuario()
          }else{
            this.registrar()
          }

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
               swal("ÉXITO", "EL USUARIO "+this.userName+ " SE HA REGISTRADO DE MANERA EXITOSA", "success");
               this.$router.push({ name: 'empleados' });

            } catch (error) {
                // Error 😨
                if (error.response) {
                  if (error.response.status == 500) {
                    swal("ERROR", "EL EMAIL/NOMBRE DE USAURIO SE ENCUENTRA OCUPADO POR OTRO EMPLEADO", "warning");
                  }

                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);

                } else if (error.request) {

                    swal("ERROR", "HA OCURRIDO UN ERROR DE CONEXIÓN", "warning");
                    console.log("console.log 5",error.request);
                } else {
                    swal("Eror!", "Ha ocurrido un error interno!", "warning");

                    console.log("console.log 6", error.message);
                }
                console.log(error);

            }

          },
          async editarUsuario(){

            try {
                const response = await axios({
                  method: 'post',
                  url: 'editUser',
                  data: {
                    id:this.usuario.id,
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
               swal("ÉXITO", this.userName+" SE HA ACTUALIZADO DE MANERA EXITOSA", "success");
               this.$router.push({ name: 'empleados' });

            } catch (error) {
                // Error 😨
                if (error.response) {
                  if (error.response.status == 500) {
                    swal("Error", "EL EMAIL/NOMBRE DE USUARIO YA ESTÁ OCUPADO POR OTRO EMPLEADO", "warning");
                  }

                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);

                } else if (error.request) {

                    swal("Error", "HA OCURRIDO UN ERROR DE CONEXIÓN", "warning");
                    console.log("console.log 5",error.request);
                } else {
                    swal("ERROR!", "HA OCURRIDO UN ERROR DE SERVIDOR", "warning");

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
                    idusuario:this.usuario.id
                  }
                })

               if (response.data == 1) {
                swal("ERROR", this.email+" YA ESTÁ OCUPADO POR OTRO EMPLEADO", "warning")
                this.email = null
               }

            } catch (error) {
               swal("Error", "HA OCURRIDO UN ERROR EN EL SERVIDOR", "warning");

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
                    idusuario:this.usuario.id
                  }
                })

               if (response.data == 1) {
                swal("Error", this.userName+" YA ESTÁ OCUPADO POR OTRO EMPLEADO", "warning")
                this.userName = null
               }

            } catch (error) {
               swal("Error", "HA OCURRIDO UN ERROR EN EL SERVIDOR", "warning");

                console.log(error);

            }

          },

         },

    }
</script>
