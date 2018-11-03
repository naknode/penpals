
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueAWN from "vue-awesome-notifications"
require("vue-awesome-notifications/dist/styles/style.css")

Vue.use(VueAWN)
Vue.component('registration-wizard', require('./components/RegistrationWizard.vue'));
Vue.component('user-avatar', require('./components/UserAvatar.vue'));
Vue.component('manage-language', require('./components/ManageLanguage.vue'));
Vue.component('lindua-icon', require('./components/utils/LinduaIcon.vue'));

const app = new Vue({
    el: '#app'
});
