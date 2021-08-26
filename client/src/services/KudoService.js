import axios from '../axios'

export default class KudoService {
  
  getKudos( kudoboard_id ) {
    return new Promise((resolve, reject) => {
      axios.get(`/kudoboard/${kudoboard_id}/kudo`)
        .then(res => {
          // console.log(res)
          resolve(res.data)
        }).catch(err => {
          console.log(err)
          reject(err)
        })
    })
  }

  crearKudo( kudoboard_id, kudo ) {
    return new Promise((resolve, reject) => {
      axios.post(`/kudoboard/${kudoboard_id}/kudo`, {
        descripcion: kudo.descripcion
      })
        .then(res => {
          // console.log(res)
          resolve(res.data)
        }).catch(err => {
          console.log(err)
          reject(err)
        })
    })
  }

  editarKudo(kudo_id, kudo) {
    return new Promise((resolve, reject) => {
      axios.put(`/kudo/${kudo_id}`, {
        descripcion: kudo.descripcion
      }).then(res => {
        resolve(res.data)
      }).catch(err => {
        reject(err)
      })
    })
  }

  deleteKudo( kudo_id ) {
    return new Promise((resolve, reject) => {
      axios.delete(`/kudo/${kudo_id}`)
        .then(res => {
          // console.log(res)
          resolve(res.data)
        }).catch(err => {
          console.log(err)
          reject(err)
        })
    })
  }
}