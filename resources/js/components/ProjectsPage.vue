<template>
    <div class="projects">
        <div class="projects__list">
            <project-card v-for="(project, index) in projects" :name="project.name" :id="project.id" :key="index"
                          @update="updateProject(index, $event)" @delete="deleteProject(index)"
            ></project-card>
        </div>
        <div class="project__add">
            <v-btn dark @click="addProject">Add project</v-btn>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ProjectsPage',
    data() {
      return {
        projects: [],
      };
    },
    mounted() {
      this.loadProjects();
    },
    methods: {
      loadProjects() {
        axios.get('/api/projects').then(response => {
          this.projects = response.data;
        });
      },
      addProject() {
        this.projects.push({name: ''});
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
