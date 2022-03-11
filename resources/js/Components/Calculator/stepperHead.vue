<template>
  <div class="py-4">
    <div class="grid grid-cols-5 gap-3 w-full m-auto">
      <div :class="'border-t-4 ' + activeBorderStep1 + ' pt-4'">
        <p :class="'uppercase ' + activeTextStep1 + ' font-semibold'">Step 1</p>
        <p class="font-medium">Choisissez ou ajoutez un projet</p>
      </div>
      <div :class="'border-t-4 ' + activeBorderStep2 + ' pt-4'">
        <p :class="'uppercase ' + activeTextStep2 + ' font-semibold'">Step 2</p>
        <p class="font-medium">Combiner les ressources</p>
      </div>
      <div :class="'border-t-4 ' + activeBorderStep3 + ' pt-4'">
        <p :class="'uppercase  ' + activeTextStep3 + ' font-semibold'">
          Step 3
        </p>
        <p class="font-medium">Ajouter des facteurs</p>
      </div>

      <div :class="'border-t-4 ' + activeBorderStep4 + ' pt-4'">
        <p :class="'uppercase  ' + activeTextStep4 + ' font-semibold'">
          Step 4
        </p>
        <p class="font-medium">SMPH/LMPH</p>
      </div>

      <div :class="'border-t-4 ' + activeBorderStep5 + ' pt-4'">
        <p :class="'uppercase  ' + activeTextStep5 + ' font-semibold'">
          Step 5
        </p>
        <p class="font-medium">Résultats</p>
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
        this.currentGlobalStep == 2 ||
        this.currentGlobalStep == 3 ||
        this.currentGlobalStep == 4
        ? "text-custom_blue"
        : "text-gray-400";
    },
    activeBorderStep1() {
      return this.currentGlobalStep == 0 ||
        this.currentGlobalStep == 1 ||
        this.currentGlobalStep == 2 ||
        this.currentGlobalStep == 3 ||
        this.currentGlobalStep == 4
        ? "border-secondary"
        : "border-gray-200";
    },

    activeTextStep2() {
      return this.currentGlobalStep == 1 ||
        this.currentGlobalStep == 2 ||
        this.currentGlobalStep == 3 ||
        this.currentGlobalStep == 4
        ? "text-custom_blue"
        : "text-gray-400";
    },
    activeBorderStep2() {
      return this.currentGlobalStep == 1 ||
        this.currentGlobalStep == 2 ||
        this.currentGlobalStep == 3 ||
        this.currentGlobalStep == 4
        ? "border-secondary"
        : "border-gray-200";
    },

    activeTextStep3() {
      return this.currentGlobalStep == 2 ||
        this.currentGlobalStep == 3 ||
        this.currentGlobalStep == 4
        ? "text-custom_blue"
        : "text-gray-400";
    },
    activeBorderStep3() {
      return this.currentGlobalStep == 2 ||
        this.currentGlobalStep == 3 ||
        this.currentGlobalStep == 4
        ? "border-secondary"
        : "border-gray-200";
    },

    activeTextStep4() {
      return this.currentGlobalStep == 3 || this.currentGlobalStep == 4
        ? "text-custom_blue"
        : "text-gray-400";
    },
    activeBorderStep4() {
      return this.currentGlobalStep == 3 || this.currentGlobalStep == 4
        ? "border-secondary"
        : "border-gray-200";
    },
  },
  mounted() {},
  props: ["currentGlobalStep"],
};
</script>

<style>
</style>