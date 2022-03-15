<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2">
      <div
        v-if="$page.props.flash.failures.form.store.history_statues"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.history_statues }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.history_statues"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.history_statues }}
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">
        <div class="mb-2">
          <input
            id="name"
            v-model="statue.name"
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
            v-model="statue.description"
            type="text"
            placeholder="Description"
            :class="this.globalClass.inputTextForm"
          />
        </div>

        <div class="mb-2">
          <select
            id="category_id"
            v-model="statue.category_id"
            :class="this.globalClass.inputTextForm"
          >
            <option disabled selected>Choisir une catégorie</option>
            <option value="0">--</option>
            <option
              v-for="category in this.ChildCategories"
              v-bind:key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.category_id"
          >
            {{ $page.props.errors.category_id }}
          </div>
        </div>
      </div>

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
          <button
            type="submit"
            :disabled="statue.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="statue.progress"
          :value="statue.progress.percentage"
          max="100"
        >
          {{ statue.progress.percentage }}%
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
      statue: {
        name: null,
        description: null,
        category_id: null,
      },
    };
  },

  props: ["history_statues", "globalClass", "ChildCategories"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.post("/history_statues", this.statue);
      this.statue.id = null;
      this.statue.name = null;
      this.statue.description = null;
    },
  },
};
</script>

<style>
</style>