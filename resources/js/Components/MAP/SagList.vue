<template>
  <div class="sag-list absolute right-2 top-2 w-96">
    <Carousel :autoplay="3000" :wrap-around="true">
      <slide
        v-for="(category, index) in sagFormatted"
        v-bind:key="index"
        class="cats"
      >
        <div :set="(catParentName = category.parent_name)"></div>
        <div class="flex flex-col w-full m-1">
          <ch-category-head></ch-category-head>

          <div
            :data-category_id="category.id"
            :data-category_parent_id="category.parent_id"
            :data-category_parent_name="category.parent_name"
            class="flex flex-col w-full bg-gray-100 shadow-md px-2"
            :class="'category mb-1 category_' + category.id"
          >
            <di v>
              <div
                v-if="catParentName != category.parent_name"
                class="
                  p-2
                  text-center
                  uppercase
                  text-sm
                  bg-gray-100
                  text-custom_blue
                "
              >
                {{ category.parent_name }}
              </div>
            </di>

            <div
              class="
                flex
                justify-items-stretch
                items-stretch
                resources
                relative
                w-full
              "
            >
              <div
                class="flex items-center justify-start"
                style="min-width: 120px"
              >
                {{ category.name }}
              </div>

              <div class="w-full">
                <div
                  v-for="resource in category.services"
                  v-bind:key="resource.id"
                  :class="'resource resource_' + resource.id"
                  :data-resource_id="resource.id"
                >
                  <ch-resource-row
                    v-if="resource"
                    :resource="resource"
                  ></ch-resource-row>
                </div>
              </div>
            </div>

            <!-- <ch-category-row :category="category"></ch-category-row> -->
          </div>
        </div>
      </slide>

      <template #addons>
        <!-- <navigation /> -->
        <!-- <pagination /> -->
      </template>
    </Carousel>
  </div>
</template>

<script>
import ChResourceRow from "./ResourceRow.vue";
import ChCategoryHead from "./categoriesHead.vue";
import ChCategoryRow from "./CategoryRow.vue";

// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

export default {
  components: {
    ChCategoryHead,
    ChCategoryRow,
    ChResourceRow,
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },

  data() {
    return {};
  },

  mounted() {},
  computed: {
    sagFormatted() {
      return this.sag.filter(function (item) {
        return item.services.length;
      });
    },
  },

  props: ["sag"],
};
</script>

<style>
.cats {
  font-size: 9px !important;
}

.carousel__slide {
  align-items: flex-start;
}
</style>