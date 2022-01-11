/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue').default;

//import Vue from 'vue'
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';


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

Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);

Vue.component('welcome-page', require('./components/WelcomePage.vue').default);
Vue.component('mission-vision', require('./components/MissionVissionComponent.vue').default);

Vue.component('register-page', require('./components/RegisterPage.vue').default);
Vue.component('login-page', require('./components/LoginPage.vue').default);


Vue.component('about-page', require('./components/AboutPage.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.use(Buefy);


const app = new Vue({
    el: '#app',
});
