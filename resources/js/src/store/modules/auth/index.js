const state = {
    token: localStorage.getItem('token') || '',
    user: {}
}

const getters = {
    isLoggedIn: state => !!state.token,
    user: state => state.user,
    roles: function (state) {
      if (state.user.roles) {
        return state.user.roles.map(role => {
          return role.name
        })
      }
    },
    permissions: function (state) {
      if (state.user.permissions) {
        return state.user.permissions.map(permission => {
          return permission.name
        })
      }
    }
}

const actions = {
    login ({ commit }, data) {
        commit('setToken', data.token)
        commit('setCurrentUser', data.user)
    },
    logout ({ commit }) {
        commit('logout')
    }
}

const mutations = {
    setCurrentUser (state, user) {
        state.user = user
    },
    setToken (state, token) {
      state.token = token
    },
    logout(state) {
        state.user = {}
        state.token = ''
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
