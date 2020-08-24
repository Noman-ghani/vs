<script>
import { Pie } from "vue-chartjs";

export default {
  extends: Pie,
  props: ['labels', 'data','title'],
   data: function () {
            return {
                pieBG: [],
            }
   },
  mounted() {
    this.get_pieBg();
    this.renderChart(
      {
        
        labels: this.labels,
        datasets: [
          {
            backgroundColor: this.pieBG,
            data: this.data
          }
        ]
      },
      { 
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
        .createLinearGradient(0, 0, 0, 600);
        this.gradient.addColorStop(0, this.$helpers.generator_random_rgba(1));
        this.gradient.addColorStop(1, this.$helpers.generator_random_rgba(0));
       
      return this.gradient;
    },
    get_pieBg: function(){
      this.data.forEach(res => {
        this.pieBG.push(this.get_random_gradient());
      });
    }
  }
};
</script>