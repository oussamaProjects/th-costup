<template>
  <form @submit.prevent="submit" class="bg-white">
    <input id="id" v-model="client.id" type="hidden" />

    <div class="flex flex-wrap -mb-2">
      <div
        v-if="$page.props.flash.failures.form.update.clients"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.update.clients }}
      </div>

      <div
        v-if="$page.props.flash.success.form.update.clients"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.update.clients }}
      </div>

      <div class="w-full md:w-2/3 pr-2">
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
        </div>
      </div>

      <div class="w-full md:w-1/3 flex flex-col">
        <div class="mb-2">
          <button
            type="submit"
            :disabled="client.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
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

  props: ["client", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      this.$inertia.put(`/clients/${this.client.id}`, this.client);
    },
  },
};
</script>

<style>
</style>