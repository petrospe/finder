<template>
  <v-app id="inspire">
  <v-app-bar
    app
    color="indigo"
    dark
  >
  <router-link :to="{ name: 'Login' }">Login</router-link> |
  <router-link :to="{ name: 'categories.search' }">Find</router-link> |
  <router-link :to="{ name: 'Entry' }">New Entry</router-link> |
  </v-app-bar>
    <router-view></router-view>
    <v-footer
      color="indigo"
      app
    >
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>
</template>
<script>
    export default {}
</script>
