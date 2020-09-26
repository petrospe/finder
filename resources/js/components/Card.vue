<template>
  <v-card class="elevation-12">
    <v-toolbar color="blue-grey darken-1" dark flat>
      <v-toolbar-title v-if="title">
        {{ title }}
      </v-toolbar-title>
      <v-spacer />
    </v-toolbar>

    <v-card-text>
      <slot />
    </v-card-text>

  </v-card>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: { type: String, default: null }
  }
}
</script>
