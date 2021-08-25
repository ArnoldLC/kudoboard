import axios from "../../axios"

const auth = {
  state: () => ({
    user: null,
    token: null
  }),
  getters: {
    user(state) {
      let kudoboard_user = localStorage.getItem('kudoboard_user')
      return state.user ? state.user : JSON.parse(kudoboard_user)
    },
    userToken(state) {
      return state.token ? state.token : localStorage.getItem('kudoboard_user_token')
    },
    loggedIn(state) {
      return Boolean(state.token) && Boolean(state.user)
    }
  },
  mutations: {
    SET_TOKEN (state, token) {
      state.token = token
      localStorage.setItem('kudoboard_user_token', state.token)
    },
    SET_USER (state, user) {
      state.user = user
      localStorage.setItem('kudoboard_user', JSON.stringify(state.user))
    },
    logout (state) {
      state.user = null
      state.token = null
      localStorage.removeItem('kudoboard_user')
      localStorage.removeItem('kudoboard_user_token')
    }
  },
  actions: {
    login({ commit }, user) {
      return new Promise((resolve, reject) => {
        axios.post('/login', {
          email: user.email,
          password: user.password
        }).then(res => {
          commit('SET_TOKEN', res.data.token)
          commit('SET_USER', res.data.user)
          resolve(res)
        }).catch(err => {
          commit('SET_TOKEN', null)
          commit('SET_USER', null)
          localStorage.removeItem('kudoboard_user')
          localStorage.removeItem('kudoboard_user_token')
          console.log(err)
          reject(err)
        })
      })
    },
    register({ commit }, user) {
      return new Promise((resolve, reject) => {
        axios.post('/register', {
          name: user.name,
          email: user.email,
          password: user.password
        }).then(res => {
          commit('SET_TOKEN', res.data.token)
          commit('SET_USER', res.data.user)
          resolve(res.data)
        }).catch(err => {
          commit('SET_TOKEN', null)
          commit('SET_USER', null)
          localStorage.removeItem('kudoboard_user')
          localStorage.removeItem('kudoboard_user_token')
          console.log(err)
          reject(err)
        })
      })
    },
    me({ commit }, token) {
      return new Promise((resolve, reject) => {
        axios.get('/me', {})
          .then(res => {
            commit('SET_TOKEN', token)
            commit('SET_USER', res.data.user)
            resolve(res)
          }).catch(err => {
            reject(err)
          })
      })
    },
    logout({ commit }) {
      return new Promise((resolve, reject) => {
        axios.post('/logout', {})
          .then(res => {
            commit('logout')
            resolve(res)
          }).catch(err => {
            reject(err)
          })
      })
    }
  },
}

export default auth