import i18n from '@/i18n'

const items = [
  {
    url: '/users',
    name: i18n.tc('users.sidebar.users'),
    icon: "UsersIcon",
    i18n: i18n.tc('users.sidebar.users'),
    permissions: ['users-list'],
    // submenu: [
    //   {
    //     url: '/users',
    //     name: 'List',
    //     permissions: ['users-list']
    //   }
    // ]
  }
]

export default items
