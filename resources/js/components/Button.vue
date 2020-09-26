<template>
  <div class="my-2">
  <v-btn :type="nativeType" :disabled="loading"
    :color="color"
    :large="large"
    :block="block"
    :loading="loading"
    :class="vclass"
  >
    <slot />
  </v-btn>
</div>
</template>

<script>
export default {
  name: 'VButton',

  props: {
    color: {
      type: String,
      default: '#0066cc'
    },

    nativeType: {
      type: String,
      default: 'submit'
    },

    loading: {
      type: Boolean,
      default: false
    },

    block: {
      type: Boolean,
      default: false
    },

    large: {
      type: Boolean,
      default: false
    },

    vclass: {
      type: String,
      default: 'white--text'
    },
  }
}
</script>
