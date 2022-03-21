<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2 relative">
      <div
        v-if="$page.props.flash.failures.form.store.clients"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.clients }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.clients"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.clients }}
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">
        <div class="mb-2">
          <div class="text-xs">Name</div>

          <input
            id="name"
            v-model="client.name"
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
          <div class="text-xs">Description</div>
          <input
            id="description"
            v-model="client.description"
            type="text"
            placeholder="Description"
            :class="this.globalClass.inputTextForm"
          />
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.description"
          >
            {{ $page.props.errors.description }}
          </div>
        </div>

        <div class="mb-2">
          <div class="text-xs">Address</div>
          <input
            id="address"
            v-model="client.address"
            type="text"
            placeholder="Address"
            :class="this.globalClass.inputTextForm"
          />
          <div
            :class="this.globalClass.textError"
            v-if="$page.props.errors.address"
          >
            {{ $page.props.errors.address }}
          </div>
        </div>
      </div>

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
          <button
            type="submit"
            :disabled="client.processing"
            :class="this.globalClass.buttonForm"
          >
            Register
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="client.progress"
          :value="client.progress.percentage"
          max="100"
        >
          {{ client.progress.percentage }}%
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
      client: this.client,
      isLoading: false,
    };
  },

  props: ["client", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      var _this = this;
      _this.isLoading = true;

      this.$inertia.post("/clients", this.client);
      this.client.id = null;
      this.client.name = null;
      this.client.description = null;
      this.client.address = null;

      _this.isLoading = false;
    },
  },
};
</script>

<style>
</style>