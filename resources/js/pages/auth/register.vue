<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else :title="$t('register')">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <v-text-field
            v-model="form.name"
            id="name"
            v-bind:label="$t('name')"
            name="name"
            type="text"
            :class="{ 'is-invalid': form.errors.has('name') }"
          />
          <has-error :form="form" field="name" />

          <!-- Email -->
          <v-text-field
            v-model="form.email"
            id="email"
            v-bind:label="$t('email')"
            name="email"
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
            type="password"
            :class="{ 'is-invalid': form.errors.has('password') }"
          />
          <has-error :form="form" field="password" />

          <!-- Password Confirmation -->
          <v-text-field
            v-model="form.password_confirmation"
            id="password_confirmation"
            v-bind:label="$t('confirm_password')"
            name="password_confirmation"
            type="password"
            :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
          />
          <has-error :form="form" field="password_confirmation" />
          
          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('register') }}
              </v-button>

              <!-- GitHub Register Button -->
              <login-with-github />
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
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
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
