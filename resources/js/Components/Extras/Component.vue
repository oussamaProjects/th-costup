<template>
  <div class="w-full relative p-2">
    <div class="w-1/2">
      <div class="uppercase font-medium text-custom_blue my-4"></div>
      <ch-extras-create
        :project_id="project_id"
        :extras="extras"
        :globalClass="globalClass"
      />
    </div>
  </div>
</template>

<script>
import ChExtrasCreate from "./CreateForm.vue";

export default {
  components: {
    ChExtrasCreate,
  },

  data() {
    return {
      extras: {
        smph_custommer_demand: null,
        smph_production_available_time: null,
        lmph_custommer_demand: null,
        lmph_production_available_time: null,
      },
    };
  },

  props: ["project_id", "extras", "globalClass"],

  mounted() {},

  methods: {},
};
</script>

<style>
</style>

