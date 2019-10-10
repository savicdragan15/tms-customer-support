import Users from './../pages/Users'
const routes = [
  {
    path: '/users',
    component: Users,
    meta: {
      auth: ['users-list']
    }
  }
]

export default routes
