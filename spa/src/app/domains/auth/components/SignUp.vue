<template lang="html">
  <div class="col-md-12">
    <header class="page-header row">
      <h2>Sign up</h2>
    </header>
    <form autocomplete="off" @submit="doSignUp">
      <div class="form-group" :class="{ 'has-error': error && response.name }">
        <label for="name">Name</label>
        <input type="name" v-model="user.name" class="form-control" placeholder="Your name" required>
        <span class="help-block" v-if="error && response.name">{{ response.name[0] }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': error && response.email }">
        <label for="email">Email</label>
        <input type="email" v-model="user.email" class="form-control" placeholder="you@somewhere.com" required>
        <span class="help-block" v-if="error && response.email">{{ response.email[0] }}</span>
      </div>
      <div class="form-group" :class="{ 'has-error': error && response.password }">
        <label for="password">Password</label>
        <input type="password" v-model="user.password" class="form-control" placeholder="Password" required>
        <span class="help-block" v-if="error && response.password">{{ response.password[0] }}</span>
      </div>
      <button type="submit" class="btn btn-primary" :disabled="!isValid">Get my account</button>
    </form>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { isEmpty } from 'lodash'

export default {
  name: 'AuthSignUp',
  data () {
    return {
      error: false,
      response: null,
      user: {
        name: null,
        email: null,
        password: null
      }
    }
  },
  computed: {
    ...mapGetters(['isLogged']),
    isValid () {
      const user = this.user
      return !isEmpty(user.name) && !isEmpty(user.email) && !isEmpty(user.password)
    }
  },
  methods: {
    ...mapActions(['attemptSignUp']),
    doSignUp (e) {
      e.preventDefault()
      const user = this.user
      this.attemptSignUp({...user})
        .then(() => {
          this.$router.push({ name: 'posts.index' })
        }, response => {
          this.response = response.error
          this.error = true
        })
    }
  }
}
</script>

<style lang="css">
</style>
