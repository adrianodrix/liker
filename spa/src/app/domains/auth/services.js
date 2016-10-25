import http from 'src/http'

export const postLogin = (email, password) => {
  return http.post('auth/signin', {
    email: email,
    password: password
  })
    .then(response => response.data)
}
