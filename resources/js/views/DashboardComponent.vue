<template>
  <div class="container-fluid mt-5 pl-5 pr-5">
    <h5 class="font-weight-black">DASHBOARD</h5>
    <hr>
    <v-row>
      <v-col
        cols="12"
      >
      <v-chip
      class="ma-2"
     color="primary"
      @click="todo()"
    >
      MOSTRAR TODOS

    </v-chip>
        <v-chip
      class="ma-2"
     v-bind:color="resumen === true ? 'primary' : 'secondary'"
      @click="chipresumen()"
    >
      RESUMEN

    </v-chip>
    <v-chip
      class="ma-2"
     v-bind:color="cliente === true ? 'primary' : 'secondary'"
      @click="chipcliente()"
    >
      CLIENTES

    </v-chip>
    <v-chip
      class="ma-2"
     v-bind:color="solicitante === true ? 'primary' : 'secondary'"
      @click="chipsolicitante()"
    >
      SOLICITANTES  

    </v-chip>
    <v-chip
      class="ma-2"
     v-bind:color="empleado === true ? 'primary' : 'secondary'"
      @click="chipempleado()"
    >
      EMPLEADOS  

    </v-chip>
    <v-chip
      class="ma-2"
     v-bind:color="razonsocial === true ? 'primary' : 'secondary'"
      @click="chiprazonsocial()"
    >
      RAZÓN SOCIAL  

    </v-chip>
   
   

      </v-col>
    </v-row>
      <v-col v-if="resumen"
        cols="12"
      >
        <dashboard-resumen></dashboard-resumen>
      </v-col>
    </v-row>
    <v-row>
      <v-col
      v-if="cliente"
        cols="12"
        md="6"
      >
        <dashboard-cliente></dashboard-cliente>
      </v-col>
      <v-col
      v-if="solicitante"
        cols="12"
        md="6"
      >
        <dashboard-solicitante></dashboard-solicitante>
      </v-col>
       <v-col
      v-if="empleado"
        cols="12"
        md="6"
      >
        <dashboard-empleado></dashboard-empleado>
      </v-col>
      <v-col
      v-if="razonsocial"
        cols="12"
        md="6"
      >
        <dashboard-razonsocial></dashboard-razonsocial>
      </v-col>
    </v-row>
  </div>
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
         data: () => ({
        resumen:true,
        cliente:true,
        solicitante:true,
        empleado:true,
        razonsocial:true,

       }),
          methods: {
            todo(){
        this.resumen = true
        this.cliente = true
        this.solicitante = true
        this.empleado=true
        this.razonsocial = true
        },
      chipresumen(){
        this.resumen = !this.resumen
        },
        chipcliente(){
        this.cliente = !this.cliente
        },
         chipsolicitante(){
        this.solicitante = !this.solicitante
        },
        chipempleado(){
        this.empleado = !this.empleado
        },
        chiprazonsocial(){
        this.razonsocial = !this.razonsocial
        },
        
      },
    }
</script>
