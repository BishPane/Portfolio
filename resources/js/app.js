require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');
Vue.component('mainapp', require('./mainapp.vue').default);
Vue.component('login', require('./admin/login.vue'));

import common from './common'
import router from './router'



Vue.mixin(common)

const app = new Vue({
    el: '#app',
    router
});