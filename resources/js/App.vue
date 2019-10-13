<template>
    <div class="app">
        <login-page v-if="!isAuthorized"></login-page>
        <v-btn v-else @click="logout" dark>Logout</v-btn>
    </div>
</template>

<script>
  export default {
    name: 'App',
  };
</script>
