<template>
  <div
    class="
      flex
      justify-items-stretch
      items-stretch
      uppercase 
      category-sum-values
    "
  >
    <div
      class="flex items-center p-2 uppercase text-custom_blue"
      style="min-width: 120px"
    ></div>

    <div
      v-if="category"
      class="
        flex flex-row
        items-center
        text-center
        justify-center
        p-1
        border-t
        flex-grow
        relative
        h-full
      "
    >
      <div class="px-1 w-auto hidden"></div>

      <div class="px-1" style="width: 55%"></div>

      <div class="px-1" style="width: 15%">
        <div :v-bind="category.qty" class="qty">
          {{ category.qty }}
        </div>
      </div>

      <div class="px-1" style="width: 15%">
        <div :v-bind="category.actual" class="actual">
          {{ category.actual }}
        </div>
      </div>

      <div class="px-1" style="width: 15%">
        <div :v-bind="category.gap" class="gap">
          {{ category.gap }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return { 
    };
  },
  methods: { 
  },
  mounted() {},
  computed: {},
  props: ["category"],
};
</script>

<style>
</style>