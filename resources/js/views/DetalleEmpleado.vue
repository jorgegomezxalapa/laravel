<template>
    <v-container fluid>
      <v-card
        class="mx-auto rounded-lg py-5 px-2 mt-5 mb-5"
        width="100%"
        align="center"
        justify="space-around"

      >
    <v-card-title class="font-weight-black"></v-card-title>
<v-divider></v-divider>
  <v-card-text class="d-flex justify-center">

Soy el detalle del empleado

    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>

    </v-card-actions>
  </v-card>
    </v-container>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
