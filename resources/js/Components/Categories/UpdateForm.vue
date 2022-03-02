<template>
  <form @submit.prevent="submit" class="bg-white">
    <input id="id" v-model="category.id" type="hidden" />
    
    <div class="flex flex-wrap -mb-2">
      <div
        v-if="$page.props.flash.failures.form.update.categories"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.update.categories }}
      </div>

      <div
        v-if="$page.props.flash.success.form.update.categories"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.update.categories }}
      </div>

      <div class="w-full md:w-2/3 pr-2">
        <div class="mb-2">
          <input
            id="name"
            v-model="category.name"
            type="text"
            placeholder="Name"
            :class="this.globalClass.inputTextForm"
          />
          <div :class="this.globalClass.textError" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</div>
        </div>
        <div class="mb-2">
          <input
            id="description"
            v-model="category.description"
            type="text"
            placeholder="Description"
            :class="this.globalClass.inputTextForm"
          /> 
        </div>

        <div class="mb-2">
          <select
            id="parent_id"
            v-model="category.parent_id"
            :class="this.globalClass.inputTextForm"
          >
            <option disabled selected>Choisir une catégorie</option>
            <option value="0">--</option>
            <option
              v-for="category in this.categories"
              v-bind:key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select> 
          <div :class="this.globalClass.textError" v-if="$page.props.errors.parent_id">{{ $page.props.errors.parent_id }}</div>
        </div>
      </div>

      <div class="w-full md:w-1/3 flex flex-col">
        <div class="mb-2">
          <button
            type="submit"
            :disabled="category.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="category.progress"
          :value="category.progress.percentage"
          max="100"
        >
          {{ category.progress.percentage }}%
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

  props: ["categories", "category", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.put(`/categories/${this.category.id}`, this.category);
    },
  },
};
</script>

<style>
</style>