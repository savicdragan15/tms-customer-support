const config = {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  authRedirect: { path: '/login' },
  tokenDefaultName: 'token',
  rolesVar: 'permissions',
  tokenStore: ['localStorage'],
  loginData: { url: "auth/login", method: 'POST', redirect: '/home', fetchUser: true },
  logoutData: { url: "auth/logout", method: 'POST', redirect: '/login', makeRequest: true },
  refreshData: { url: "auth/refresh", method: 'GET', enabled: true, interval: 120 }
}

export default config
