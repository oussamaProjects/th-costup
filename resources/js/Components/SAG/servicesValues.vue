<template>
  <div
    v-if="service !== null || service !== ''"
    class="flex flex-row items-center text-center justify-stretch p-1 border-t"
  >
    <div class="px-1 w-auto hidden service_id" >
      {{ service.id }}
    </div>

    <div class="px-1 w-auto text-left" style="width: 20%">
      {{ service.name }}
    </div>

    <div class="px-1" style="width: 20%">
      <input
        name="qty"
        v-model.number="service.qty"
        type="number"
        placeholder="qty"
        :class="
          'qty border-gray-300 bg-main rounded-full text-center w-14 ' +
          this.globalClass.inputTextForm
        "
        @change.prevent="calculate"
      />
    </div>
    <div class="px-1" style="width: 20%">
      <input
        name="actual"
        v-model.number="service.actual"
        type="number"
        min="0"
        :max="service.qty"
        placeholder="actual"
        :class="
          'actual border-gray-300 bg-main rounded-full text-center w-14 ' +
          this.globalClass.inputTextForm
        "
        @change.prevent="calculate"
      />
    </div>

    <div class="px-1" style="width: 20%">
      <div :v-bind="service.gap" class="gap">
        {{ service.gap }}
      </div>
    </div>

    <div class="px-1" style="width: 20%"></div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      service: this.service,
      globalClass: {
        inputSelectForm:
          "appearance-none border border-gray-300 hover:border-gray-300 focus:border-gray-300 w-full p-2 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
        inputTextForm:
          "appearance-none border-0 hover:border-gray-300 focus:border-gray-300 w-full p-1 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
      },
    };
  },
  mounted() {},
  methods: {
    calculate(event) {
      this.$emit("calculateValues", event);
    },
  },
  computed: {},
  props: ["service", "globalClass"],
};
</script>

<style>
</style>