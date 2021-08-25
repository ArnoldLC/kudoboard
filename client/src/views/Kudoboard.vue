<template>
  <div class="">
    <div class="bg-light">
      <div class="container">
        <div class="row py-4">
          <div class="col">
            <h1 class="text-center">{{ kudoboard.titulo }}</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="">
      <div class="container">
        <div class="row">
          <div class="col">
            <b-button variant="primary" v-b-modal.bv-modal-nuevo-kudo>Dar Kudo</b-button>
            <b-button variant="warning">Compartir</b-button>
          </div>
        </div>
      </div>
    </div>
    <div class="">
      <div class="container">
        <div class="row">
          <div class="col-4" v-for="(kudo, index) in kudos" :key="index">
            <div class="card p-3">
              <h4>{{ kudo.descripcion }}</h4>
              <p>{{ kudo.user.name }}</p>
              <div class="" v-if="user.id === kudo.user_id">
                <b-button variant="warning" size="sm" @click="openModalEditarKudo(kudo)">Editar</b-button>
                <b-button variant="danger" size="sm" @click="eliminarKudo(kudo)">Eliminar</b-button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b-modal id="bv-modal-nuevo-kudo" title="Crea un nuevo Kudo" centered hide-footer>
      <b-form @submit.prevent="crearKudo">
        <b-form-group label="Descripción" class="mb-3">
          <b-form-input v-model="kudo.descripcion" required></b-form-input>
        </b-form-group>
        <div class="text-center">
          <b-button type="submit" variant="primary" class="w-100">Crear Kudo</b-button>
        </div>
      </b-form>
    </b-modal>
    <b-modal v-model="showModalEditarKudo" id="bv-modal-editar-kudo" title="Editar Kudo" centered hide-footer>
      <b-form @submit.prevent="editarKudo">
        <b-form-group label="Descripción" class="mb-3">
          <b-form-input v-model="kudo.descripcion" required></b-form-input>
        </b-form-group>
        <div class="text-center">
          <b-button type="submit" variant="primary" class="w-100">Editar Kudo</b-button>
        </div>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import KudoboardService from '../services/KudoboardService'
import KudoService from '../services/KudoService'

import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      kudoboardService: new KudoboardService(),
      kudoService: new KudoService(),
      kudoboard: {},
      kudos: [],
      kudo: {
        descripcion: null
      },
      showModalEditarKudo: false
    }
  },
  computed: {
    ...mapGetters(['user'])
  },
  created() {
    this.fetchKudoboard()
  },
  methods: {
    fetchKudoboard() {
      let kudoboard = this.kudoboardService.getKudoboard(this.$route.params.id)
      kudoboard.then(({ kudoboard }) => {
        this.kudoboard = kudoboard
        this.fetchKudos(kudoboard.id)
        // console.log(kudoboard)
      }).catch(err => {
        console.log(err)
      })
    },
    fetchKudos(kudoboard_id) {
      let kudos = this.kudoService.getKudos(kudoboard_id)
      kudos.then(({ kudos }) => {
        this.kudos = kudos
        // console.log(kudos)
      }).catch(err => {
        console.log(err)
      })
    },
    crearKudo() {
      let kudo = this.kudoService.crearKudo(this.$route.params.id, {
        descripcion: this.kudo.descripcion
      })
      kudo.then(() => {
        // console.log(res)
        this.fetchKudos(this.$route.params.id)
      }).catch(err => {
        console.log(err)
      })
    },
    openModalEditarKudo(kudo) {
      this.showModalEditarKudo = true
      this.kudo = kudo
    },
    editarKudo() {
      let kudo = this.kudoService.editarKudo(this.kudo.id, {
        descripcion: this.kudo.descripcion
      })
      kudo.then(() => {
        // console.log(res)
        this.fetchKudos(this.$route.params.id)
        this.showModalEditarKudo = false
        this.kudo = {
          descripcion: null
        }
      }).catch(err => {
        console.log(err)
      })
    },
    eliminarKudo({ id }) {
      let kudo = this.kudoService.deleteKudo(id)
      kudo.then(() => {
        // console.log(res)
        this.fetchKudos()
      }).catch(err => {
        console.log(err)
      })
    }
  }
}
</script>

<style>

</style>