<template lang="html">
 <login/>
</template>

<script>
import { mapGetters } from 'vuex'
import Login from './Forms/Login'

export default {
  name: 'Auth',
  data () {
    return {}
  },
  computed: {
    ...mapGetters(['isLogged'])
  },
  mounted () {},
  methods: {},
  components: {
    Login
  }
}
</script>

<style lang="css">
</style>
