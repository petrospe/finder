<template>
  <div class="main-layout">
    <navbar />
    <v-main>
      <v-container>
        <v-row justify="center" align="center">
          <v-col cols="12">
            <child />
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <component :is="footer" v-if="footer" />
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import Footer from '~/components/Footer'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    Footer
  },

  data: () => ({
    footer: 'Footer'
  })
}
</script>
