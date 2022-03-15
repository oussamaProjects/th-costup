<template>
  <div class="project-intro absolute left-0 top-0 p-3 bg-gray-100 shadow-sm rounded">
    <div class="name text-2xl uppercase">{{ project.name ?? "" }}</div>
    <div class="description text-sm">{{ project.description }}</div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {};
  },

  mounted() {},

  props: ["project"],
};
</script>

<style>
</style>