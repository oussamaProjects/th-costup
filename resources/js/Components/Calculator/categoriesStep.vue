<template>
  <div class="step-wrapper flex justify-between" :class="stepWrapperClass">
    <button
      type="button"
      class="my-3 px-3 text-custom_blue font-bold uppercase text-sm"
      @click="lastStep"
      v-if="!firststep"
    >
      Back
    </button>

    <div class="flex-auto flex flex-row-reverse">
      <button
        type="button"
        class="my-3 px-3 text-custom_blue font-bold uppercase text-sm"
        @click="nextStep"
        v-if="!laststep"
      >
        Next
      </button>
    </div>
    <!-- <button
      type="submit"
      class="
        mx-3 
        text-custom_blue
        font-bold
        uppercase
        text-sm 
      "
      v-if="laststep"
    >
      Submit
    </button> -->
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
      this.$emit("step-change", this.currentstep + 1);
    },

    lastStep() {
      this.$emit("step-change", this.currentstep - 1);
    },
  },
  mounted() {
    
  },
  computed: {
    active() {
      return this.step.id == this.currentstep;
    },

    firststep() {
      return this.currentstep == 0;
    },

    laststep() {
      return this.currentstep == this.stepcount;
    },
  },
  props: ["step", "stepcount", "currentstep"],
};
</script>

<style>
</style>