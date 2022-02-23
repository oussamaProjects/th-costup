<template>
  <app-layout>
    <template #header> Catgories </template>
    <div
      class="py-4"
      v-for="category in this.categories"
      v-bind:key="category.id"
    >
      <div class="mx-8">
        <div class="text-4xl">{{ category.name }}</div>
        <div class="text-base">{{ category.discreption }}</div>
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

  props: ["categories"],

  mounted() {},
};
</script>