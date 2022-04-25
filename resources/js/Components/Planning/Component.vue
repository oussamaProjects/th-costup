<template>
  <div>
    <div class="w-full relative p-4 border-b border-tertiary">
      <div class="uppercase font-medium text-custom_blue my-4">Planning</div>
      <div class="shadow rounded-sm p-3">
        <ch-form
          :shifts="shifts"
          :days="days"
          :globalClass="globalClass"
        />
        
      </div>
    </div>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChForm from "./Form.vue";

export default {
  components: {
    JetDialogModal,
    ChForm,
  },

  data() {
    return {
      project: {
        id: null,
        name: null,
        description: null,
        parent_id: null,
      },
    };
  },

  props: ["days", "shifts","globalClass"],

  mounted() {},

  methods: {},
};
</script>

<style>
</style>

