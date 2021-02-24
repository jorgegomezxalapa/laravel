<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"


      >
    <v-card-title class="font-weight-black">Módulo de Empleados</v-card-title>

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
      :items="usuarios"
      :search="search"
    >


    <template v-slot:item.acciones="{ item }">
        <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
           <router-link :to="{name: 'detalleEmpleado', params:{id:item.id}}">
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
            </router-link>
          </template>
          <span>Ver Detalle</span>
      </v-tooltip>

      <v-tooltip top>
      <template v-slot:activator="{ on, attrs }">
         <router-link :to="{name: 'editarEmpleado', params:{id:item.id}}">
      <v-btn
       v-bind="attrs"
          v-on="on"
               small
                color="warning"
                dark

                fab
              >
                <v-icon>mdi-pencil-box-outline</v-icon>
              </v-btn>
            </router-link>
          </template>
          <span>Editar Empleado</span>
      </v-tooltip>
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
        <v-btn
         v-bind="attrs"
          v-on="on"
               small
                color="danger"
                dark
                fab
                @click="eliminarEmpleado(item)"
              >
                <v-icon>mdi-delete</v-icon>
              </v-btn>
          </template>
          <span>Eliminar Empleado</span>
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
          {
            text: 'Nombre Completo',
            align: 'center',

            value: 'name',
          },
          { text: 'Usuario', align: 'center', value: 'userName' },
          { text: 'Rol', align: 'center', value: 'rol' },

        
          { text: 'Acciones', align: 'center', value: 'acciones' },
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
          swal(empleado.userName+" será eliminado, desea continuar?", {
buttons: {
  cancel: "Cancelar",
  catch: {
    text: "Eliminar",
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

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
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
                swal("Éxito", "El empleado se ha eliminado", "success");

            } catch (error) {

               swal("Ocurrió un error de servidor", "Por favor recarga la página", "error");
                console.log(error);

            }
        },
     },
  }
</script>
