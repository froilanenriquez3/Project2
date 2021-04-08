/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'


window.Vue = require('vue').default;
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-recursos-moviles', require('./components/MainRecursosMovilesComponent.vue').default);
Vue.component('main-usuarios', require('./components/MainUsuariosComponent.vue').default);
Vue.component('alertants-form', require('./components/alertantsComponent.vue').default);
Vue.component('alertants-delete', require('./components/alertantsDeleteComponent.vue').default);
Vue.component('tipus-alertants', require('./components/tipusAlertantsComponent.vue').default);
Vue.component('filter-select', require('./components/filterSelect.vue').default);
Vue.component('video-component', require('./components/videoComponent.vue').default);
Vue.component('tipus-recursos', require('./components/tipusRecursosComponent.vue').default);
Vue.component('mapa-incidencies', require('./components/mapComponent.vue').default);
Vue.component('help-box', require('./components/helpBoxComponent.vue').default);
Vue.component('incidencies-component', require('./components/incidenciesComponent.vue').default);
Vue.component('alertant-form', require('./components/alertantFormComponent.vue').default);
Vue.component('sidebar-component', require('./components/sidebarComponent.vue').default);
Vue.component('container-recursos', require('./components/ContainerRecursosMovilesComponent.vue').default);
Vue.component('afectat-form', require('./components/afectatFormComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
