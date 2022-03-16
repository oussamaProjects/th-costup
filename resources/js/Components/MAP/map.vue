<template>
  <div class="map absolute top-0 left-0 right-0 bottom-0 w-full h-full">
    <Carousel :autoplay="500000" :wrapAround="true">
      <slide v-for="project in projects" v-bind:key="project.id">
        <div class="carousel__item w-full">
          <ch-interactive-map 
            :mainOeuvre="project.main_oeuvre"
            :imgSrc="image"
          ></ch-interactive-map>
          <ch-project-intro :project="project"></ch-project-intro>
          <ch-sag-list :sag="project.sag"></ch-sag-list>
          <ch-alert
            :message="'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente dolor accusamus veritatis quos!'"
          ></ch-alert>
        </div>
      </slide>
    </Carousel>
  </div>
</template>

<script>
import ChProjectIntro from "./ProjectIntro.vue";
import ChSagList from "./SagList.vue";
import ChInteractiveMap from "./InteractiveMap.vue";
import ChAlert from "./alert.vue";

// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

export default {
  components: {
    ChProjectIntro,
    ChSagList,
    ChInteractiveMap,
    ChAlert,
    Carousel, 
    Slide,
    Pagination,
    Navigation,
  },

  data() {
    return {
      image: "./images/map-exemple.jpg",
    };
  },

  mounted() {},

  props: ["projects"],
};
</script>

<style scoped>
</style>