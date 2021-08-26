import axios from '../axios'

export default class SharedKudoboardService {

  getSharedKudoboards() {
    return new Promise((resolve, reject) => {
      axios.get('/shared-kudoboard')
        .then(res => {
          console.log(res)
          resolve(res.data)
        }).catch(err => {
          console.log(err)
          reject(err)
        })
    })
  }

  getSharedKudoboard(id) {
    return new Promise((resolve, reject) => {
      axios.get(`/shared-kudoboard/${id}`)
        .then(res => {
          console.log(res)
          resolve(res.data)
        }).catch(err => {
          console.log(err)
          reject(err)
        })
    })
  }

}