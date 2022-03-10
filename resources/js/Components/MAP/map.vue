<template>
  <div>
    <div class="map relative">
   
      <ch-interactive-map
        :mainOeuvre="mainOeuvre"
        :imgSrc="'https://rewind.youtube/static/comps/u7wmt63vujeebudmp2jgztujcatu3llkqaehjeyt3jz5y6o7dbqq.webp'"
      ></ch-interactive-map>
      <ch-project-intro :project="project"></ch-project-intro>
      <ch-sag-list :sag="sag"></ch-sag-list>
      <ch-alert :message="'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente vel animi ab debitis nihil ex eaque consequatur incidunt facilis quas. Recusandae expedita, natus reiciendis mollitia doloremque dolor accusamus veritatis quos!'"></ch-alert>

    </div>
  </div>
</template>

<script>
import ChProjectIntro from "./ProjectIntro.vue";
import ChSagList from "./SagList.vue";
import ChInteractiveMap from "./InteractiveMap.vue";
import ChAlert from "./alert.vue";

export default {
  components: { ChProjectIntro, ChSagList, ChInteractiveMap,ChAlert },

  data() {
    return {};
  },

  mounted() {},

  props: ["project", "sag", "mainOeuvre"],
};
</script>

<style>
</style>