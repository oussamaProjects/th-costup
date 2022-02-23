<template>
  <div class="relative p-2">
    <ch-factors-values
      @refreshProjectValues="refreshProjectValues"
      :project_id="project.id"
      :factorsNotInProject="this.factorsNotInProject"
      :factorsProject="this.factorsProject"
      :globalClass="globalClass"
    />

    <div class="w-ful" v-if="this.project">
      <div class="text-center">Chiffrage</div>
      <div class="epo">
        Estimation le plus optimiste : {{ this.project.epo.toFixed(2) }}
      </div>
      <div class="epp">
        Estimation le plus probable : {{ this.project.epp.toFixed(2) }}
      </div>
      <div class="epps">
        Estimation le plus pessimiste : {{ this.project.epps.toFixed(2) }}
      </div>
      <div class="em">Estimation Moyen : {{ this.project.em.toFixed(2) }}</div>
      <div class="smph">Coût SMPH : {{ this.project.smph.toFixed(2) }}</div>
      <div class="lmph">Coût LMPH : {{ this.project.lmph.toFixed(2) }}</div>
      <div class="max-w-sm mt-2">
       
        <a
          :href="'/pdf-generate/' + this.project.id"
          target="_blank"
          :class="globalClass.buttonForm"
          rel="noopener noreferrer"
          >Generate the PDF</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import ChFactorsValues from "../Factors/FactorsValues.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
    ChFactorsValues,
  },
  data() {},
  methods: {
    refreshProjectValues(event) {
      this.$emit("refreshProjectResults", event);
    },
    generatePDF() {
      let routeData = this.$router.resolve({
        name: "generate-pdf",
        query: { data: this.project.id },
      });
      console.log(routeData);
      window.open(routeData.href, "_blank");
    },
  },
  props: ["project", "factorsNotInProject", "factorsProject", "globalClass"],
};
</script>

<style>
</style>