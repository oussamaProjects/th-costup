<template>
  <app-layout>
    <template #header> History statues </template>
    <div
      class="py-4"
      v-for="history_statue in this.history_statues"
      v-bind:key="history_statue.id"
    >
      <div class="mx-8">
        <div class="text-4xl">{{ history_statue.name }}</div>
        <div class="text-base">{{ history_statue.description }}</div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
  components: {
    AppLayout,
  },

  data() { 
  },

  props: ["history_statues"],

  mounted() {},
};
</script>