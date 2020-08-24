<script>
import { Doughnut } from "vue-chartjs";

export default {
  extends: Doughnut,
  props: ['labels', 'data','title'],
   data: function () {
            return {
                DoughnutBG: [],
            }
   },
  mounted() {
    this.get_DoughnutBg();
    this.renderChart(
      {
        hoverBackgroundColor: this.$helpers.generator_random_rgba(1),
        hoverBorderWidth: 55,
        labels: this.labels,
        datasets: [
          {
            backgroundColor: this.DoughnutBG,
            data: this.data
          }
        ]
      },
      { 
        hoverBackgroundColor: this.$helpers.generator_random_rgba(1),
        hoverBorderWidth: 50,
        responsive: true, maintainAspectRatio: false ,
        title: {
          display: true,
          text: this.title
        }
      }
    );
  },
  methods: {
    get_random_gradient: function(){
      this.gradient = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 650);
        this.gradient.addColorStop(0, this.$helpers.generator_random_rgba(1));
        this.gradient.addColorStop(1, this.$helpers.generator_random_rgba(0));
       
      return this.gradient;
    },
    get_DoughnutBg: function(){
      this.data.forEach(res => {
        this.DoughnutBG.push(this.get_random_gradient());
      });
    }
  }
};
</script>