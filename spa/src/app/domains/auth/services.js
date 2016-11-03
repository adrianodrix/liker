import http from 'src/http'

export const postLogin = (email, password) => {
  return http.post('auth/signin', {
    email: email,
    password: password
  }).then(response => response.data).catch(error => Promise.reject(error.response.data))
}

export const postSignUp = (name, email, password) => {
  return http.post('auth/register', {
    name: name,
    email: email,
    password: password
  }).then(response => response.data).catch(error => Promise.reject(error.response.data))
}
