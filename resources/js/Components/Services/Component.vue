<template>
  <div class="w-full relative p-4 border-b border-tertiary">
    <div class="uppercase font-medium text-custom_blue my-4">Gestion des Ressources</div>
    <div class="shadow rounded-sm p-3">
      <ch-services-create
        :services="services"
        :categories="categories"
        :service="service"
        :globalClass="globalClass"
      />
    </div>

    <div class="flex">
      <div class="ml-auto p-1">
      <a
        href="#"
        :class="this.globalClass.link"
        @click="displayListeServicesModal = !displayListeServicesModal"
        >Liste des services
      </a>
    </div>
    </div>

    <jet-dialog-modal
      :show="displayListeServicesModal"
      @close="closeListeServicesModal"
    >
      <template #title>Liste des services </template>

      <template #content>
        <ch-services-liste
          :formattedServices="formattedServices"
          :services="services"
          :categories="categories"
          :service="service"
          :globalClass="globalClass"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListeServicesModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChServicesCreate from "./CreateForm.vue";
import ChServicesListe from "./Liste.vue";

export default {
  components: {
    JetDialogModal,
    ChServicesCreate,
    ChServicesListe,
  },

  data() {
    return {
     service: {
        name: null,
        description: null,
        unit_measure: null,
        qty: null,
        occup_hour: null,
        price: null,
        profit_margin_p_c: null,
        category_id: null,
      },
      displayListeServicesModal: false,
      displayAddServicesModal: false,
    };
  },

  props: ["services", "formattedServices", "categories", "globalClass"],

  mounted() {},

  methods: {
    showListeservicesModal() {
      this.displayListeServicesModal = false;
    },
    closeListeServicesModal() {
      this.displayListeServicesModal = false;
    },
  },
};
</script>

<style>
</style>

