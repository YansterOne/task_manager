<template>
    <v-list-item class="task-item">
        <template v-slot>
            <v-list-item-action class="task-item__status">
                <v-checkbox v-model="checkStatus"></v-checkbox>
            </v-list-item-action>
            <v-list-item-content class="task-item__content">
                <v-list-item-title v-if="!edit">{{ name }}</v-list-item-title>
                <v-form v-else class="task-item__edit" ref="taskItemEdit">
                    <v-text-field v-model="formData.name" label="Task" :rules="[rules.required]"
                                  validate-on-blur></v-text-field>
                </v-form>
            </v-list-item-content>
            <div class="project-card__controls">
                <v-btn v-if="!edit" @click="edit = !edit" color="primary">
                    <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn v-else color="primary" @click="update">Save</v-btn>
                <v-btn color="primary" @click="deleteTask">
                    <v-icon>mdi-delete</v-icon>
                </v-btn>
            </div>
        </template>
    </v-list-item>
</template>
<script>
  import validation from '../mixins/validation';

  export default {
    name: 'TaskItem',
    mixins: [validation],
    props: {
      id: {
        type: Number,
        required: true,
      },
      projectId: {
        type: Number,
        required: true,
      },
      name: {
        type: String,
        required: true,
      },
      status: {
        type: String,
        required: true,
      },
      deadline: {
        type: String,
        required: false,
        default: null,
      },
      priority: {
        type: Number,
        required: true,
      },
    },
    data() {
      return {
        edit: false,
        formData: {
          name: this.name,
          status: this.status,
          deadline: this.deadline,
          priority: this.priority,
        },
      };
    },
    computed: {
      checkStatus: {
        get() {
          return this.formData.status === 'done';
        },
        set(value) {
          this.formData.status = value ? 'done' : 'undone';
        },
      },
    },
    watch: {
      checkStatus() {
        this.updateStatus();
      },
    },
    methods: {
      updateStatus() {
        axios.put('/api/tasks/' + this.id, {
          name: this.name,
          status: this.formData.status,
          deadline: this.deadline,
          priority: this.priority,
          project_id: this.projectId,
        }).then(response => {
          this.$emit('update', response.data);
        });
      },
      update() {
        if (!this.$refs['taskItemEdit'].validate()) {
          return;
        }
        axios.put('/api/tasks/' + this.id, {
          name: this.formData.name,
          status: this.formData.status,
          deadline: this.formData.deadline,
          priority: this.formData.priority,
          project_id: this.projectId,
        }).then(response => {
          this.$emit('update', response.data);
          this.edit = false;
        });
      },
      deleteTask() {
        axios.delete('/api/tasks/' + this.id).then(() => {
          this.$emit('delete');
        });
      },
    },
  };
</script>

<style src="./TaskItem.scss" lang="scss"></style>
