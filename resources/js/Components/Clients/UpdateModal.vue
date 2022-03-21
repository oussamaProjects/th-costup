<template>
  <jet-dialog-modal :show="showUpdateModal" @click="closeModal">
    <template #title>Ajouter un Client </template>

    <template #content>
      <ch-clients-update :client="client" :globalClass="this.globalClass" />
    </template>

    <template #footer>
      <jet-secondary-button @click="closeModal"> Cancel </jet-secondary-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import ChClientsUpdate from "./UpdateForm.vue";

import JetDialogModal from "@/Jetstream/DialogModal.vue";

export default {
  components: {
    JetDialogModal,
    ChClientsUpdate,
  },

  data() {
    return {
      showUpdateModal: this.showUpdateModal,
    };
  },

  props: ["client", "showUpdateModal", "globalClass"],

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