import VueRouter from "vue-router";

import Login from './views/Login'
import Register from './views/Register'
import MisKudoboards from './views/MisKudoboards'
import Kudoboard from './views/Kudoboard'

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/',
      name: 'MisKudos',
      component: MisKudoboards
    },
    {
      path: '/kudoboard/:id',
      name: 'Kudo',
      component: Kudoboard
    }
  ]
})

export default router