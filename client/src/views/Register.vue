<template>
  <div class="register-wrapper d-flex">
    <div class="container max-w-register align-self-center">
      <b-card>
        <h2 class="text-center mb-4">Registro</h2>
        <b-form @submit.prevent="registrar">
          <b-form-group label="Nombre" class="mb-3">
            <b-form-input v-model="usuario.name" required></b-form-input>
          </b-form-group>
          <b-form-group label="Correo" class="mb-3">
            <b-form-input v-model="usuario.email" required></b-form-input>
          </b-form-group>
          <b-form-group label="Contraseña" class="mb-3">
            <b-form-input type="password" v-model="usuario.password" required></b-form-input>
          </b-form-group>
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
        name: null,
        email: null,
        password: null
      },
      loadingRequest: false
    }
  },
  methods: {
    registrar() {
      this.loadingRequest = true
      this.$store.dispatch('register', {
        name: this.usuario.name,
        email: this.usuario.email,
        password: this.usuario.password
      }).then(res => {
        console.log(res)
        this.loadingRequest = true
        this.$store.dispatch('login', {
          email: this.usuario.email,
          password: this.usuario.password
        }).then(res => {
          console.log(res)
          this.$router.push('/')
        }).catch(err => {
          console.log(err)
          this.$router.push('/login')
        })
      })
    }
  }
}
</script>

<style scoped>
.register-wrapper {
  height: calc(100vh - 3.5rem);
}

.max-w-register {
  max-width: 420px;
}
</style>