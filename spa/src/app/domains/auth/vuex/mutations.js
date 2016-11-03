import * as types from './mutations_types'
import http from 'src/http'

export default {
  [types.setUser] (state, user) {
    state.user = user
  },
  [types.setToken] (state, token) {
    http.defaults.headers.common['Authorization'] = 'Bearer ' + token
    state.token = token
  }
}
