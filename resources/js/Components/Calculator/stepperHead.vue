<template>
  <div class="py-4">
    <div class="grid grid-cols-3 gap-4 w-full m-auto">
      <div :class="'border-t-4 ' + activeBorderStep1 + ' pt-4'">
        <p :class="'uppercase ' + activeTextStep1 + ' font-bold'">Step 1</p>
        <p class="font-semibold">Choose Project</p>
      </div>
      <div :class="'border-t-4 ' + activeBorderStep2 + ' pt-4'">
        <p :class="'uppercase ' + activeTextStep2 + ' font-bold'">Step 2</p>
        <p class="font-semibold">Calculator</p>
      </div>
      <div :class="'border-t-4 ' + activeBorderStep3 + ' pt-4'">
        <p :class="'uppercase  ' + activeTextStep3 + ' font-bold'">Step 3</p>
        <p class="font-semibold">Results</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    activeTextStep1() {
      return this.currentGlobalStep == 0 ||
        this.currentGlobalStep == 1 ||
        this.currentGlobalStep == 2
        ? "text-blue-500"
        : "text-gray-400";
    },
    activeBorderStep1() {
      return this.currentGlobalStep == 0 ||
        this.currentGlobalStep == 1 ||
        this.currentGlobalStep == 2
        ? "border-blue-500"
        : "border-gray-200";
    },

    activeTextStep2() {
      return this.currentGlobalStep == 1 || this.currentGlobalStep == 2
        ? "text-blue-500"
        : "text-gray-400";
    },
    activeBorderStep2() {
      return this.currentGlobalStep == 1 || this.currentGlobalStep == 2
        ? "border-blue-500"
        : "border-gray-200";
    },

    activeTextStep3() {
      return this.currentGlobalStep == 2 ? "text-blue-500" : "text-gray-400";
    },
    activeBorderStep3() {
      return this.currentGlobalStep == 2
        ? "border-blue-500"
        : "border-gray-200";
    },
  },
  mounted() {},
  props: ["currentGlobalStep"],
};
</script>

<style>
</style>