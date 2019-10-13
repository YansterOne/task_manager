<template>
    <v-snackbar v-model="show" color="error" top>
        {{ errorMessage }}
        <v-btn dark text @click="show = false">
            Close
        </v-btn>
    </v-snackbar>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    name: 'NotificationMessage',
    data() {
      return {
        show: false,
      };
    },
    computed: {
      ...mapGetters({errorMessage: 'errorMessage'}),
    },
    watch: {
      errorMessage(value) {
        if (value !== '') {
          this.show = true;
        }
      },
      show(value) {
        if (!value) {
          this.$store.commit('errorMessage', '');
        }
      },
    },
  };
</script>
