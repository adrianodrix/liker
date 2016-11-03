import * as types from './mutations_types'

export default {
  [types.setPosts] (state, posts) {
    state.posts = posts
  }
}
