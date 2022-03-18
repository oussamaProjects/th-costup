<template>
  <div>
    <div class="w-full relative p-4 border-b border-tertiary">
      <div class="uppercase font-medium text-custom_blue my-4">Neveling</div>
      <div class="shadow rounded-sm p-3">
        <ch-form
          :projects="projects"
          :project="project"
          :globalClass="globalClass"
        />
      </div>
    </div>

    <div class="w-full relative p-4 border-b border-tertiary">
      <div class="uppercase font-medium text-custom_blue my-4">Counter</div>
      <!-- <ch-timer-component></ch-timer-component> -->
      <ch-time-tracker-component></ch-time-tracker-component>
    </div>
    
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChForm from "./Form.vue";
import ChTimerComponent from "../Timer/TimerComponent.vue";
import ChTimeTrackerComponent from "../Timer/TimeTrackerComponent.vue";

export default {
  components: {
    JetDialogModal,
    ChForm,
    ChTimerComponent,
    ChTimeTrackerComponent,
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

  props: ["projects", "globalClass"],

  mounted() {},

  methods: {},
};
</script>

<style>
</style>

