<template>
  <form @submit.prevent="submit" class="bg-white">
    <input id="id" v-model="project.id" type="hidden" />
    
    <div class="flex flex-wrap -mb-2">
      <div
        v-if="$page.props.flash.failures.form.update.projects"
        class="alert w-full text-xs text-red-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.update.projects }}
      </div>

      <div
        v-if="$page.props.flash.success.form.update.projects"
        class="alert w-full text-xs text-green-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.update.projects }}
      </div>

      <div class="w-full md:w-2/3 pr-2">
        <div class="mb-2">
          <input
            id="name"
            v-model="project.name"
            type="text"
            placeholder="Name"
            :class="this.globalClass.inputTextForm"
          />
          <div :class="this.globalClass.textError" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</div>
        </div>
        <div class="mb-2">
          <input
            id="description"
            v-model="project.description"
            type="text"
            placeholder="Description"
            :class="this.globalClass.inputTextForm"
          /> 
        </div>

        
      </div>

      <div class="w-full md:w-1/3 flex flex-col">
        <div class="mb-2">
          <button
            type="submit"
            :disabled="project.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="project.progress"
          :value="project.progress.percentage"
          max="100"
        >
          {{ project.progress.percentage }}%
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

  props: ["projects", "project", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.put(`/projects/${this.project.id}`, this.project);
    },
  },
};
</script>

<style>
</style>