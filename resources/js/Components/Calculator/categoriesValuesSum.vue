<template>
  <div
    class="
      flex
      justify-items-stretch
      items-stretch 
      text-xs
      uppercase
      bg-main
      category-sum-values
    "
  >
    <div
      class="flex items-center p-2 uppercase text-custom_blue"
      style="min-width: 240px"
    ></div>

    <div
      v-if="category"
      class="
        flex flex-row
        items-center
        text-center
        justify-center
        p-1
        border-t
        flex-grow
        relative
        h-full
      "
    >
      <div class="px-1 w-auto" style="width: 15%"></div>

      <div class="px-1" style="width: 5%"></div>

      <div class="px-1" style="width: 8%">
        <div :v-bind="category.qty" class="qty">
          {{ category.qty }}
        </div>
      </div>

      <div class="px-1" style="width: 8%"></div>

      <div class="px-1" style="width: 8%">
        <div :v-bind="category.occup_hour" class="occup_hour">
          {{ category.occup_hour }}
        </div>
      </div>

      <div class="px-1" style="width: 8%">
        <div :v-bind="category.price" class="price">
          {{ category.price }}
        </div>
      </div>

      <div class="px-1" style="width: 8%">
        <div :v-bind="category.subTotal" class="subTotal">
          {{ category.subTotal }}
        </div>
      </div>

      <div class="px-1" style="width: 8%">
        <div :v-bind="category.marge" class="marge">
          {{ category.marge }}
        </div>
      </div>

      <div class="px-1" style="width: 8%">
        <div :v-bind="category.profit_margin_p_c" class="profit_margin_p_c">
          {{ category.profit_margin_p_c }}
        </div>
      </div>

      <div class="px-1" style="width: 8%">
        <div
          :v-bind="category.marge_subTotal"
          class="marge_subTotal text-error font-medium"
        >
          {{ category.marge_subTotal }}
        </div>
      </div>

      <div class="px-1 flex" style="width: 16%">
        <div
          class="
            bg-success
            w-full
            text-white
            rounded-xs
            py-1
            px-2
            add
            cursor-pointer
            text-center
          "
          v-if="!enableEdit"
          :data-enable-edit="category.id"
          @click="categoryEditValues"
        >
          Edit
        </div>

        <div
          class="
            bg-error
            w-full
            text-white
            rounded-xs
            py-1
            px-2
            add
            cursor-pointer
            text-center
          "
          v-if="!enableSave"
          @click="categorySumValues"
        >
          Enregistrer
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      enableEdit: false,
      enableSave: true,
    };
  },
  methods: {
    categorySumValues(event) {
      this.enableSave = !this.enableSave;
      this.enableEdit = false;
      this.$emit("getCategorySumValues", event);
    },
    categoryEditValues(event) {
      this.enableSave = false;
      this.enableEdit = !this.enableEdit;
      this.$emit("getCategoryEditValues", event);
    },
  },
  mounted() {},
  computed: {},
  props: ["category", "isLoading"],
};
</script>

<style>
</style>