<template>
  <v-app id="inspire">

    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Contact</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>


      <v-app-bar app color="indigo darken-1">
        <v-app-bar-nav-icon class="white--text" @click.stop="drawer = !drawer" />
        <router-link :to="{ name: 'Index' }">
          <v-img src="images/icons/logo.png" max-width="130px"></v-img>
        </router-link>
       <v-spacer></v-spacer>
       <router-link :to="{ name: 'Login' }">
         <v-btn class="white--text" icon>
           <v-icon>mdi-login-variant</v-icon>
           <span>Login</span>
       </v-btn>
       </router-link>
     </v-app-bar>
     <router-view></router-view>
      <v-footer
        color="indigo darken-1"
        app
      >
        <span class="white--text">&copy; {{ currentDate.getFullYear() }}</span>
      </v-footer>
  </v-app>
</template>
<script>
    export default {
      data(){
        return {
          drawer: null,
            currentDate: new Date,
        }
      }
    }
</script>
