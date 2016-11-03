<template lang="html">
  <div class="col-md-12">
    <header class="page-header row">
      <h2>Sign in</h2>
    </header>
    <form autocomplete="off" @submit="doLogin">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" v-model="user.email" class="form-control" placeholder="you@somewhere.com" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" v-model="user.password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary" :disabled="!isValid">Sign in</button>
    </form>
  </div>
</template>

<script>
import { isEmpty } from 'lodash'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'AuthSignIn',
  data () {
    return {
      user: {
        email: null,
        password: null
      }
    }
  },
  computed: {
    ...mapGetters(['isLogged']),
    isValid () {
      const user = this.user
      return !isEmpty(user.email) && !isEmpty(user.password)
    }
  },
  methods: {
    ...mapActions(['attemptLogin']),
    doLogin (e) {
      e.preventDefault()
      const user = this.user
      this.attemptLogin({...user})
        .then(() => {
          this.$router.push({ name: 'posts.index' })
        })
    }
  }
}
</script>

<style lang="css">
</style>
