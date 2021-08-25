<template>
  <div class="mt-4">
    <div class="container">
      <div class="row">
        <div class="col d-flex justify-content-between align-items-center border-bottom">
          <h1 class="pb-2">Mis Kudoboards</h1>
          <b-button class="my-2" variant="primary" v-b-modal.bv-modal-nuevo-kudoboard>Nuevo Kudoboard</b-button>
        </div>
      </div>
    </div>
    <div class="container mt-3">
      <div class="row">
        <div class="col-6 mx-auto" v-for="(kudoboard, index) in kudoboards" :key="index">
          <b-card no-body class="overflow-hidden p-2">
            <div class="d-flex">
              <img src="https://lorempixel.com/80/80" alt="" class="img-thumbnail">
              <div class="ms-2">
                <h4>{{ kudoboard.titulo }}</h4>
                <b-button variant="info" @click="openModalEditarKudoboard(kudoboard)">Editar</b-button>
                <b-button variant="danger" @click="eliminarKudoboard(kudoboard)">Eliminar</b-button>
                <b-button variant="warning" :to="`/kudoboard/${kudoboard.id}`">Dar kudo</b-button>
              </div>
            </div>
          </b-card>
        </div>
      </div>
    </div>
    <b-modal id="bv-modal-nuevo-kudoboard" title="Crea un nuevo Kudoboard" centered hide-footer>
      <b-form @submit.prevent="crearKudoboard">
        <b-form-group label="¿Para quién es el Kudoboard?" class="mb-3">
          <b-form-input v-model="kudoboard.receptor" required></b-form-input>
        </b-form-group>
        <b-form-group label="Título de tu Kudoboard" class="mb-3">
          <b-form-input v-model="kudoboard.titulo" required></b-form-input>
        </b-form-group>
        <div class="text-center">
          <b-button type="submit" variant="primary" class="w-100">Crear Kudoboard</b-button>
        </div>
      </b-form>
    </b-modal>
    <b-modal v-model="showModalEditarKudoboard" id="bv-modal-editar-kudoboard" title="Editar Kudoboard" centered hide-footer>
      <b-form @submit.prevent="editarKudoboard">
        <b-form-group label="¿Para quién es el Kudoboard?" class="mb-3">
          <b-form-input v-model="kudoboard.receptor" required></b-form-input>
        </b-form-group>
        <b-form-group label="Título de tu Kudoboard" class="mb-3">
          <b-form-input v-model="kudoboard.titulo" required></b-form-input>
        </b-form-group>
        <div class="text-center">
          <b-button type="submit" variant="primary" class="w-100">Editar Kudoboard</b-button>
        </div>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import axios from '../axios'
import KudoboardService from '../services/KudoboardService'
export default {
  data() {
    return {
      kudoboard: {
        receptor: null,
        titulo: null
      },
      kudoboards: [],
      showModalEditarKudoboard: false,
      kudoboardService: new KudoboardService()
    }
  },
  created() {
    this.fetchKudoboards()
  },
  methods: {
    fetchKudoboards() {
      let kudoboards = this.kudoboardService.getKudoboards()
      kudoboards.then(res => {
        this.kudoboards = res.data.kudoboards
      }).catch(err => {
        console.log(err)
      })
    },
    crearKudoboard() {
      axios.post('/kudoboard', {
        receptor: this.kudoboard.receptor,
        titulo: this.kudoboard.titulo
      })
        .then(res => {
          console.log(res)
          this.fetchKudoboards()
          this.$bvModal.hide('bv-modal-nuevo-kudoboard')
          this.kudoboard = {
            receptor: null,
            titulo: null
          }
        }).catch(err => {
          console.log(err)
        })
    },
    fetchKudoboard(id) {
      axios.get(`/kudoboard/${id}`)
        .then(res => {
          console.log(res)
          return res.data.kudoboard
        }).catch(err => {
          console.log(err)
        })
    },
    openModalEditarKudoboard(kudoboard) {
      this.kudoboard = kudoboard
      this.showModalEditarKudoboard = true
    },
    editarKudoboard() {
      axios.put(`/kudoboard/${this.kudoboard.id}`, {
        receptor: this.kudoboard.receptor,
        titulo: this.kudoboard.titulo
      }).then(() => {
        // console.log(res)
        this.fetchKudoboards()
        this.showModalEditarKudoboard = false
        this.kudoboard = {
          receptor: null,
          titulo: null
        }
      }).catch(err => {
        console.log(err)
        this.showModalEditarKudoboard = false
      })
    },
    eliminarKudoboard(kudoboard) {
      axios.delete(`/kudoboard/${kudoboard.id}`)
        .then((res) => {
          console.log(res)
          this.fetchKudoboards()
        }).catch(err => {
          console.log(err)
        })
    }
  }
}
</script>

<style>

</style>