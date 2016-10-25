import * as types from './mutations_types'
import { postLogin } from '../services'

export const attemptLogin = (context, payload) => {
  return postLogin(payload.email, payload.password)
    .then(data => {
      context.commit(types.setToken, data.meta.token)
      context.commit(types.setUser, data.data)
    })
}
