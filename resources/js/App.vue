<template>
    <v-app>
        <app-header v-if="isAuthorized"></app-header>
        <login-page v-if="!isAuthorized"></login-page>
        <projects-page v-else></projects-page>
        <notification-message></notification-message>
    </v-app>
</template>

<script>
  export default {
    name: 'App',
  };
</script>
