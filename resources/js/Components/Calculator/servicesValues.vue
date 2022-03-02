<template>
  <div
    v-if="service !== null || service !== ''"
    class="flex flex-row items-center text-center justify-stretch p-1 border-t"
  >
    <div class="px-1 w-auto hidden service_id" style="width: 15%">
      {{ service.id }}
    </div>

    <div class="px-1 w-auto text-left" style="width: 15%">
      {{ service.name }}
    </div>

    <div class="px-1" style="width: 5%">
      {{ service.unit_measure }}
    </div>

    <div class="px-1" style="width: 8%">
      <input
        name="qty"
        v-model.number="service.qty"
        type="number"
        placeholder="qty"
        :class="'qty border-gray-300 bg-main rounded-full text-center ' + this.globalClass.inputTextForm"
        @change.prevent="calculate"
      />
    </div>

    <div class="px-1" style="width: 8%">
      <div :v-bind="service.ratio_metre_hour" class="ratio_metre_hour">
        {{ service.ratio_metre_hour }}
      </div>
    </div>

    <div class="px-1" style="width: 8%">
      <input
        name="occup hour"
        v-model="service.occup_hour"
        type="number"
        placeholder="occup hour"
        :class="'occup_hour border-gray-300 bg-main rounded-full text-center ' + this.globalClass.inputTextForm"
        @change.prevent="calculate"
      />
    </div>

    <div class="px-1" style="width: 8%">
      <!-- <input
        name="price"
        v-model.number="service.price"
        type="number"
        placeholder="price"
        :class="'price border-gray-300 bg-main rounded-full text-center ' + this.globalClass.inputTextForm"
        @change.prevent="calculate"
      /> -->

      <div :v-bind="service.price" class="price">
        {{ service.price }}
      </div>
    </div>

    <div class="px-1" style="width: 8%">
      <!-- 
        <input
              :value="total"
              type="number"
              :class="'total border-gray-300 bg-main rounded-full text-center ' + this.globalClass.inputTextForm"
              name="total"
              placeholder="Total"
              v-model.number="total"
            /> 
            -->
      <div :v-bind="service.subTotal" class="subTotal">
        {{ service.subTotal }}
      </div>
    </div>

    <div class="px-1" style="width: 8%">
      <div :v-bind="service.marge" class="marge">
        {{ service.marge }}
      </div>
    </div>

    <div class="px-1" style="width: 8%">
      <input
        name="profit_margin_p_c"
        v-model="service.profit_margin_p_c"
        type="number"
        placeholder="profit_margin_p_c"
        :class="'profit_margin_p_c border-gray-300 bg-main rounded-full text-center ' + this.globalClass.inputTextForm"
        @change.prevent="calculate"
      />
    </div>

    <div class="px-1" style="width: 8%">
      <div :v-bind="service.marge_subTotal" class="marge_subTotal">
        {{ service.marge_subTotal }}
      </div>
    </div>

    <div class="px-1" style="width: 16%">
      <button
        name="save"
        @click="removeRow(service.id)"
        class="text-custom_blue w-full bg-secondary rounded-xs py-1 px-2"
      >
        Retirer
      </button>
    </div>
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
    removeRow(event) {
      this.$emit("removeRow", event);
    },
  },
  computed: {},
  props: ["service", "globalClass"],
};
</script>

<style>
</style>