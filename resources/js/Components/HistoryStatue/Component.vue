<template>
  <div class="w-full relative p-4 border-b border-tertiary">
    <div class="uppercase font-medium text-custom_blue my-4">
      Gestion des history statues
    </div>
    <div class="shadow rounded-sm p-3">
      <ch-history-statue-create
        :history_statues="history_statues"
        :ChildCategories="ChildCategories"
        :statue="statue"
        :globalClass="globalClass"
      />
    </div>

    <div class="flex">
      <div class="ml-auto p-1">
        <a
          href="#"
          :class="this.globalClass.link"
          @click="
            displayListHistoryStatuesModal = !displayListHistoryStatuesModal
          "
          >Liste des history statues
        </a>
      </div>
    </div>

    <jet-dialog-modal
      :show="displayListHistoryStatuesModal"
      @close="closeListHistoryStatuesModal"
    >
      <template #title>Liste des history statues </template>

      <template #content>
        <ch-history-statues-list
          :ChildCategories="ChildCategories"
          :history_statues="history_statues"
          :statue="statue"
          :globalClass="globalClass"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListHistoryStatuesModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChHistoryStatueCreate from "./CreateForm.vue";
import ChHistoryStatuesList from "./List.vue";

export default {
  components: {
    JetDialogModal,
    ChHistoryStatueCreate,
    ChHistoryStatuesList,
  },

  data() {
    return {
      statue: {
        id: null,
        name: null,
        description: null,
        category_id: null,
      },
      displayListHistoryStatuesModal: false,
      displayAddCategoriesModal: false,
    };
  },

  props: ["history_statues", "ChildCategories", "globalClass"],

  mounted() {},

  methods: { 
    closeListHistoryStatuesModal() {
      this.displayListHistoryStatuesModal = false;
    },
  },
};
</script>

<style>
</style>

