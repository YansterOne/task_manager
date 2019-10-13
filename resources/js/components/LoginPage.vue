<template>
    <div class="login">
        <v-form class="login__form" @submit.prevent="submit" ref="loginForm">
            <v-text-field v-model="formData.username" label="Username" :rules="[rules.required]"></v-text-field>
            <v-text-field v-model="formData.password" label="Password" type="password"
                          :rules="[rules.required]"></v-text-field>
            <v-btn block type="submit" color="primary">Login</v-btn>
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
        formData: {
          username: '',
          password: '',
        },
      };
    },
    methods: {
      submit() {
        if (!this.$refs['loginForm'].validate()) {
          return;
        }
        axios.post('/api/login', {username: this.formData.username, password: this.formData.password}).
            then(response => this.login(response.data.username, response.data.token)).catch(error => {
          this.$store.commit('errorMessage', error.response.data.message);
        });
      },
    },
  };
</script>

<style lang="scss" src="./LoginPage.scss"></style>
