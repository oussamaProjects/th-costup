<template>
  <div class="flex flex-col text-xs">
    <template v-for="history in histories" v-bind:key="history.id">
      <div class="flex flex-row w-full">
        <div class="flex-1">
          {{ history.id }}
        </div>

        <div class="flex-1">
          {{ history.movement }}
        </div>

        <div class="flex-1">
          {{ history.note }}
        </div>

        <div class="flex-1">
          {{ history.created_at }}
        </div>
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