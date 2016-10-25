<template lang="html">
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <brand @toggle="onToggleMenu"/>
      <div class="collapse navbar-collapse" :class="{ in: isOpen }">
        <right />
      </div>
    </div>
  </nav>
</template>

<script>
import right from './right'
import brand from './brand'

export default {
  name: 'liker-header',
  components: { right, brand },
  data () {
    return {
      isOpen: false
    }
  },
  methods: {
    onToggleMenu () {
      this.isOpen = !this.isOpen
    }
  }
}
</script>
