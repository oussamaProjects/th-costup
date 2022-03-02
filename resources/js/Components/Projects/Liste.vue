<template>
  <div
    v-if="$page.props.flash.failures.list.projects"
    class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.failures.list.projects }}
  </div>

  <div
    v-if="$page.props.flash.success.list.projects"
    class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.success.list.projects }}
  </div>

  <table class="table-fixe w-full text-sm">
    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
      <tr>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Nom</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Description</div>
        </th> 
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left text-center">Actions</div>
        </th>
      </tr>
    </thead>
    <tbody class="text-xs m divide-y divide-gray-100">
      <tr v-for="project in this.projects" v-bind:key="project.id">
        <td class="p-1 whitespace-wrap">{{ project.name }}</td>
        <td class="p-1 whitespace-wrap">{{ project.description }}</td> 

        <td class="p-1 whitespace-wrap flex items-center justify-center">
          <a href="#" @click="showUpdateProjectsModal(project.id)">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="text-success h-3 w-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
              />
            </svg>
          </a>
          <a href="#" @click="deleteCategory(project.id)">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="ml-2 text-error h-3 w-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
          </a>
        </td>
      </tr>
    </tbody>
  </table>

  <ch-update-modal
    :showUpdateModal="displayUpdateProjectsModal"
    :projects="projects"
    :project="project"
    @closeModal="closeUpdateModal"
    :globalClass="this.globalClass"
  ></ch-update-modal>
</template>

<script>
import ChUpdateModal from "./UpdateModal.vue";

export default {
  components: {
    ChUpdateModal,
  },

  data() {
    return {
      project: this.project,
      displayUpdateProjectsModal: false,
    };
  },

  props: [ "projects", "project", "globalClass"],

  mounted() {},

  methods: {
    showUpdateProjectsModal(id) {
      axios.get(`/projects/${id}`).then((res) => {
        this.project.id = res.data.id;
        this.project.name = res.data.name;
        this.project.description = res.data.description; 
      });

      this.displayUpdateProjectsModal = true;
    },

    deleteCategory(id) {
      this.$inertia.delete(`/projects/${id}`);
    },

    closeUpdateModal() {
      this.project = {
        naem: null,
        description: null, 
      };
      this.displayUpdateProjectsModal = false;
    },
  },
};
</script>

<style>
</style>