import { defaults } from 'lodash'
import axios from 'axios'

export const createClient = (options = {
  baseURL: 'http://api.v1.liker.dev:8555/'
}) => axios.create(defaults({}, options))

export default createClient()
