import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue } from 'bootstrap-vue'

import  router  from './router'
import store from './store/store'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import App from './App.vue'

Vue.use(BootstrapVue)
Vue.use(VueRouter)

Vue.config.productionTip = false

store.dispatch('me', localStorage.getItem('kudoboard_user_token')).finally(() => {
  new Vue({
    render: h => h(App),
    router,
    store
  }).$mount('#app')
})
