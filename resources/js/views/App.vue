<template>
  <v-app id="inspire">
    <v-card
    flat
    height="100%"
    tile
  >
    <v-toolbar dense color="indigo darken-1">
     <v-img src="images/icons/logo.png" max-width="130px"></v-img>
     <v-spacer></v-spacer>
     <router-link :to="{ name: 'Login' }">
       <v-btn icon>
         <v-icon>mdi-login-variant</v-icon>
         <span>Login</span>
     </v-btn>
     </router-link>
   </v-toolbar>

 </v-card>
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
            currentDate: new Date,
            }
     }
    }
</script>
