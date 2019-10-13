import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        auth: {
            username: null,
            token: null,
        },
    },
    getters: {
        username(state) {
            return state.auth.username;
        },
        token(state) {
            return state.auth.token;
        },
    },
    mutations: {
        username(state, value) {
            state.auth.username = value;
        },
        token(state, value) {
            state.auth.token = value;
        },
    },
});
