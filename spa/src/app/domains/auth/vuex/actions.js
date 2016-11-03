import * as types from './mutations_types'
import { postLogin, postSignUp } from '../services'

export const attemptLogin = (context, payload) => {
  return postLogin(payload.email, payload.password)
    .then(data => {
      context.commit(types.setToken, data.meta.token)
      context.commit(types.setUser, data.data)
    }, error => Promise.reject(error.response.data))
}

export const attemptSignUp = (context, payload) => {
  return postSignUp(payload.name, payload.email, payload.password)
    .then(data => {
      context.commit(types.setToken, data.meta.token)
      context.commit(types.setUser, data.data)
    }, error => Promise.reject(error))
}
