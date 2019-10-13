export default {
    mounted() {
        this.username = localStorage.getItem('username');
        this.token = localStorage.getItem('token');
    },
    computed: {
        username: {
            get() {
                return this.$store.getters.username;
            },
            set(value) {
                this.$store.commit('username', value);
            },
        },
        token: {
            get() {
                return this.$store.getters.token;
            },
            set(value) {
                this.$store.commit('token', value);
            },
        },
        isAuthorized() {
            return (this.username !== null && this.token !== null);
        },
    },
    methods: {
        login(username, token) {
            this.username = username;
            this.token = token;
            localStorage.setItem('username', username);
            localStorage.setItem('token', token);
        },
        logout() {
            this.username = null;
            this.token = null;
            localStorage.removeItem('username');
            localStorage.removeItem('token');
        },
    },
};
