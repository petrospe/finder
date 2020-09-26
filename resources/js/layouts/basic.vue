<template>
  <div class="basic-layout d-flex align-items-center justify-content-center m-0 bg-white">

    <v-app-bar app  color="blue-grey darken-1">
        <router-link :to="{ name: 'welcome' }">
          <v-img src="/images/logo.png" max-width="130px"></v-img>
        </router-link>
       <v-spacer></v-spacer>
       <template v-if="authenticated">
         <router-link :to="{ name: 'home' }">
           {{ $t('home') }}
         </router-link>
       </template>
       <template v-else>
         <router-link :to="{ name: 'login' }">
           <v-btn class="white--text links" icon>
            <v-icon class="white--text">mdi-login-variant</v-icon>
           {{ $t('login') }}
         </v-btn>
         </router-link>
         <router-link :to="{ name: 'register' }">
           <v-btn class="white--text links" icon>
            <v-icon class="white--text" >mdi-draw</v-icon>
           {{ $t('register') }}
         </v-btn>
         </router-link>
       </template>
    </v-app-bar>

    <child />
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
