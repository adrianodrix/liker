import SignIn from './components/SignIn'
import SignUp from './components/SignUp'

export default [
  { path: '/signin', component: SignIn, name: 'auth.signin' },
  { path: '/signup', component: SignUp, name: 'auth.signup' }
]
