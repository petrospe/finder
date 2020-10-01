<template>
      <card :title="$t('login')">
        <v-form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <v-text-field
            v-model="form.email"
            id="email"
            v-bind:label="$t('email')"
            name="email"
            prepend-icon="person"
            type="email"
            :class="{ 'is-invalid': form.errors.has('email') }"
          />
          <has-error :form="form" field="email" />

          <!-- Password -->
          <v-text-field
            v-model="form.password"
            id="password"
            v-bind:label="$t('password')"
            name="password"
            prepend-icon="lock"
            type="password"
            :class="{ 'is-invalid': form.errors.has('password') }"
          />
          <has-error :form="form" field="password" />

          <!-- Remember Me -->
          <div class="form-group row">
            <div class="col-md-4" />
            <div class="col-md-8 d-flex">
              <checkbox v-model="remember" name="remember">
                {{ $t('remember_me') }}
              </checkbox>

              <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
                {{ $t('forgot_password') }}
              </router-link>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-8 offset-md-4 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('login') }}
              </v-button>

              <!-- GitHub Login Button -->
              <login-with-github />
            </div>
          </div>
        </v-form>
      </card>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  layout: 'basic',

  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'home' })
    }
  }
}
</script>
