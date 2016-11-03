<template lang="html">
  <div class="media">
      <like-button  :post="post" v-if="post.likedByCurrentUser === false && post.canBeLike === true"/>
      <div class="media-left">
        <a href="javascript:;">
          <img :src="post.user.data.avatar" :alt="post.user.data.name + ' avatar'" class="media-object img" />
        </a>
      </div>
      <div class="media-body">
        <strong>{{ post.user.data.name }}</strong> <small>at {{ post.diffForHumans }}</small>
        <p>{{ post.body }}</p>
        <p v-if="post.likeCount">{{ post.likeCount }} {{ pluralize('like', post.likeCount)}}</p>
      </div>
  </div>
</template>

<script>
import pluralize from 'pluralize'
import LikeButton from './LikeButton'

export default {
  name: 'PostsTimelinePost',
  props: [
    'post'
  ],
  components: {
    LikeButton
  },
  methods: {
    pluralize
  }
}
</script>

<style lang="css" scoped>
  .media {
    position: relative;
    margin: 0;
    padding: 10px;
  }

  .media:hover .like {
    display: block;
  }
</style>
