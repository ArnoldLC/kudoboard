import axios from '../axios'

export default class KudoboardService {

  getKudoboards() {
    return new Promise((resolve, reject) => {
      axios.get('/kudoboard')
        .then(res => {
          // console.log(res.data.kudoboards)
          resolve(res)
        }).catch(err => {
          reject(err)
        })
    })
  }

  getKudoboard(id) {
    return new Promise((resolve, reject) => {
      axios.get(`/kudoboard/${id}`)
        .then((res) => {
          // console.log(res)
          resolve(res.data)
        }).catch(err => {
          console.log(err)
          reject(err)
        })
    })
  }
}