<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">MÓDULO DE EMPLEADOS</v-card-title>

<v-divider></v-divider>
  <v-card-text>
    <v-row>
        <v-col cols="12" md="4">
            <v-btn
              color="primary"
              dark
             @click="nuevoEmpleado"
            >
              REGISTRAR NUEVO EMPLEADO
              <v-icon
        right
        dark
      >
        mdi-account-plus
      </v-icon>
            </v-btn>
        </v-col>
        <v-col cols="12" md="8">
            <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="BUSCAR DATOS POR COLUMNA"
        single-line
        hide-details
      ></v-text-field>
        </v-col>
    </v-row>

    <v-row>
       <v-col cols="12">
          <v-data-table
      :headers="headers"
      :items="usuarios"
      :search="search"
      :items-per-page="5"
    >


    <template v-slot:item.acciones="{ item }">
        
      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarEmpleado', params:{id:item.id}}">
          <v-btn
      v-bind="attrs"
          v-on="on"
      class="ma-2 blue--text"
      fab
        
        
    >
      <v-icon dark>mdi-pencil-box-outline</v-icon>
    </v-btn>
            </router-link>
          </template>
          <span>EDITAR DATOS DEL EMPLEADO</span>
      </v-tooltip>
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <v-btn
      v-bind="attrs"
          v-on="on"
      class="ma-2 red--text"
      fab
        @click="eliminarEmpleado(item)"
        
    >
      <v-icon dark>
        mdi-delete
      </v-icon>
    </v-btn>
        
          </template>
          <span>ELIMINAR EMPLEADO</span>
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
  const axios = require('axios');
  import swal from 'sweetalert';
    export default {
    data () {
      return {
        ideliminar:null,
        search: '',
        headers: [
        { text: 'FECHA DE REGISTRO', align: 'center', value: 'created_at' },
          {
            text: 'NOMBRE COMPLETO',
            align: 'center',

            value: 'name',
          },
          { text: 'USUARIO', align: 'center', value: 'userName' },
          { text: 'ROL ASIGNADO', align: 'center', value: 'rol' },

        
          { text: 'ACCIONES DISPONIBLES', align: 'center', value: 'acciones' },
        ],
        usuarios: [],
      }
    },
     mounted(){
  this.getUsuarios()

  },
     methods: {
        nuevoEmpleado(){
            this.$router.push({ name: 'nuevoEmpleado' }).catch(()=>{});
        },
        eliminarEmpleado(empleado){
          this.ideliminar = empleado.id
          console.log(empleado)
          swal("¿DESEA ELIMINAR AL USUARIO "+empleado.userName+"?", {
buttons: {
  cancel: "CANCELAR",
  catch: {
    text: "ELIMINAR",
    value: "eliminar",
  },

},
 icon: "warning",
})
.then((value) => {
switch (value) {

  case "eliminar":
  this.hacereliminar()
    break;

  default:

}
});
        },
        async getUsuarios(){
          try {
                const response = await axios({
                  method: 'get',
                  url: 'getUsuarios',
                })

                this.usuarios = response.data.response
                console.log(this.usuarios)


            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "Por favor recarga la página", "error");
                console.log(error);

            }

        },
        async hacereliminar(){
          try {
                const response = await axios({
                  method: 'post',
                  url: 'deleteUser',
                  data: {
                    id: this.ideliminar,
                  }
                })

                this.getUsuarios()
                swal("ÉXITO", "EL USUARIO HA SIDO ELIMINADO", "success");

            } catch (error) {

               swal("OCURRIÓ UN ERROR DE SERVIDOR", "POR FAVOR RECARGA LA PÁGINA", "error");
                console.log(error);

            }
        },
     },
  }
</script>
