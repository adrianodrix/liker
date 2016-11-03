import * as types from './mutations_types'
import { getPosts, setPost, setLikePost } from '../services'

export const attemptPosts = (context, payload) => {
  return getPosts()
    .then(data => {
      context.commit(types.setPosts, data.data)
    }, error => Promise.reject(error.response.data))
}

export const attemptPost = (context, payload) => {
  return setPost(payload)
    .then(() => {
      // getPosts()
      //   .then(data => {
      //     context.commit(types.setPosts, data.data)
      //   })
    }, error => Promise.reject(error))
}

export const attemptLikePost = (context, payload) => {
  return setLikePost(payload)
    .then(() => {
      // getPosts()
      //   .then(data => {
      //     context.commit(types.setPosts, data.data)
      //   })
    }, error => Promise.reject(error))
}
