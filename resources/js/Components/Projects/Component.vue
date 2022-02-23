<template>
  <div class="w-full relative p-2">
    <div class="shadow rounded-sm p-3">
      <ch-projects-create
        :projects="projects"
        :project="project"
        :globalClass="globalClass"
      />
    </div>

    <div class="flex">
      <div class="ml-auto p-1">
        <a
          href="#"
          :class="this.globalClass.link"
          @click="displayListeProjectsModal = !displayListeProjectsModal"
          >Liste des projects
        </a>
      </div>
    </div>

    <jet-dialog-modal
      :show="displayListeProjectsModal"
      @close="closeListeProjectsModal"
    >
      <template #title>Liste des projects </template>

      <template #content>
        <ch-projects-liste 
          :projects="projects"
          :project="project"
          :globalClass="globalClass"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListeProjectsModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChProjectsCreate from "./CreateForm.vue";
import ChProjectsListe from "./Liste.vue";

export default {
  components: {
    JetDialogModal,
    ChProjectsCreate,
    ChProjectsListe,
  },

  data() {
    return {
      project: {
        id: null,
        name: null,
        description: null,
        parent_id: null,
      },
      displayListeProjectsModal: false,
      displayAddProjectsModal: false,
    };
  },

  props: ["projects", "globalClass"],

  mounted() { },

  methods: {
    showListeProjectsModal() {
      this.displayListeProjectsModal = false;
    },
    closeListeProjectsModal() {
      this.displayListeProjectsModal = false;
    },
  },
};
</script>

<style>
</style>

