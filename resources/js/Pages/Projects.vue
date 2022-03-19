<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto">
        <div class="flex flex-col bg-white px-4">
          <div
            v-for="project in projects"
            :key="project.id"
            class="flex flex-col"
          >
            <div class="text-center p-4 uppercase font-medium text-3xl mt-6">
              {{ project.name }}
            </div>

            <table class="blueTable">
              <thead>
                <tr>
                  <td></td>
                  <td>%</td>
                  <td>Total</td>
                  <td>Marge</td>
                </tr>
              </thead>
              <tr>
                <td class="epo">Estimation le plus optimiste</td>
                <td rowspan="5">40%</td>
                <td>{{ project.epo.toFixed(2) }} Dhs</td>
                <td>{{ (project.epo * 0.4).toFixed(2) }} Dhs</td>
              </tr>
              <tr>
                <td class="epp">Estimation le plus probable</td>
                <td>{{ project.epp.toFixed(2) }} Dhs</td>
                <td>{{ (project.epp * 0.4).toFixed(2) }} Dhs</td>
              </tr>
              <tr>
                <td class="epps">Estimation le plus pessimiste</td>
                <td>{{ project.epps.toFixed(2) }} Dhs</td>
                <td>{{ (project.epps * 0.4).toFixed(2) }} Dhs</td>
              </tr>
              <tr>
                <td class="em">Estimation Moyen</td>
                <td>{{ project.em.toFixed(2) }} Dhs</td>
                <td>{{ (project.em * 0.4).toFixed(2) }} Dhs</td>
              </tr>
              <tr>
                <td class="pv">Prix de vente H.T</td>
                <td>{{ project.em.toFixed(2) }} Dhs</td>
                <td>{{ (project.em * 0.4).toFixed(2) }} Dhs</td>
              </tr>
            </table>

            <table class="blueTable">
              <tr>
                <td colspan="3" class="pv">Coût SMPH</td>
                <td colspan="3" class="pv">Coût LMPH</td>
              </tr>
              <tr>
                <td>Custommer Demand</td>
                <td>{{ project.smph_custommer_demand }}</td>
                <td rowspan="2" class="epo">{{ project.smph }} Dhs/m</td>

                <td>Custommer Demand</td>
                <td>{{ project.lmph_custommer_demand }}</td>
                <td rowspan="2" class="epo">{{ project.lmph }} Dhs/m</td>
              </tr>

              <tr>
                <td>Production Available Time</td>
                <td>{{ project.smph_production_available_time }}</td>

                <td>Production Available Time</td>
                <td>{{ project.lmph_production_available_time }}</td>
              </tr>
            </table>

            <apexchart
              :width="project.Chart.width"
              :height="project.Chart.height"
              :type="project.Chart.type"
              :options="project.Chart.options"
              :series="project.Chart.series"
            ></apexchart>

            <div class="max-full mt-4 flex">
              <a
                :href="'/project-analytics/' + project.id"
                target="_blank"
                :class="
                  'bg-main ml-auto w-44 text-center ' + globalClass.buttonForm
                "
                rel="noopener noreferrer"
                >Analytics</a
              >
            </div>

            <div class="max-full mt-4 flex">
              <a
                :href="'/pdf-generate/' + project.id"
                target="_blank"
                :class="
                  'bg-main ml-auto w-44 text-center ' + globalClass.buttonForm
                "
                rel="noopener noreferrer"
                >Generate the PDF</a
              >
            </div>
          </div>
        </div>

        <div class="flex flex-col bg-white px-4"></div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import ApexCharts from "apexcharts";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  components: { AppLayout, ApexCharts },

  data() {
    return {
      globalClass: {
        inputTextForm:
          "appearance-none border border-gray-400 hover:border-gray-300 rounded-sm w-full p-2 text-gray-700 leading-tight focus:outline-none shadow bg-white hover:bg-main text-xs transition-all duration-300 transform",
        buttonForm:
          "appearance-none border border-main hover:border-main rounded-sm w-full p-2 text-custom_blue leading-tight focus:outline-none shadow bg-white hover:bg-main text-xs transition-all duration-300 transform",
        link: "text-xs text-custom_blue hover:text-custom_blue transition-all duration-300 transform cursor-pointer",
        textError: "text-error text-xs bg-error p-1 rounded-xs mt-1",
        textSucces: "text-custom_blue text-xs bg-success p-1 rounded-xs mt-1",
      },
    };
  },

  mounted() {},

  computed: {},

  props: ["projects"],
};
</script>
<style>
table.blueTable {
  font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  border: 1px solid #ffffff;
  background-color: #f4f4f4;
  width: 100%;
  text-align: center;
  border-collapse: collapse;
}

table.blueTable td,
table.blueTable th {
  border: 1px solid #aaaaaa;
  padding: 3px 2px;
}

table.blueTable tbody td {
  font-size: 11px;
}

table.blueTable tr:nth-child(even) {
  background: #ffffff;
}

table.blueTable thead tr {
  background: #f7cee2 !important;
  background: -moz-linear-gradient(top, #f7cee2 0%, #f7cee2 66%, #f7cee2 100%);
  background: -webkit-linear-gradient(
    top,
    #f7cee2 0%,
    #f7cee2 66%,
    #f7cee2 100%
  );
  background: linear-gradient(to bottom, #f7cee2 0%, #f7cee2 66%, #f7cee2 100%);
}

table.blueTable th {
  font-size: 13px;
  font-weight: normal;
  color: #d54c4c;
  text-align: center;
}

table.blueTable tfoot {
  font-size: 12px;
  font-weight: normal;
  background: #cccaf0;
  background: -moz-linear-gradient(top, #cccaf0 0%, #cccaf0 66%, #cccaf0 100%);
  background: -webkit-linear-gradient(
    top,
    #cccaf0 0%,
    #cccaf0 66%,
    #cccaf0 100%
  );
  background: linear-gradient(to bottom, #cccaf0 0%, #cccaf0 66%, #cccaf0 100%);
}

table.blueTable tfoot td {
  font-size: 12px;
}

table.blueTable tfoot tr {
  background-color: #cfdfef;
  color: #000000;
}

table.blueTable td.cat_parent {
  color: #ffffff !important;
  background: #5b9bd5 !important;
}

table.blueTable td.cat {
  background-color: #cfdfef;
  color: #000000;
}

.head {
  text-align: center;
  margin: 16px 0 36px;
}

.head .title {
  font-size: 36px;
  text-transform: uppercase;
}

.head .description {
  font-size: 18px;
  margin: 8px 0 16px;
}
</style>