<template>
  <jet-dialog-modal :show="showUpdateModal" @click="closeModal">
    <template #title>Ajouter une categorie </template>

    <template #content>
      <ch-services-update
        :services="services"
        :categories="categories"
        :service="service"
        :globalClass="this.globalClass"
      />
    </template>

    <template #footer>
      <jet-secondary-button @click="closeModal"> Cancel </jet-secondary-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import ChServicesUpdate from "./UpdateForm.vue";

import JetDialogModal from "@/Jetstream/DialogModal.vue";

export default {
  components: {
    JetDialogModal,
    ChServicesUpdate,
  },

  data() {
    return {
      showUpdateModal: this.showUpdateModal,
    };
  },

  props: [
    "services",
    "service",
    "showUpdateModal",
    "globalClass",
    "categories",
  ],

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