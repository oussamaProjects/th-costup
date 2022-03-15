<template>
  <div
    v-if="resource !== null || resource !== ''"
    class="flex flex-row items-center text-center justify-stretch p-2 border-t"
  >
    <div class="px-1 w-auto hidden resource_id">
      {{ resource.id }}
    </div>

    <div class="px-1 w-auto text-left" style="width: 70%">
      {{ resource.name ?? '' }}
    </div>

    <div class="px-1" style="width: 10%">
      <div :v-bind="resource.qty" class="qty">
        {{ resource.qty }}
      </div>
    </div>

    <div class="px-1" style="width: 10%">
      <div :v-bind="resource.actual" class="actual">
        {{ resource.actual }}
      </div>
    </div>

    <div class="px-1" style="width: 10%">
      <div :v-bind="resource.gap" class="gap">
        {{ resource.gap }}
      </div>
    </div>
 
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  mounted() {},
  methods: {},
  computed: {},
  props: ["resource"],
};
</script>

<style>
</style>