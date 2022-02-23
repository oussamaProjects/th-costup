<template>
  <jet-dialog-modal :show="showUpdateModal" @click="closeModal">
    <template #title>Ajouter une project </template>

    <template #content>
      <ch-projects-update :projects="projects" :project="project" :globalClass="this.globalClass"/>
    </template>

    <template #footer>
      <jet-secondary-button @click="closeModal"> Cancel </jet-secondary-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import ChProjectsUpdate from "./UpdateForm.vue";

import JetDialogModal from "@/Jetstream/DialogModal.vue";

export default {
  components: {
    JetDialogModal,
    ChProjectsUpdate,
  },

  data() {
    return { 
      showUpdateModal: this.showUpdateModal, 
    };
  },

  props: ["projects", "project", "showUpdateModal", "globalClass"],

  mounted() {},

  methods: {
    closeModal() {
      this.$emit("close-modal");
    },
  },
};
</script>

<style>
</style>