<template>
  <div class="mt-2 py-4">
    <div class="flex">
      <button
        class="
          bg-gray-200
          text-gray-800
          active:bg-blue-600
          font-bold
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
      <div v-if="this.currentGlobalStep == 1">
        Choose Project
      </div>
      
      <div v-if="this.currentGlobalStep == 2">
        Calculator
      </div>
        
      </button>
      <div class="flex-auto flex flex-row-reverse">
        <button
        v-if="this.currentGlobalStep == 1"
          class="
            mx-3
            bg-blue-500
            text-white
            active:bg-blue-600
            font-bold
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
          Results
        </button>
        <button
          class="
            text-blue-500
            bg-transparent
            border border-solid border-blue-500
            hover:bg-blue-500 hover:text-white
            active:bg-blue-600
            font-bold
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