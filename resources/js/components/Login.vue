<template>
  <v-app id="inspire">
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="blue-grey darken-1" dark flat>
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer />
              </v-toolbar>
              <v-card-text>
                <div class="alert alert-danger" v-if="has_error">
                    <p>Error, unable to connect with these identifiers.</p>
                </div>
                <v-form autocomplete="off" @submit.prevent="login" method="post">
                  <v-text-field
                    v-model="email"
                    id="email"
                    label="Login"
                    name="email"
                    prepend-icon="person"
                    type="email"
                  />

                  <v-text-field
                    v-model="password"
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="lock"
                    type="password"
                  />

                  <v-btn type="submit" color="primary">Login</v-btn>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="primary">
                  <v-icon>mdi-google</v-icon>
                  Login
                </v-btn>
                <v-btn color="primary">
                  <v-icon>mdi-facebook</v-icon>
                  Login
                </v-btn>

              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        has_error: false
      }
    },
    mounted() {
       //
    },
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // handle redirection
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 'admin' ? 'admin' : 'home'
            this.$router.push({name: redirectTo})
          },
          error: function() {
            app.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>
