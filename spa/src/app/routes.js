import { routes as auth } from './domains/auth'
import { routes as posts } from './domains/posts'

export default [ ...auth, ...posts ]
