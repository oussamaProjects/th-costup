<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2">
      <div
        v-if="$page.props.flash.failures.form.store.projects"
        class="alert w-full text-xs text-red-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.projects }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.projects"
        class="alert w-full text-xs text-green-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.projects }}
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">
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

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
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
      project: {
        name: null,
        description: null, 
      }, 
    };
  },

  props: ["projects", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.post("/projects", this.project);
      this.project.id = null;
      this.project.name = null;
      this.project.description = null;
    },
  },
};
</script>

<style>
</style>