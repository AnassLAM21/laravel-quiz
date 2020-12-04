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



const Quiz = require('./components/QuizComponent.vue').default;
const QuizList = require('./components/QuizzesListComponent.vue').default;

const routes = [
    { 
      path: '/',
      name: 'quiz-list', 
      component: QuizList 
    },
    { 
      path: '/quiz/:id', 
      name: 'quiz',
      component: Quiz,
      params: true
    },
  ];
  

  const router = new VueRouter({
    routes // short for `routes: routes`
  });




//Vue.component('quiz-component', require('./components/QuizComponent.vue').default);

// Vue.component('quizzes-list-component', require('./components/QuizzesListComponent.vue').default);

// Vue.component('question-component', require('./components/QuestionComponent.vue').default);
// Vue.component('choice-component', require('./components/ChoiceComponent.vue').default);
 Vue.component('aside-component', require('./components/shared/AsideComponent.vue').default);
 Vue.component('header-component', require('./components/shared/HeaderComponent.vue').default);


const app = new Vue({
    el:'#app',
    router
  });
