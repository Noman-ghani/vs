<script>
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
  props: ['title','label','data'],
  mounted() {
    

    let chartData = {
      labels: this.label,
      datasets: this.data
    }
       
      this.renderChart(chartData,{
          responsive: true,
          chart: {
              width: 380,
              type: 'donut',
            },
          maintainAspectRatio: false,
          scales: {
            // xAxes: [
            //   {
            //     stacked: true
            //   }
            // ],
            yAxes: [
              {
                // stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }
            ],
          },
          title: {
            display: true,
            text: this.title
          }
        },
      );
  },
};
</script>
