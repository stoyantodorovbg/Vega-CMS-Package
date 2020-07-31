import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        locale: document.getElementById('app').getAttribute('data-locale'),
    },
    getters: {
      locale: state => {
          if(state.locale) {
              return state.locale + '/';
          }

          return '';
      }
    },

    mutations: {},

    actions: {}
});
