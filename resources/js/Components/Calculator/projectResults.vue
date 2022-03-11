<template>
  <div class="relative p-2">
    <div class="w-ful" v-if="this.project">
      <div class="text-center text-2xl font-medium uppercase m-8">
        Results
      </div>
      <div class="nice-shape-container">
        <div class="font-sm shadow-sm nice-shape epo">
          <div>Estimation le plus optimiste :</div>
          <div class="font-semibold">{{ this.project.epo }}</div>
          <!-- <div class="font-semibold">{{ this.project.epo.toFixed(2) }}</div> -->
        </div>
        <div class="font-sm shadow-sm nice-shape epp">
          <div>Estimation le plus probable :</div>
          <div class="font-semibold">{{ this.project.epp }}</div>
          <!-- <div class="font-semibold">{{ this.project.epp.toFixed(2) }}</div> -->
        </div>
        <div class="font-sm shadow-sm nice-shape epps">
          <div>Estimation le plus pessimiste :</div>
          <div class="font-semibold">{{ this.project.epps }}</div>
          <!-- <div class="font-semibold">{{ this.project.epps.toFixed(2) }}</div> -->
        </div>
        <div class="font-sm shadow-sm nice-shape em">
          <div>Estimation Moyen :</div>
          <div class="font-semibold">{{ this.project.em }}</div>
          <!-- <div class="font-semibold">{{ this.project.em.toFixed(2) }}</div> -->
        </div>
        <div class="font-sm shadow-sm nice-shape smph">
          <div>Coût SMPH :</div>
          <div class="font-semibold">{{ this.project.smph }}</div>
          <!-- <div class="font-semibold">{{ this.project.smph.toFixed(2) }}</div> -->
        </div>
        <div class="font-sm shadow-sm nice-shape lmph">
          <div>Coût LMPH :</div>
          <div class="font-semibold">{{ this.project.lmph }}</div>
          <!-- <div class="font-semibold">{{ this.project.lmph.toFixed(2) }}</div> -->
        </div>
      </div>

      <div class="max-full mt-4 flex">
        <a
          :href="'/pdf-generate/' + this.project.id"
          target="_blank"
          :class="'bg-main ml-auto w-44 text-center ' + globalClass.buttonForm"
          rel="noopener noreferrer"
          >Generate the PDF</a
        >
      </div>
      <div class="max-full mt-4 ">
        <p class="text-xs">SMPH = square meter per hour</p>
        <p class="text-xs">LMPH = linear meter per hour</p>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  data() {},
  methods: {
    generatePDF() {
      let routeData = this.$router.resolve({
        name: "generate-pdf",
        query: { data: this.project.id },
      });
      window.open(routeData.href, "_blank");
    },
  },
  props: ["project", "factorsNotInProject", "factorsProject", "globalClass"],
};
</script>

<style>
/*.nice-shape-container {
   transform: rotate(-90deg) translateY( 100%);
    transform-origin: center center;
    margin-left: -200px;
    width: 400px; 
}*/
.nice-shape {
  height: 90px;
  max-width: 600px;
  background: rgba(229, 231, 235, 1);
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
  margin: 8px 0;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding: 0 28px;
}

.nice-shape.epo {
  background: #cfdfef;
  width: 400px;
}

.nice-shape.epp {
  background: #cccaf0;
  width: 450px;
}

.nice-shape.epps {
  background: #f7cee2;
  width: 550px;
}

.nice-shape.em {
  background: #f7e3cc;
  width: 350px;
}

.nice-shape.smph {
  background: #5d8233;
  color: #ffffff;
  width: 400px;
}
.nice-shape.lmph {
  background: #d54c4c;
  color: #ffffff;
  width: 300px;
}
</style>