require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)


import SimpleVueValidation from 'simple-vue-validator';

Vue.use(SimpleVueValidation);
const Validator = SimpleVueValidation.Validator;

const bus = new Vue();
Vue.prototype.$bus = bus;

var eventHub = new Vue();
Vue.eventHub = eventHub;

import Quiz from './components/QuizComponent.vue';
import QuizList from './components/QuizzesListComponent.vue';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/quiz',
            name: 'quiz',
            component: Quiz
        },
        {
            path: '/quiz-list',
            name: 'quizList',
            component: QuizList,
        },
    ],
});


//Vue.component('quiz-component', require('./components/QuizComponent.vue').default);
import Quiz from './components/QuizComponent.vue';
import QuizList from './components/QuizzesListComponent.vue';

// Vue.component('quizzes-list-component', require('./components/QuizzesListComponent.vue').default);

Vue.component('question-component', require('./components/QuestionComponent.vue').default);
Vue.component('choice-component', require('./components/ChoiceComponent.vue').default);
Vue.component('aside-component', require('./components/shared/AsideComponent.vue').default);
Vue.component('header-component', require('./components/shared/HeaderComponent.vue').default);


const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
