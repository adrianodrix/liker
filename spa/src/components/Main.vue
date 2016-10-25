<template>
  <div id="app">
    <root-header></root-header>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import RootHeader from 'components/root/header/main'

export default {
  name: 'App',
  components: {
    RootHeader
  }
}
</script>

<style src="assets/sass/app.scss" lang="sass"></style>
