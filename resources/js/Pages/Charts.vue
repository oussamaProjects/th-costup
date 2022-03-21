<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="flex flex-row bg-white overflow-hidden shadow-lg sm:rounded py-8"
        >
          <div class="flex-1">
            <apexchart
              v-if="PieChart"
              :width="PieChart.width"
              :height="PieChart.height"
              :type="PieChart.type"
              :options="PieChart.options"
              :series="PieChart.series"
            ></apexchart>
          </div>

          <div class="flex-1">
            <apexchart
              v-if="BarChart"
              :width="BarChart.width"
              :height="BarChart.height"
              :type="BarChart.type"
              :options="BarChart.options"
              :series="BarChart.series"
            ></apexchart>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  components: {
    AppLayout,
  },
  props: {
    PieChart: Object,
    BarChart: Object,
  },
};
</script>