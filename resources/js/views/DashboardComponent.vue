<template>
    <div class="container">
      <cards-dashboard></cards-dashboard>
      <br>
      <tables-dashboard></tables-dashboard>
        <!-- <div class="row justify-content-center">
          <v-row>
        <v-col
      cols="12"
      md="4"
    >
      <v-hover
        v-slot="{ hover }"
        close-delay="200"
      >
        <v-card
          :elevation="hover ? 16 : 2"
          :class="{ 'on-hover': hover }"
        >
        <v-card-title class="font-weight-black">Solicitudes</v-card-title>
        <v-card-text  class="d-flex justify-center">
          <v-row>
            <v-col>
              <v-chip
              class="ma-2"
              color="success"
              outlined
            >
              <v-icon left>
                mdi-server-plus
              </v-icon>
              0 Recibidas
            </v-chip>






            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        @click="reserve"
      >
        Reserve
      </v-btn>
    </v-card-actions>
        </v-card>
      </v-hover>
    </v-col>
    <v-col
  cols="12"
  md="4"
>
  <v-hover
    v-slot="{ hover }"
    close-delay="200"
  >
    <v-card
      :elevation="hover ? 16 : 2"
      :class="{ 'on-hover': hover }"
    >
      <v-card-title class="font-weight-black">Cotizaciones en Sistema</v-card-title>


    <v-card-text  class="d-flex justify-center">

    <v-row>
      <v-col>
        <v-chip
        class="ma-2"
        color="success"
        outlined
      >
        <v-icon left>
          mdi-server-plus
        </v-icon>
        Server Status
      </v-chip>

      <v-chip
        class="ma-2"
        color="primary"
        outlined
        pill
      >
        User Account
        <v-icon right>
          mdi-account-outline
        </v-icon>
      </v-chip>

      <v-chip
        class="ma-2"
        color="deep-purple accent-4"
        outlined
      >
        <v-icon left>
          mdi-wrench
        </v-icon>
        Update Settings
      </v-chip>

      <v-chip
        class="ma-2"
        close
        color="indigo darken-3"
        outlined
      >
        <v-icon left>
          mdi-fire
        </v-icon>
        New Posts Available
      </v-chip>
      </v-col>
    </v-row>

    </v-card-text>
    <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        @click="reserve"
      >
        Reserve
      </v-btn>
    </v-card-actions>
    </v-card>
  </v-hover>
</v-col>
    <v-col
      cols="12"
      md="4"
    >
      <v-hover
        v-slot="{ hover }"
        close-delay="200"
      >
        <v-card
          :elevation="hover ? 16 : 2"
          :class="{ 'on-hover': hover }"
        >
          <v-card-title class="font-weight-black">Ventas</v-card-title>


          <v-card-text  class="d-flex justify-center">
            <v-row>
              <v-col>
                <v-chip
                class="ma-2"
                color="success"
                outlined
              >
                <v-icon left>
                  mdi-server-plus
                </v-icon>
                Server Status
              </v-chip>

              <v-chip
                class="ma-2"
                color="primary"
                outlined
                pill
              >
                User Account
                <v-icon right>
                  mdi-account-outline
                </v-icon>
              </v-chip>

              <v-chip
                class="ma-2"
                color="deep-purple accent-4"
                outlined
              >
                <v-icon left>
                  mdi-wrench
                </v-icon>
                Update Settings
              </v-chip>

              <v-chip
                class="ma-2"
                close
                color="indigo darken-3"
                outlined
              >
                <v-icon left>
                  mdi-fire
                </v-icon>
                New Posts Available
              </v-chip>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
      <v-btn
        color="deep-purple lighten-2"
        text
        @click="reserve"
      >
        Reserve
      </v-btn>
    </v-card-actions>
        </v-card>
      </v-hover>
    </v-col>
      </v-row>

        </div> -->
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
