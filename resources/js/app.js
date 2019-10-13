import Vue from 'vue';
import App from './App.vue';
import './bootstrap';
import vuetify from './plugins/vuetify';
import auth from './mixins/auth';
import store from './store/store';

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => {
    return Vue.component(key.split('/').pop().split('.')[0],
        files(key).default);
});

Vue.mixin(auth);

const app = new Vue({
    el: '#app',
    components: {App},
    template: `<App/>`,
    vuetify,
    store,
});
