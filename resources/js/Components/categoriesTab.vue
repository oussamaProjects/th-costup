<template>
  <!-- Tabs Start -->
  <ul
    class="flex -mb-px"
    id="myTab"
    data-tabs-toggle="#myTabContent"
    role="tablist"
    v-if="this.currentGlobalStep == 1"
  >
    <span :set="(liCatParentIndex = 0)"></span>

    <div v-for="(category, index) in mainCategories" v-bind:key="index">
      <li
        v-if="liCatParentName != category.parent_name"
        class="mr-2"
        role="presentation"
        :title="category.parent_name"
      >
        <span :set="(liCatParentIndex += 1)"></span>
        <a
          class="
            inline-block
            text-xs
            font-medium
            text-center
            p-2
            uppercase
            border
          "
          :id="'cat_' + liCatParentIndex + '-tab'"
          :data-tabs-target="'cat_' + liCatParentIndex"
          type="button"
          role="tab"
          :aria-controls="'cat_' + liCatParentIndex"
          aria-selected="false"
          @click.prevent="setActive"
          :class="
            isActive('cat_' + liCatParentIndex)
              ? 'text-custom_blue bg-main hover:text-custom_blue hover:border-main hover:bg-white'
              : 'hover:text-custom_blue hover:border-main hover:bg-white'
          "
          :href="'#cat_' + liCatParentIndex"
        >
          {{ liCatParentIndex }} - {{ category.parent_name }}
        </a>
      </li>
      <span :set="(liCatParentName = category.parent_name)"></span>
    </div>
  </ul>
  <!-- End Tabs -->
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },

    setActive(event) { 
      this.$emit("setActive", event); 
    },
  },
  props: ["mainCategories", "currentGlobalStep", "activeItem"],
};
</script>

<style>
</style>