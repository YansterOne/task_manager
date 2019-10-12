<template>
    <div class="login">
        <v-form class="login__form" @submit.prevent="login" ref="loginForm">
            <v-text-field v-model="username" label="Username" :rules="[rules.required]" outlined></v-text-field>
            <v-text-field v-model="password" label="Password" type="password" :rules="[rules.required]"
                          outlined></v-text-field>
            <v-btn dark block type="submit">Login</v-btn>
        </v-form>
    </div>
</template>

<script>
  import validation from '../mixins/validation';

  export default {
    name: 'Login',
    mixins: [validation],
    data() {
      return {
        username: '',
        password: '',
      };
    },
    methods: {
      login() {
        if (!this.$refs['loginForm'].validate()) {
          return;
        }
        axios.post('/api/login', {username: this.username, password: this.password}).then(response => {
          console.log(response);
        });
      },
    },
  };
</script>

<style lang="scss" src="./LoginPage.scss"></style>
