import http from 'src/http'
import eventHub from 'src/event'

export const getPosts = () => {
  return http.get('posts?include=user')
    .then(response => response.data)
    .catch(error => Promise.reject(error.response.data))
}

export const setPost = (body) => {
  return http.post('posts', {body: body})
    .then(response => {
      let post = response.data.data
      eventHub.$emit('post-added', post)
      return response.data
    })
    .catch(() => Promise.reject('error'))
}

export const setLikePost = (post) => {
  return http.post('posts/' + post.id + '/likes')
    .then(response => {
      eventHub.$emit('post-liked', post)
      return response.data.data
    })
    .catch(() => Promise.reject('error'))
}
