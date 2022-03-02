<template>
  <div class="w-full relative p-4 border-b border-tertiary">
    <div class="uppercase font-medium text-custom_blue my-4">Gestion des catégories</div>
    <div class="shadow rounded-sm p-3">
      <ch-categories-create
        :categories="categories"
        :servicesCategories="servicesCategories"
        :category="category"
        :globalClass="globalClass"
      />
    </div>

    <div class="flex">
      <div class="ml-auto p-1">
        <a
          href="#"
          :class="this.globalClass.link"
          @click="displayListeCategoriesModal = !displayListeCategoriesModal"
          >Liste des categories
        </a>
      </div>
    </div>

    <jet-dialog-modal
      :show="displayListeCategoriesModal"
      @close="closeListeCategoriesModal"
    >
      <template #title>Liste des categories </template>

      <template #content>
        <ch-categories-liste
          :formattedCategories="formattedCategories"
          :categories="categories"
          :category="category"
          :globalClass="globalClass"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListeCategoriesModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChCategoriesCreate from "./CreateForm.vue";
import ChCategoriesListe from "./Liste.vue";

export default {
  components: {
    JetDialogModal,
    ChCategoriesCreate,
    ChCategoriesListe,
  },

  data() {
    return {
      category: {
        id: null,
        name: null,
        description: null,
        parent_id: null,
      },
      displayListeCategoriesModal: false,
      displayAddCategoriesModal: false,
    };
  },

  props: ["categories", "formattedCategories","servicesCategories", "globalClass"],

  mounted() {},

  methods: {
    showListeCategoriesModal() {
      this.displayListeCategoriesModal = false;
    },
    closeListeCategoriesModal() {
      this.displayListeCategoriesModal = false;
    },
  },
};
</script>

<style>
</style>

