<template>
    <div class="app-header">
        <v-container class="app-header__container">
            <div class="app-header__link" @click="logout">Logout</div>
        </v-container>
    </div>
</template>

<script>
  export default {
    name: 'Header',
  };
</script>

<style src="./AppHeader.scss" lang="scss"></style>

