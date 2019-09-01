<template>
  <div class="container">
    <img src="../assets/AnnotationSummary.png" alt="AnnotationSummary" class="as-image">
    <button v-on:click="getResult">get</button>
    <div class="badtable">
      <p class="summary-title">Cazy Calsi</p>
      <div style="padding: 8px">
        <span v-for="i in Cazy_Calsi" :key=i>
          <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
            {{i.replace(".txt",'')}}
          </a>
        </span>
      </div>
    </div>
    <div class="badtable">
      <p class="summary-title">Cazy Daeje</p>
      <div style="padding: 8px">
        <span v-for="i in Cazy_Daeje" :key=i>
          <a :href="'/annotation_summary/Cazy/Daeje/'+i" target="_blank">
            {{i.replace(".txt",'')}}
          </a>  
        </span>
      </div>
    </div>
    <div class="badtablebig">
      <p class="summary-title">TF Calsi</p>
      <div style="padding:8px">
        <span v-for="i in TF_Calsi" :key=i>
          <a :href="'/annotation_summary/TF/Calsi/'+i" target="_blank">
          {{i.replace("_rule.txt.family.out",'')}}
          </a>
        </span>
      </div>
    </div>
    <div class="badtablebig">
      <p class="summary-title">TF Daeje</p>
      <div style="padding: 8px">
        <span v-for="i in TF_Daeje" :key=i>
          <a :href="'/annotation_summary/TF/Daeje/'+i" target="_blank">
            {{i.replace("_rule.txt.family.out",'')}}
          </a>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AnnotationSummary',
  data(){
    return {
      Cazy_Calsi: [],
      Cazy_Daeje: [],
      TF_Calsi: [],
      TF_Daeje: [],
    }
  },
  components:{

  },
  methods: {
    getResult() {
      this.axios.get('http://rattan.bamboogdb.org/php/summary.php').then((response) => {
        console.log(response);
        const data = response.data;
        this.Cazy_Calsi = data.Cazy_Calsi;
        this.Cazy_Daeje = data.Cazy_Daeje;
        this.TF_Calsi = data.TF_Calsi;
        this.TF_Daeje = data.TF_Daeje;
      }).catch((error) => {
        console.log(error);
      })
    }    
  }
}

</script>

<style scoped>
  .container {
    min-height: 600px;
    text-align: left;
  }
  .as-image {
    width: 1150px;
    margin: 24px auto;
    display: block
  }
  .badtable{
    width: 1150px;
    margin: 16px auto;
    border: 2px solid black;
  }
  .badtable span{
    width: 90px;
    display: inline-block;
    margin: 2px 2px;
  }

  .badtablebig{
    width: 1150px;
    margin: 16px auto;
    border: 2px solid black;
  }
  .badtablebig span{
    width: 150px;
    display: inline-block;
    margin: 2px 2px;
  }
  .summary-title {
    text-align: center;
    font-size: 24px;
    border-bottom: 1px solid black;
  }
</style>