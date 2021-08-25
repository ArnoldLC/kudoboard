<template>
  <div class="login-wrapper d-flex">
    <div class="container max-w-login align-self-center">
      <b-card>
        <h2 class="text-center mb-4">Bienvenido</h2>
        <b-form @submit.prevent="autenticar">
          <b-form-group label="Correo" class="mb-3">
            <b-form-input v-model="usuario.email" required></b-form-input>
          </b-form-group>
          <b-form-group label="Contraseña" class="mb-3">
            <b-form-input type="password" v-model="usuario.password" required></b-form-input>
          </b-form-group>
          <p>¿Olvidó su contraseña? <router-link to="#">Click aquí</router-link></p>
          <div class="">
            <b-button type="submit" variant="primary" class="w-100">{{ loadingRequest ? '...Espere' : 'Ingresar' }}</b-button>
          </div>
        </b-form>
      </b-card>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      usuario: {
        email: null,
        password: null
      },
      loadingRequest: false
    }
  },
  methods: {
    autenticar() {
      this.$store.dispatch('login', {
        email: this.usuario.email,
        password: this.usuario.password
      }).then(() => {
        this.$router.push('/')
      }).catch(err => {
        console.log(err)
      })
    }
  }
}
</script>

<style scoped>
.login-wrapper {
  height: calc(100vh - 3.5rem);
}

.max-w-login {
  max-width: 420px;
}
</style>