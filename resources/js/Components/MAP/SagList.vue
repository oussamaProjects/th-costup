<template>
  <div class="sag-list absolute right-0 top-0 w-96">
    <div :set="(catParentIndex = 0)"></div>
    <div
      v-for="(category, index) in sag"
      v-bind:key="index"
      class="cats relative right-0 top-0 left-0 bottom-0 p-2 bg-white w-full"
    >
      <!-- <div v-if="catParentName != category.parent_name">
        <div :set="(catParentIndex += 1)"></div>
      </div>

      <div :set="(catParentName = category.parent_name)"></div>-->
      <div
        :data-category_id="category.id"
        :data-category_parent_id="category.parent_id"
        :data-category_parent_name="category.parent_name"
        class="flex flex-col w-full bg-gray-100 shadow-sm px-2 "
        :class="'category mb-1 category_' + category.id"
      >
      <!--  <div>
          <div
            v-if="catParentName != category.parent_name"
            class="p-2 text-center uppercase text-sm bg-gray-100 text-custom_blue"
          >
            {{ category.parent_name }}
          </div>
        </div> -->

        <div
          class="flex justify-items-stretch items-stretch resources relative w-full"
        >
          <div class="flex items-center justify-center" style="min-width: 120px">
            {{ category.name }}
          </div>

          <div class="w-full">
            <div
              v-for="resource in category.services"
              v-bind:key="resource.id"
              :class="'resource resource_' + resource.id"
              :data-resource_id="resource.id"
            >
              <ch-resource-row :resource="resource"></ch-resource-row>
            </div>
          </div>
        </div>

        <ch-category-row :category="category"></ch-category-row>
      </div>
    </div>
  </div>
</template>

<script>
import ChResourceRow from "./ResourceRow.vue";
import ChCategoryRow from "./CategoryRow.vue";

export default {
  components: { ChResourceRow, ChCategoryRow },

  data() {
    return {};
  },

  mounted() {},

  props: ["sag"],
};
</script>

<style>
.cats {
  font-size: 8px !important;
}
</style>