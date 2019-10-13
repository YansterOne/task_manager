<template>
    <div class="app">
        <login-page v-if="!isAuthorized"></login-page>
        <projects-page v-else></projects-page>
    </div>
</template>

<script>
  export default {
    name: 'App',
  };
</script>
