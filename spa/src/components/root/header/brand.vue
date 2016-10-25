<template lang="html">
  <div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" @click="toggle">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <router-link class="navbar-brand" :to="{ name: 'posts.index'}" exact>Liker</router-link>
</div>
</template>

<script>
export default {
  methods: {
    toggle () {
      this.$emit('toggle')
    }
  }
}
</script>
