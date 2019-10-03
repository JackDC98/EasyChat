import Vue from 'vue'
import App from './App.vue'

import store from './lib/store'
import router from './lib/router'
import './lib/socket'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')