<template>
  <div class="">
    <div class="bg-light mb-4">
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
  </div>
</template>

<script>
import SharedKudoboardService from '../services/SharedKudoboardService'
import KudoService from '../services/KudoService'
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      sharedKudoboardService: new SharedKudoboardService(),
      kudoService: new KudoService(),
      kudoboard: {},
      kudos: [],
      kudo: {
        descripcion: null
      }
    }
  },
  computed: {
    ...mapGetters(['user'])
  },
  created() {
    this.fetchSharedKudoboard(this.$route.params.id)
  },
  methods: {
    fetchSharedKudoboard(kudoboard_id) {
      this.sharedKudoboardService.getSharedKudoboard(kudoboard_id)
        .then(res => {
          this.kudoboard = res.shared_kudoboard.kudoboard
          this.kudos = res.kudos
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
        this.$bvModal.hide('bv-modal-nuevo-kudo')
      }).catch(err => {
        console.log(err)
      })
    }
  }
}
</script>

<style>

</style>