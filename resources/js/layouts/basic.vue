<template>
  <div class="basic-layout d-flex align-items-center justify-content-center m-0 bg-white">

    <v-app-bar app color="blue-grey darken-1">
        <router-link :to="{ name: 'welcome' }">
          <v-img src="/images/logo.png" max-width="130px"></v-img>
        </router-link>
    </v-app-bar>

    <v-main>
      <v-container fill-height>
        <v-row align="center" justify="center" >
          <v-col cols="12" sm="8">
            <child />
          </v-col>
        </v-row>
      </v-container>
    </v-main>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'BasicLayout',

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

<style lang="scss">
.basic-layout {
  color: #636b6f;
  height: 100vh;
  position: relative;

  .links {
    margin: 0 30px;
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
