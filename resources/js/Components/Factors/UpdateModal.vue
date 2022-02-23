<template>
  <jet-dialog-modal :show="showUpdateModal" @click="closeModal">
    <template #title>Ajouter une factor </template>

    <template #content>
      <ch-factors-update :factors="factors" :factor="factor" :globalClass="this.globalClass"/>
    </template>

    <template #footer>
      <jet-secondary-button @click="closeModal"> Cancel </jet-secondary-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import ChFactorsUpdate from "./UpdateForm.vue";

import JetDialogModal from "@/Jetstream/DialogModal.vue";

export default {
  components: {
    JetDialogModal,
    ChFactorsUpdate,
  },

  data() {
    return { 
      showUpdateModal: this.showUpdateModal, 
    };
  },

  props: ["factors", "factor", "showUpdateModal", "globalClass"],

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