Nova.booting((Vue, router, store) => {
  Vue.component('index-route-measures', require('./components/IndexField'))
  Vue.component('detail-route-measures', require('./components/DetailField'))
  Vue.component('form-route-measures', require('./components/FormField'))
})
