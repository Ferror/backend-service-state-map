<script>
import VueApexCharts from "vue3-apexcharts";

export default {
  data() {
    return {
      options: {
        chart: {
          id: 'vuechart-example'
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
        }
      },
      series: [{
        name: 'series-1',
        data: [30, 40, 45, 50, 49, 60, 70, 91]
      }],
      heatmapOptions: {
        chart: {
          type: 'heatmap'
        }
      },
      heatmapSeries: [
        {
          name: 'Jan',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Feb',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Mar',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Apr',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'May',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Jun',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Jul',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Aug',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        },
        {
          name: 'Sep',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        }
      ]
    }
  },
  components: {
    apexchart: VueApexCharts,
  },
}
</script>

<template>
  <div class="about">
    <h1>This is an about page</h1>
  </div>
  <div>
    <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
    <apexchart width="500" type="heatmap" :options="heatmapOptions" :series="heatmapSeries"></apexchart>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
