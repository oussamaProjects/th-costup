<template>
  <jet-dialog-modal :show="showUpdateModal" @click="closeModal">
    <template #title>Ajouter une categorie </template>

    <template #content>
      <ch-categories-update :categories="categories" :category="category" :globalClass="this.globalClass"/>
    </template>

    <template #footer>
      <jet-secondary-button @click="closeModal"> Cancel </jet-secondary-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import ChCategoriesUpdate from "./UpdateForm.vue";

import JetDialogModal from "@/Jetstream/DialogModal.vue";

export default {
  components: {
    JetDialogModal,
    ChCategoriesUpdate,
  },

  data() {
    return { 
      showUpdateModal: this.showUpdateModal, 
    };
  },

  props: ["categories", "category", "showUpdateModal", "globalClass"],

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