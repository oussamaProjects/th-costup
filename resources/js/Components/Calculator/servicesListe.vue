<template>
  <div class="flex flex-col">
    <div class="grid grid-cols-4 gap-2 text-xs">
      <div v-for="service in services" v-bind:key="service.id" >
        <input
          :id="'service_' + service.id"
          type="checkbox"
          name="selectedServices"
          class="opacity-0 absolute h-8 w-8"
          :value="service.id"
          v-model="checkedServices"
        />

        <label
          :for="'service_' + service.id"
          class="
            select-none
            bg-main
            hover:bg-main 
            rounded
            flex flex-col flex-shrink-0
            justify-center
            items-center 
            px-3
            py-2
            h-full
            cursor-pointer
          "
        >
          {{ service.name }}
        </label>
      </div>
    </div>
    <div class="flex flex-col items-end justify-end">
      <button class="px-2 py-1 rounded mt-2 bg-main text-custom_blue text-sm" @click="selectServices()">Add services</button>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      checkedServices: [],
    };
  },

  props: ["category", "services"],

  mounted() {},

  methods: {
    closeUpdateModal() {
      this.displayUpdateServicesModal = false;
    },

    selectServices() {
      this.$emit("addServices", this.checkedServices);
    },
  },
};
</script>

<style>
input:checked + label {
	background-color: rgba(147, 197, 253, var(--tw-bg-opacity));
}
</style>