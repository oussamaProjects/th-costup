<template>
  <div class="flex flex-col text-xs">
    <div class="flex flex-row w-full font-bold uppercase">
      <div class="flex-1 py-2">Statue</div>
      <div class="flex-1 py-2">Movement</div>
      <div class="flex-1 py-2">Note</div>
      <div class="flex-1 py-2">Date de creation</div>
    </div>
    <template v-for="history in histories" v-bind:key="history.id">
      <div class="flex flex-row w-full">
        <div class="flex-1">{{ history.statue_name }}</div>
        <div class="flex-1">{{ history.movement }}</div>
        <div class="flex-1">{{ history.note }}</div>
        <div class="flex-1">{{ history.created_at }}</div>
      </div>
    </template>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      checkedServices: [],
    };
  },

  props: ["resource", "histories"],

  mounted() {},

  methods: {
    closeUpdateModal() {
      this.displayUpdateServicesModal = false;
    },
  },
};
</script>

<style>
</style>