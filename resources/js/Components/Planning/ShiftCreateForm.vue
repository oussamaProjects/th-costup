<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2 relative">
      <div
        v-if="$page.props.flash.failures.form.store.shifts"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.shifts }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.shifts"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.shifts }}
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">
        <div class="mb-2">
          <div class="text-xs">Name</div>

          <input
            id="name"
            v-model="shift.name"
            type="text"
            placeholder="Name"
            :class="this.globalClass.inputTextForm"
          />
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.name"
          >
            {{ $page.props.errors.name }}
          </div>
        </div>

        <div class="mb-2">
          <div class="text-xs">Resource</div>
          <input
            id="resource"
            v-model="shift.resource"
            type="text"
            placeholder="Resource"
            :class="this.globalClass.inputTextForm"
          />
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.resource"
          >
            {{ $page.props.errors.resource }}
          </div>
        </div>
 
      </div>

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
          <button
            type="submit"
            :disabled="shift.processing"
            :class="this.globalClass.buttonForm"
          >
            Register
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="shift.progress"
          :value="shift.progress.percentage"
          max="100"
        >
          {{ shift.progress.percentage }}%
        </progress>
      </div>

      <ChCircleLoader v-if="isLoading" :color="'#3b82f6'"></ChCircleLoader>
    </div>
  </form>
</template>

<script>
import ChCircleLoader from "../CircleLoader.vue";

export default {
  components: { ChCircleLoader },

  data() {
    return {
      shift: this.shift,
      isLoading: false,
    };
  },

  props: ["shift", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      var _this = this;
      _this.isLoading = true;

      this.$inertia.post("/shifts", this.shift);
      this.shift.id = null;
      this.shift.name = null;
      this.shift.resource = null; 

      _this.isLoading = false;
    },
  },
};
</script>

<style>
</style>