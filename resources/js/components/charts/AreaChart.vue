<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  props: ['label','data','title'],
  data() {
     return {
                areaBG: [],
            }
  },
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
        labels: this.label,
        datasets: this.data
        
        // [
        //   {
        //     label: c,
        //     borderColor: ,
        //     pointBackgroundColor: "white",
        //     borderWidth: 1,
        //     pointBorderColor: "white",
        //     backgroundColor: this.gradient,
        //     data: this.data
        //   },
        //   {
        //     label: "doctors",
        //     borderColor: "#05CBE1",
        //     pointBackgroundColor: "white",
        //     pointBorderColor: "white",
        //     borderWidth: 1,
        //     backgroundColor: this.gradient2,
        //     data: [60, 55, 32, 10, 2, 12, 53, 55, 32, 10, 2, 12]
        //   },
        //   {
        //     label: "doctors",
        //     borderColor: "#05CBE1",
        //     pointBackgroundColor: "white",
        //     pointBorderColor: "white",
        //     borderWidth: 1,
        //     backgroundColor: this.gradient2,
        //     data: [60, 55, 32, 10, 2, 12, 53, 55, 32, 10, 2, 12]
        //   }
        // ]
      },
      { responsive: true, maintainAspectRatio: false }
    );
  },
  created: function () {    
    this.get_areaBg();
  },
  methods: {
    get_random_gradient: function(){
      this.gradient = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
        this.gradient.addColorStop(0, this.$helpers.generator_random_rgba(1));
        this.gradient.addColorStop(1, this.$helpers.generator_random_rgba(0));
       
      return this.gradient;
    },
    get_areaBg: function(){
      this.data.forEach(res => {
        this.areaBG.push(this.get_random_gradient());
      });
    }
  }
};
</script>
