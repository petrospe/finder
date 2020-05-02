<template>
  <v-app id="inspire">
  <v-content>
    <v-container
      class="fill-height"
      fluid
    >
      <v-row
        align="center"
        justify="center"
      >
        <v-col class="text-center">
          <v-tooltip left>
              <router-link :to="{ name: 'categories.search' }">
              <v-btn
                icon
                large
              >
                <v-icon large>mdi-code-tags</v-icon>
              </v-btn>
              <span>Source</span>
              </router-link>

          </v-tooltip>

          <v-tooltip right>
             <router-link :to="{ name: 'Entry' }">
              <v-btn
                icon
                large
                href="https://codepen.io/johnjleider/pen/zgxeLQ"
                target="_blank"
              >
                <v-icon large>mdi-codepen</v-icon>
              </v-btn>
              <span>Codepen</span>
              </router-link>

          </v-tooltip>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
  </v-app>
</template>
<script>
    export default {}
</script>
