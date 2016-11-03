<template lang="html">
  <div class="col-md-12">
    <header class="page-header row">
      <h3>Timeline</h3>
    </header>
    <post-form v-if="isLogged" />
    <hr v-if="isLogged" />
    <post v-for="post in currentPosts" :post="post" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Post from './Post'
import PostForm from './PostForm'
import eventHub from 'src/event'

export default {
  name: 'PostsTimeline',
  components: {
    Post, PostForm
  },
  computed: {
    ...mapGetters(['isLogged', 'currentPosts'])
  },
  mounted () {
    eventHub.$on('post-added', this.addPost)
    eventHub.$on('post-liked', this.likePost)
    this.attemptPosts()
  },
  methods: {
    ...mapActions(['attemptPosts']),
    addPost (post) {
      this.currentPosts.unshift(post)
    },
    likePost (post) {
      let i
      for (i = 0; i <= this.currentPosts.length; i++) {
        if (this.currentPosts[i].id === post.id) {
          this.currentPosts[i].likeCount++
          this.currentPosts[i].canBeLike = false
          this.currentPosts[i].likedByCurrentUser = true
          break
        }
      }
    }
  }
}
</script>

<style lang="css">
</style>
