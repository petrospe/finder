<template>
  <v-main>
    <v-container class="fill-height" fluid >
      <v-row align="center" justify="center" >
        <v-col class="text-center">
          <v-tooltip left>
            <template v-slot:activator="{ on }">
              <v-btn
                :to="{ name: 'categories' }"
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
                :to="{ name: 'home' }"
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
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>
