<template>
  <div class="w-full relative p-2">
    <div class="shadow rounded-sm p-3">
      <ch-factors-create
        :factors="factors"
        :factor="factor"
        :globalClass="globalClass"
      />
    </div>

    <div class="flex">
      <div class="ml-auto p-1">
        <a
          href="#"
          :class="this.globalClass.link"
          @click="displayListeFactorsModal = !displayListeFactorsModal"
          >Liste des factors
        </a>
      </div>
    </div>

    <jet-dialog-modal
      :show="displayListeFactorsModal"
      @close="closeListeFactorsModal"
    >
      <template #title>Liste des factors </template>

      <template #content>
        <ch-factors-liste 
          :factors="factors"
          :factor="factor"
          :globalClass="globalClass"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListeFactorsModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChFactorsCreate from "./CreateForm.vue";
import ChFactorsListe from "./Liste.vue";

export default {
  components: {
    JetDialogModal,
    ChFactorsCreate,
    ChFactorsListe,
  },

  data() {
    return {
      factor: {
        id: null,
        name: null,
        value: null,
        type: null,
        parent_id: null,
      },
      displayListeFactorsModal: false,
      displayAddFactorsModal: false,
    };
  },

  props: ["factors", "globalClass"],

  mounted() { },

  methods: {
    showListeFactorsModal() {
      this.displayListeFactorsModal = false;
    },
    closeListeFactorsModal() {
      this.displayListeFactorsModal = false;
    },
  },
};
</script>

<style>
</style>

