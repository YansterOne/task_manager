<template>
    <v-card class="project-card">
        <v-card-title class="project-card__header">
            <div v-if="!edit" class="project-card__title">
                <div class="project-card__title-text">{{ name }}</div>
                <v-btn dark @click="edit = !edit">
                    <v-icon>mdi-pencil</v-icon>
                </v-btn>
            </div>
            <v-form v-else class="project-card__edit" ref="projectCardEdit">
                <v-text-field v-model="editName" :rules="[rules.required]" validate-on-blur></v-text-field>
                <v-btn dark @click="saveProject">Save</v-btn>
            </v-form>
            <div class="project-card__controls">
                <v-btn dark @click="deleteProject">
                    <v-icon>mdi-delete</v-icon>
                </v-btn>
            </div>
        </v-card-title>
        <div v-for="(task, index) in tasks" :key="index">
            {{ task.name }}
        </div>
    </v-card>
</template>

<script>
  import validation from '../mixins/validation';

  export default {
    name: 'ProjectCard',
    mixins: [validation],
    props: {
      name: {
        type: String,
        required: true,
      },
      id: {
        type: Number,
        required: false,
        default: null,
      },
      tasks: {
        type: Array,
        required: false,
        default: () => [],
      },
    },
    data() {
      return {
        edit: this.id === null,
        editName: this.name,
      };
    },
    methods: {
      saveProject() {
        if (!this.$refs['projectCardEdit'].validate()) {
          return;
        }
        if (this.id === null) {
          this.create();
        } else {
          this.update();
        }
      },
      deleteProject() {
        if (this.id) {
          axios.delete('/api/projects/' + this.id).then(() => this.$emit('delete'));
        } else {
          this.$emit('delete');
        }
      },
      update() {
        axios.put('/api/projects/' + this.id, {name: this.editName}).then(response => {
          this.$emit('update', response.data);
          this.edit = false;
        });
      },
      create() {
        axios.post('/api/projects', {name: this.editName}).then(response => {
          this.$emit('update', response.data);
          this.edit = false;
        });
      },
    },
  };
</script>

<style lang="scss" src="./ProjectCard.scss"></style>
