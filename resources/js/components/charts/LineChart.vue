<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  props: ['labels','dataLabel','data','title'],
  mounted() {
    this.renderChart(
      {
        // labels: [
        //   "Jan",
        //   "Feb",
        //   "Mar",
        //   "Apr",
        //   "May",
        //   "Jun",
        //   "Jul",
        //   "Aug",
        //   "Sep",
        //   "Oct",
        //   "Nov",
        //   "Dec"
        // ],
        labels: this.labels,
        datasets: this.data,
        datasets: [
          {
            label: this.dataLabel,
            data: this.data,
            backgroundColor: "transparent",
            borderColor: this.$helpers.generator_random_rgba(0.5),
            pointBackgroundColor: this.$helpers.generator_random_rgba()
          }
        ]

      },
      {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
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
      }
    );
  }
};
</script>