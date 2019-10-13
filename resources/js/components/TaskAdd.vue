<template>
    <v-form class="task-add" ref="taskAddForm" @submit.prevent="createTask">
        <v-text-field v-model="name" :rules="[rules.required, rules.maxLength]" class="task-add__input"></v-text-field>
        <v-btn color="primary" class="task-add__btn" type="submit">Add Task</v-btn>
    </v-form>
</template>

<script>
  import validation from '../mixins/validation';

  export default {
    name: 'TaskAdd',
    mixins: [validation],
    props: {
      projectId: {
        type: Number,
        required: true,
      },
    },
    data() {
      return {
        name: '',
        priority: 0,
        deadline: null,
        status: 'undone',
      };
    },
    methods: {
      createTask() {
        if (!this.$refs['taskAddForm'].validate()) {
          return;
        }
        axios.post('/api/tasks', {
          name: this.name,
          priority: this.priority,
          deadline: this.deadline,
          status: this.status,
          project_id: this.projectId,
        }).then(response => {
          this.$emit('create', response.data);
          this.$refs['taskAddForm'].reset();
        }).catch(error => {
          this.$store.commit('errorMessage', error.response.data.message);
        });
      },
    },
  };
</script>

<style src="./TaskAdd.scss" lang="scss"></style>
