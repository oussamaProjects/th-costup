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
          class="flex flex-col bg-white overflow-hidden shadow-lg sm:rounded"
        >
          <apexchart
            :width="pieChart.width"
            :height="pieChart.height"
            :type="pieChart.type"
            :options="pieChart.options"
            :series="pieChart.series"
          ></apexchart>

          <br>

          <apexchart
            :width="areaChart.width"
            :height="areaChart.height"
            :type="areaChart.type"
            :options="areaChart.options"
            :series="areaChart.series"
          ></apexchart>
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
    pieChart: Object,
    areaChart: Object,
  },
};
</script>