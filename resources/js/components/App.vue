<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      v-if="jwt"
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

    <v-app-bar app color="blue-grey darken-1">
        <v-app-bar-nav-icon v-if="jwt" class="white--text" @click.stop="drawer = !drawer" />
        <router-link :to="{ name: 'Index' }">
          <v-img src="/images/icons/logo.png" max-width="130px"></v-img>
        </router-link>
       <v-spacer></v-spacer>
       <router-link :to="{ name: 'categories.search' }">
         <v-btn class="white--text m-2" icon>
           <v-icon>mdi-magnify</v-icon>
           <span>Search</span>
       </v-btn>
       </router-link>
    </v-app-bar>

    <router-view></router-view>

    <v-footer
      color="blue-grey darken-1"
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
            jwt: null,
        }
      },
      created() {
          this.fetchData();
      },
      methods: {
          fetchData() {
            this.jwt = localStorage.getItem('token');
            if(this.jwt){
              window.axios.defaults.headers.common['Authorization'] = `bearer ${this.jwt}`;
              // debugger;
            } else {
              console.error('JWT token not found')
            }
          }
      }
    }
</script>
