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
      <div class="px-1 w-auto hidden"></div>

      <div class="px-1" style="width: 20%"></div>

      <div class="px-1" style="width: 20%">
        <div :v-bind="category.qty" class="qty">
          {{ category.qty }}
        </div>
      </div>

      <div class="px-1" style="width: 20%">
        <div :v-bind="category.actual" class="actual">
          {{ category.actual }}
        </div>
      </div>

      <div class="px-1" style="width: 20%">
        <div :v-bind="category.gap" class="gap">
          {{ category.gap }}
        </div>
      </div>

      <div class="px-1 flex" style="width: 20%">
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