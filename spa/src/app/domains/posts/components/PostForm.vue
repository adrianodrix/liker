<template lang="html">
  <form autocomplete="off" class="form form-vertical" @submit.prevent="doPost">
    <div class="form-group" :class="{ 'has-error': error }">
      <textarea rows="3" cols="30" class="form-control" placeholder="Write something likeable" v-model="body" required></textarea>
      <span class="help-block" v-if="error">{{ response }}</span>
    </div>
    <button type="submit" class="btn btn-default">Post it!</button>
  </form>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'PostForm',
  data () {
    return {
      error: false,
      response: null,
      body: null
    }
  },
  methods: {
    ...mapActions(['attemptPost']),
    doPost () {
      this.attemptPost(this.body)
        .then(() => {
          this.body = null
        }, response => {
          this.response = response
          this.error = true
        })
    }
  }
}
</script>

<style lang="css">
</style>
