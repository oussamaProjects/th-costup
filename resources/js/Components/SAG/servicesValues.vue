<template>
  <div
    v-if="resource !== null || resource !== ''"
    class="flex flex-row items-center text-center justify-stretch p-1 border-t"
  >
    <div class="px-1 w-auto hidden service_id">
      {{ resource.id }}
    </div>

    <div class="px-1 w-auto hidden sag_resources_id">
      {{ resource.sag_resources_id }}
    </div>

    <div class="px-1 w-auto text-left" style="width: 20%">
      {{ resource.name }}
    </div>

    <div class="px-1" style="width: 20%">
      <div :v-bind="resource.qty" class="qty">
        {{ resource.qty }}
      </div>
    </div>

    <div class="px-1" style="width: 15%">
      <input
        name="actual"
        v-model.number="resource.actual"
        type="number"
        min="0"
        :max="resource.qty"
        onKeyDown="return false"
        placeholder="actual"
        :class="
          'actual border-gray-300 bg-main rounded-full text-center w-14 ' +
          this.globalClass.inputTextForm
        "
        @change.prevent="calculate"
      />
    </div>

    <div class="px-1" style="width: 15%">
      <div :v-bind="resource.gap" class="gap">
        {{ resource.gap }}
      </div>
    </div>

    <div class="px-1" style="width: 20%">
      <select
        name="id_history_status"
        id="id_history_status"
        :class="
          'id_history_status border-gray-300 bg-main rounded-sm ' +
          this.globalClass.inputTextForm
        "
        :disabled="!this.history_status"
      >
        <option value="0">--</option>
        <option value="1">Absense</option>
        <option value="2">Maladie</option>
      </select>

      <textarea
        name="note"
        id="note"
        :class="
          'note border-gray-300 bg-main rounded-sm hidden ' +
          this.globalClass.inputTextForm
        "
        cols="10"
        rows="1"
      >
      </textarea>
    </div>

    <div class="px-1 w-auto hidden movement">{{ movement }}</div>

    <div class="px-1" style="width: 10%">
      <button
        type="button"
        class="my-1 px-1 text-custom_blue text-sm"
        @click="showHistories(resource.sag_resources_id)"
      >
        Histories
      </button>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      history_status: false,
      oldActual: this.resource.actual,
      movement: 0,
      resource: this.resource,
      globalClass: {
        inputSelectForm:
          "appearance-none border border-gray-300 hover:border-gray-300 focus:border-gray-300 w-full p-2 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
        inputTextForm:
          "appearance-none border-0 hover:border-gray-300 focus:border-gray-300 w-full p-1 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
      },
    };
  },

  watch: {
    resource() {
      this.oldActual = this.resource.actual;
    },
  },
  mounted() {},
  methods: {
    calculate(event) {
      var newValue = parseInt(event.target.value) ?? 0;
      this.movement = newValue - this.oldActual;
      this.$emit("calculateValues", event);
      this.history_status = true;
    },
    showHistories(event) {
      this.$emit("showHistories", event);
    },
  },
  computed: {},
  props: ["resource", "globalClass"],
};
</script>

<style>
</style>