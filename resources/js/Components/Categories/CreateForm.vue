<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-wrap -mb-2">
      <div
        v-if="$page.props.flash.failures.form.store.categories"
        class="alert w-full text-xs text-red-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.categories }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.categories"
        class="alert w-full text-xs text-green-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.categories }}
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
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.name"
          >
            {{ $page.props.errors.name }}
          </div>
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
              v-for="category in this.servicesCategories"
              v-bind:key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.parent_id"
          >
            {{ $page.props.errors.parent_id }}
          </div>
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
      category: {
        name: null,
        description: null,
        parent_id: null,
      },
    };
  },

  props: ["categories", "globalClass", "servicesCategories"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.post("/categories", this.category);
      this.category.id = null;
      this.category.name = null;
      this.category.description = null;
    },
  },
};
</script>

<style>
</style>