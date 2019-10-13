<template>
    <v-app>
        <transition-group name="fade">
            <app-header v-if="isAuthorized" key="header"></app-header>
            <login-page v-if="!isAuthorized" key="login"></login-page>
            <projects-page v-else key="projects"></projects-page>
        </transition-group>
        <notification-message></notification-message>
    </v-app>
</template>

<script>
  export default {
    name: 'App',
  };
</script>
