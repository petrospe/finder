<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid >
        <v-row align="center" justify="center" >
          <v-col class="text-center">
            <v-tooltip left>
              <template v-slot:activator="{ on }">
                <v-btn
                  :to="{ name: 'categories.search' }"
                  icon
                  large
                  v-on="on"
                >
                  <v-icon large>mdi-magnify</v-icon>
                </v-btn>
              </template>
              <span>Find</span>
            </v-tooltip>

            <v-tooltip right>
              <template v-slot:activator="{ on }">
                <v-btn
                  :to="{ name: 'Home' }"
                  icon
                  large
                  v-on="on"
                >
                  <v-icon large>mdi-pencil-plus-outline</v-icon>
                </v-btn>
              </template>
              <span>New Entry</span>
            </v-tooltip>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
    export default {
      props: {
        source: String,
      },
    }
</script>
