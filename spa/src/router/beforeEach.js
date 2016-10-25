import store from '../vuex'

const isAuthRoute = route => route.name.indexOf('auth.signin') !== -1
const isLogged = () => store.getters.isLogged

export default (to, from, next) => {
  if (!isAuthRoute(to) && !isLogged()) {
    next({ name: 'auth.signin' })
  }
  next()
}
