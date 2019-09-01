<template>
  <div class="container" v-loading="loading">
    <img src="../assets/AnnotationSummary.png" alt="AnnotationSummary" class="as-image">
    <!-- <button v-on:click="getResult">get</button> -->
    <el-tabs value="Calsi" type="border-card" tab-position="top" stretch class="tab">
      <el-tab-pane label="Calsi" name="Calsi">
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
      </el-tab-pane>
      <el-tab-pane label="Daeje" name="Daeje">
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
          <p class="summary-title">TF Daeje</p>
          <div style="padding: 8px">
            <span v-for="i in TF_Daeje" :key=i>
              <a :href="'/annotation_summary/TF/Daeje/'+i" target="_blank">
                {{i.replace("_rule.txt.family.out",'')}}
              </a>
            </span>
          </div>
        </div>
      </el-tab-pane>
    </el-tabs>
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

      loading: false,
    }
  },
  components:{

  },
  mounted: function() {
    this.getResult()
  },
  methods: {
    getResult() {
      this.loading = true;
      this.axios.get('http://rattan.bamboogdb.org/php/summary.php').then((response) => {
        console.log(response);
        const data = response.data;
        this.Cazy_Calsi = data.Cazy_Calsi;
        this.Cazy_Daeje = data.Cazy_Daeje;
        this.TF_Calsi = data.TF_Calsi;
        this.TF_Daeje = data.TF_Daeje;
        this.loading = false;
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
  .tab {
    margin: 24px;
  }
  .badtable{
    width: 1100px;
    margin: 24px auto;
    border: 2px solid rgb(133, 133, 133);
  }
  .badtable span{
    width: 90px;
    display: inline-block;
    margin: 2px 2px;
    text-align: center;
  }
  .badtable a,.badtablebig a {
    text-decoration: none;
  }
  .badtablebig{
    width: 1100px;
    margin: 24px auto;
    border: 2px solid rgb(133, 133, 133);
  }
  .badtablebig span{
    width: 150px;
    display: inline-block;
    margin: 2px 2px;
    text-align: center;
  }
  .summary-title {
    text-align: center;
    font-size: 24px;
    border-bottom: 1px solid rgb(175, 175, 175);
  }
</style>