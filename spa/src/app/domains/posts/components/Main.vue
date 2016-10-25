<template lang="html">
    <header class="page-header row">
      <h2>Posts lists !</h2>
      <div class="well" v-for="post in posts">
        {{ post.body }} by <strong>{{ post.user.data.name }}</strong>
        in {{ post.diffForHumans }}
      </p>
    </header>
</template>

<script>
import http from 'src/http'

export default {
  name: 'Posts',
  data () {
    return {
      posts: []
    }
  },
  computed: {},
  mounted () {
    http.get('posts', {
      params: {
        include: 'user'
      }
    }).then(response => {
      this.posts = response.data.data
    }).catch(error => {
      console.log(error)
    })
  },
  methods: {},
  components: {}
}
</script>

<style lang="css">
</style>
