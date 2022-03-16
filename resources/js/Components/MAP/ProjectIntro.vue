<template>
  <div class="project-intro absolute left-16 top-16 p-3 text-left rounded w-48">
    <div class="name text-2xl font-bold uppercase text-custom_red">{{ project.name ?? "" }}</div>
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