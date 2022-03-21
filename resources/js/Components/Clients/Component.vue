<template>
  <div class="w-full relative p-4 border-b border-tertiary">
    <div class="uppercase font-medium text-custom_blue my-4">
      Gestion des clients
    </div>
    <div class="shadow rounded-sm p-3">
      <div class="uppercase font-medium text-custom_blue my-4"></div>
      <ch-client-create :client="client" :globalClass="globalClass" />
    </div>

    <div class="flex">
      <div class="ml-auto p-1">
        <a
          href="#"
          :class="this.globalClass.link"
          @click="displayListeClientsModal = !displayListeClientsModal"
          >Liste des clients
        </a>
      </div>
    </div>

    <jet-dialog-modal
      :show="displayListeClientsModal"
      @close="closeListeClientsModal"
    >
      <template #title>Liste des clients </template>

      <template #content>
        
        <ch-clients-list
          :clients="clients"
          :client="client"
          :globalClass="globalClass"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListeClientsModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChClientCreate from "./CreateForm.vue";
import ChClientsList from "./List.vue";

export default {
  components: {
    ChClientCreate,
    ChClientsList,
    JetDialogModal,
  },

  data() {
    return {
      client: {
        name: null,
        description: null,
        address: null,
      },
      displayListeClientsModal: false,
      displayAddClientsModal: false,
    };
  },

  props: ["clients", "globalClass"],

  mounted() {},

  methods: {
    showListeClientsModal() {
      this.displayListeClientsModal = false;
    },
    closeListeClientsModal() {
      this.displayListeClientsModal = false;
    },
  },
};
</script>

<style>
</style>

