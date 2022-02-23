<template>
  <div v-if="currentGlobalStep == 0" class="flex flex-col">
    <div class="my-4 ">
      Voulez-vous
      <a
        @click="
          createNewProject = true;
          chooseNewProject = false;
        "
        :class="this.globalClass.link"
        >saisir</a
      >
      ou
      <a
        @click="(chooseNewProject = true), (createNewProject = false)"
        :class="this.globalClass.link"
        >choisir</a
      >
      un project?
    </div>

    <div v-if="chooseNewProject" class="grid grid-cols-4 gap-2 text-xs">
      <div v-for="project in projects" v-bind:key="project.id">
        <input
          :id="'project_' + project.id"
          type="radio"
          name="selectProjects"
          class="opacity-0 absolute h-8 w-8"
          :value="project.id"
          @click="selectProjects(project.id)"
        />

        <label
          :for="'project_' + project.id"
          class="
            select-none
            bg-blue-100
            hover:bg-blue-200
            rounded
            flex flex-col flex-shrink-0
            justify-center
            items-center
            px-3
            py-2
            h-full
            cursor-pointer
          "
        >
          {{ project.name }}
        </label>
      </div>
    </div>

    <div v-if="createNewProject" class="grid grid-cols-3 gap-2 text-xs">
      <ch-project-component
        :projects="this.projects"
        :globalClass="globalClass"
      />
    </div>
  </div>
</template>

<script>
import ChProjectComponent from "../Projects/Component.vue";
export default {
  components: {
    ChProjectComponent,
  },

  data() {
    return {
      checkedProjects: [],
      createNewProject: false,
      chooseNewProject: false,
    };
  },

  mounted() {},

  methods: {
    selectProjects(project_id) {
      this.$emit("chooseProjects", project_id);
    },
  },
  props: ["projects", "currentGlobalStep", "globalClass"],
};
</script>

<style>
input:checked + label {
  background-color: rgba(147, 197, 253, var(--tw-bg-opacity));
}
</style>