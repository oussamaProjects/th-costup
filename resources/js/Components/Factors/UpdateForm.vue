<template>
  <form @submit.prevent="submit" class="bg-white">
    <input id="id" v-model="factor.id" type="hidden" />
    
    <div class="flex flex-wrap -mb-2">
      <div
        v-if="$page.props.flash.failures.form.update.factors"
        class="alert w-full text-red-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.update.factors }}
      </div>

      <div
        v-if="$page.props.flash.success.form.update.factors"
        class="alert w-full text-green-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.update.factors }}
      </div>

      <div class="w-full md:w-2/3 pr-2">
      
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

      <div class="w-full md:w-1/3 flex flex-col">
        <div class="mb-2">
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
      globalClass: {
        inputTextForm: this.globalClass.inputTextForm,
        buttonForm: this.globalClass.buttonForm,
        link: this.globalClass.link,
      },
    };
  },

  props: ["factors", "factor", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.put(`/factors/${this.factor.id}`, this.factor);
    },
  },
};
</script>

<style>
</style>