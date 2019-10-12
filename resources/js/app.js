import './bootstrap';
import Vue from 'vue';
import App from './App.vue';

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => {
    return Vue.component(key.split('/').pop().split('.')[0],
        files(key).default);
});

const app = new Vue({
    el: '#app',
    components: {App},
    template: `<App/>`,
});
