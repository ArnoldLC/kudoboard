<template>
  <div class="">
    <b-navbar type="dark" variant="dark">
      <div class="container">
        <b-navbar-brand href="/">KUDOBOARD</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <!-- <b-collapse id="nav-collapse" class="ml-auto" is-nav> -->
          <b-navbar-nav>
            <b-nav-item to="/login" v-if="!loggedIn">Login</b-nav-item>
            <b-nav-item to="/register" v-if="!loggedIn">Register</b-nav-item>
            <b-button v-else variant="danger" size="sm" @click="logout">Cerrar sesión</b-button>
          </b-navbar-nav>
        <!-- </b-collapse> -->
      </div>
    </b-navbar>
    <div class="">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'App',
  computed: {
    ...mapGetters(['loggedIn'])
  },
  methods: {
    logout() {
      this.$store.dispatch('logout')
        .then(res => {
          console.log(res)
          this.$router.push('/login')
        }).catch(err => {
          console.log(err)
        })
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
