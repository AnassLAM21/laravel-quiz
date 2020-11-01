require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import SimpleVueValidation from 'simple-vue-validator';
Vue.use(SimpleVueValidation);
const Validator = SimpleVueValidation.Validator;


const bus = new Vue();
Vue.prototype.$bus = bus;


var eventHub = new Vue();
Vue.eventHub = eventHub;

Vue.component('quiz-component', require('./components/QuizComponent.vue').default);
Vue.component('question-component', require('./components/QuestionComponent.vue').default);
Vue.component('choice-component', require('./components/ChoiceComponent.vue').default);
Vue.component('aside-component', require('./components/shared/AsideComponent.vue').default);
Vue.component('header-component', require('./components/shared/HeaderComponent.vue').default);



const app = new Vue({
    el: '#app'
});
