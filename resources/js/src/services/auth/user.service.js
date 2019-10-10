import axios from 'axios'
import store from './../../store/store'
import router from './../../router'
import jwtDecode from 'jwt-decode'

export const userService = {
    login,
    logout,
    getCurrentUserFromServer
};

function login (email, password) {
     axios.post('auth/login', {
        email: email,
        password: password
    })
        .then(res => {
            const token = res.headers.authorization
            const user = jwtDecode(token).user
            localStorage.setItem('token', token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            store.dispatch('auth/login', { token, user })
            router.push('/')
        })
        .catch(error => {
            console.log('error', error)
        })
}

function logout () {
  delete axios.defaults.headers.common['Authorization']
  localStorage.removeItem('token')
  store.commit('auth/logout')
  router.push('pages/login')
}

function getCurrentUserFromServer() {
  return axios.get('/auth/user')
}
