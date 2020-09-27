<template>
  <v-app-bar app color="blue-grey darken-1">

      <router-link :to="{ name: user ? 'home' : 'welcome' }">
        <v-img src="/images/logo.png" width="130px" alt="{appName}" />
      </router-link>

      <v-spacer></v-spacer>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>

      <ul class="navbar-nav text-white mr-8">
        <locale-dropdown />
      </ul>

      <router-link :to="{ name: 'categories' }">
        <v-btn large right class="white--text links mr-14" icon>
           <v-icon large class="white--text">mdi-magnify</v-icon>
          {{ $t('search') }}
        </v-btn>
      </router-link>

      <!-- Authenticated -->
      <v-menu
         v-if="user"
         left
         bottom
       >
         <template v-slot:activator="{ on, attrs }">
           <v-btn
             icon
             v-bind="attrs"
             v-on="on"
             class="white--text links mr-4"
           >
             <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
             {{ user.name }}
           </v-btn>
         </template>

         <v-list>
           <v-list-item>
             <router-link :to="{ name: 'settings.profile' }" class="dropdown-item">
               <v-list-item-title>
               <fa icon="cog" fixed-width />
               {{ $t('settings') }}
               </v-list-item-title>
             </router-link>
             <v-list-item-title>
               <a href="#" class="dropdown-item" @click.prevent="logout">
                 <fa icon="sign-out-alt" fixed-width />
                 {{ $t('logout') }}
               </a>
             </v-list-item-title>
           </v-list-item>
         </v-list>
       </v-menu>

        <!-- Guest -->
        <template v-else>
          <router-link :to="{ name: 'login' }">
            <v-btn right class="white--text links mr-16" icon>
             <v-icon class="white--text">mdi-login-variant</v-icon>
            {{ $t('login') }}
          </v-btn>
          </router-link>
          <router-link :to="{ name: 'register' }">
            <v-btn right class="white--text links mr-7" icon>
             <v-icon class="white--text" >mdi-draw</v-icon>
            {{ $t('register') }}
          </v-btn>
          </router-link>
        </template>

  </v-app-bar>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
