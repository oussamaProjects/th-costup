<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2">
      <div
        v-if="$page.props.flash.failures.form.store.factors"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.factors }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.factors"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.factors }}
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">

        <div class="mb-2">
          <input
            id="name"
            v-model="factor.name"
            type="text"
            placeholder="Name"
            :class="this.globalClass.inputTextForm"
          /> 
          <div :class="this.globalClass.textError" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</div>
        </div>

        <div class="mb-2">
          <input
            id="value"
            v-model="factor.value"
            type="text"
            placeholder="value"
            :class="this.globalClass.inputTextForm"
          /> 
        </div>

         <div class="mb-2">
          <input
            id="type"
            v-model="factor.type"
            type="text"
            placeholder="type"
            :class="this.globalClass.inputTextForm"
          /> 
        </div>
       
      </div>

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
          <button
            type="submit"
            :disabled="factor.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="factor.progress"
          :value="factor.progress.percentage"
          max="100"
        >
          {{ factor.progress.percentage }}%
        </progress>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  components: {},

  data() {
    return { 
      factor: {
        name: null,
        value: null, 
        type: null, 
      }, 
    };
  },

  props: ["factors", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.post("/factors", this.factor);
      this.factor.id = null;
      this.factor.name = null;
      this.factor.value = null;
      this.factor.type = null;
    },
  },
};
</script>

<style>
</style>