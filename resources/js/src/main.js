/*=========================================================================================
  File Name: main.js
  Description: main vue(js) file
  ----------------------------------------------------------------------------------------
  Item Name: Vuesax Admin - VueJS Dashboard Admin Template
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import App from './App.vue'

// Vuesax Component Framework
import Vuesax from 'vuesax'
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate)
Vue.use(Vuesax)

// Theme Configurations
import '../themeConfig.js'

// Globally Registered Components
import './globalComponents.js'

// Vue Router
import router from './router'

// Vuex Store
import store from './store/store'

// Vuesax Admin Filters
import './filters/filters'

import i18n from './i18n'

// Vuejs - Vue wrapper for hammerjs
import { VueHammer } from 'vue2-hammer'

import Axios from 'axios'

import AuthConfig from './config/Auth'

Vue.prototype.$http = Axios

if (process.env.MIX_BASE_API_URL) {
  Vue.prototype.$http.defaults.baseURL = process.env.MIX_BASE_API_URL;
}

Vue.use(VueHammer)

// PrismJS
import 'prismjs'
// import 'prismjs/themes/prism-tomorrow.css'

Vue.config.productionTip = false

Vue.router = router
Vue.axios = Axios

Vue.use(require('@websanova/vue-auth'), AuthConfig);

Vue.auth.hasPermissions = function (perm) {
  return this.options.check.call(this, perm, 'permissions');
};

App.router = Vue.router

new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount('#app')

