<template>
  <div
    v-if="factor !== null || factor !== ''"
    class="flex flex-row items-center justify-items-stretch p-1 border-t"
  >
    <div class="px-1 w-auto hidden factor_id" style="width: 15%">
      {{ factor.id }}
    </div>

    <div class="px-1 w-auto" style="width: 24%">
      {{ factor.name }}
    </div>

    <div class="px-1" style="width: 20%">
      {{ factor.value }}
    </div>

    <!-- 
    <div class="px-1" style="width: 8%">
      <div :v-bind="factor.type" class="type">
        {{ factor.type }}
      </div>
    </div> -->

    <div class="px-1 ml-auto" style="width: 16%">
      <button
        name="save"
        @click="removeRow(factor)"
        class="text-custom_blue w-full bg-green-100 rounded-xs py-1 px-2"
      >
        Retirer
      </button>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      factor: this.factor,
      globalClass: {
        inputSelectForm:
          "appearance-none border border-gray-300 hover:border-gray-300 focus:border-gray-300 w-full p-2 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
        inputTextForm:
          "appearance-none border-0 hover:border-gray-300 focus:border-gray-300 rounded-sm w-full p-1 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
      },
    };
  },
  mounted() {},
  methods: {
    calculate(event) {
      this.$emit("calculateProjectValues", event);
    },
    removeRow(event) {
      console.log(event);
      this.$emit("removeFactorRow", event);
    },
  },
  computed: {},
  props: ["factor", "globalClass"],
};
</script>

<style>
</style>