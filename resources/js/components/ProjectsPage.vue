<template>
    <div class="projects">
        <div class="projects__list">
            <project-card v-for="(project, index) in projects" :name="project.name" :id="project.id"
                          :tasks="project.tasks" :key="keyForProject(project)" @update="updateProject(index, $event)"
                          @delete="deleteProject(index)"
            ></project-card>
        </div>
        <div class="project__add">
            <v-btn @click="addProject" color="primary">Add project</v-btn>
        </div>
    </div>
</template>

<script>
  import uuid from 'uuid';

  export default {
    name: 'ProjectsPage',
    data() {
      return {
        projects: [],
      };
    },
    computed: {
      keyForProject() {
        return (project) => project.id ? project.id : project.key;
      },
    },
    mounted() {
      this.loadProjects();
    },
    methods: {
      loadProjects() {
        axios.get('/api/projects').then(response => {
          this.projects = response.data;
        }).catch(error => {
          this.$store.commit('errorMessage', error.response.data.message);
        });
      },
      addProject() {
        this.projects.push({name: '', key: uuid()});
      },
      updateProject(index, data) {
        this.$set(this.projects, index, data);
      },
      deleteProject(index) {
        this.projects.splice(index, 1);
      },
    },
  };
</script>

<style lang="scss" src="./ProjectsPage.scss"></style>
