<template>
  <div class="mt-2 py-4">
    <div class="flex">
      <button
        class="
          bg-gray-200
          text-gray-800
          active:bg-main
          uppercase
          text-sm
          px-6
          py-2
          shadow
          hover:shadow-lg
          outline-none
          focus:outline-none
          mr-1
          mb-1
          ease-linear
          transition-all
          duration-150
        "
        type="button"
        @click="lastStep"
        v-if="!firststep"
      >
        <div v-if="this.currentGlobalStep == 1">Choose Project</div>
        <div v-if="this.currentGlobalStep == 2">Write Actual</div>
        <div v-if="this.currentGlobalStep == 3">Recapitulative</div>
      </button>

      <div class="flex-auto flex flex-row-reverse">
        <button 
        v-if="this.currentGlobalStep == 1 || this.currentGlobalStep == 2"
          class="
            mx-3
            bg-main
            text-custom_blue
            active:bg-main
            uppercase
            text-sm
            px-6
            py-2
            shadow
            hover:shadow-lg
            outline-none
            focus:outline-none
            mr-1
            mb-1
            ease-linear
            transition-all
            duration-150
          "
          type="button"
          @click="nextStep"
        >
          
        <div v-if="this.currentGlobalStep == 1">Recapitulative</div> 
        </button>

        <button
          class="
            text-custom_blue
            bg-transparent
            border border-solid border-main
            hover:bg-secondary hover:text-custom_blue
            active:bg-secondary
            uppercase
            text-sm
            px-6
            py-3
            rounded
            outline-none
            focus:outline-none
            mr-1
            mb-1
            ease-linear
            transition-all
            duration-150
          "
          type="button"
          @click="lastStep"
          v-if="!skipStep"
        >
          Skip
        </button>
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

  methods: {
    nextStep() {
      this.$emit("global-step-change", this.currentGlobalStep + 1);
    },

    lastStep() {
      this.$emit("global-step-change", this.currentGlobalStep - 1);
    },

    skipStep() {
      this.$emit("global-step-change", this.currentGlobalStep - 1);
    },
  },

  computed: {
    active() {
      return this.step.id == this.currentGlobalStep;
    },

    firststep() {
      return this.currentGlobalStep == 0;
    },

    nextstep() {
      return this.currentGlobalStep == this.step;
    },
  },
  props: ["step", "currentGlobalStep"],
};
</script>

<style>
</style>