import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import auth from './modules/auth'

const store = new Vuex.Store({
  modules: {
    auth
  }
})

export default store