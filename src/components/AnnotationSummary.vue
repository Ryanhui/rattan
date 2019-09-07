<template>
  <div class="container" v-loading="loading">
    <img src="../assets/AnnotationSummary.png" alt="AnnotationSummary" class="as-image">
    <!-- <button v-on:click="getResult">get</button> -->
    <el-tabs value="Calsi" type="border-card" tab-position="top" stretch class="tab">
      <el-tab-pane label="Calsi" name="Calsi">
        <div class="badtable">
          <p class="summary-title">Carbohydrate-Active enzymes in Calamus simplicifolius</p>
          <div style="padding: 8px 0 8px 0">
            <div>
              <p class="cazy-title">Glycoside Hydrolases (GHs): hydrolysis and/or rearrangement of glycosidic bonds</p>
              <span v-for="i in activeGH(Cazy_Calsi)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">GlycosylTransferases (GTs): formation of glycosidic bonds</p>
              <span v-for="i in activeGT(Cazy_Calsi)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Polysaccharide Lyases (PLs): non-hydrolytic cleavage of glycosidic bonds</p>
              <span v-for="i in activePL(Cazy_Calsi)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Carbohydrate Esterases (CEs): hydrolysis of carbohydrate esters</p>
              <span v-for="i in activeCE(Cazy_Calsi)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Auxiliary Activities (AAs): redox enzymes that act in conjunction with CAZymes</p>
              <span v-for="i in activeAA(Cazy_Calsi)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Carbohydrate-Binding Modules (CBMs): adhesion to carbohydrates</p>
              <span v-for="i in activeCBM(Cazy_Calsi)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
          </div>
        </div>
        <div class="badtablebig">
          <p class="summary-title">Transcription Regulators in Calamus simplicifolius</p>
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
          <p class="summary-title">Carbohydrate-Active enzymes in Daemonorops jenkinsiana</p>
          <div style="padding: 8px 0 8px 0">
            <div>
              <p class="cazy-title">Glycoside Hydrolases (GHs): hydrolysis and/or rearrangement of glycosidic bonds</p>
              <span v-for="i in activeGH(Cazy_Daeje)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">GlycosylTransferases (GTs): formation of glycosidic bonds</p>
              <span v-for="i in activeGT(Cazy_Daeje)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Polysaccharide Lyases (PLs): non-hydrolytic cleavage of glycosidic bonds</p>
              <span v-for="i in activePL(Cazy_Daeje)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Carbohydrate Esterases (CEs): hydrolysis of carbohydrate esters</p>
              <span v-for="i in activeCE(Cazy_Daeje)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Auxiliary Activities (AAs): redox enzymes that act in conjunction with CAZymes</p>
              <span v-for="i in activeAA(Cazy_Daeje)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
            <div>
              <p class="cazy-title">Carbohydrate-Binding Modules (CBMs): adhesion to carbohydrates</p>
              <span v-for="i in activeCBM(Cazy_Daeje)" :key=i>
                <a :href="'/annotation_summary/Cazy/Calsi/'+i" target="_blank">
                  {{i.replace(".txt",'')}}
                </a>
              </span>
            </div>
          </div>
          <!-- <div style="padding: 8px">
            <span v-for="i in Cazy_Daeje" :key=i>
              <a :href="'/annotation_summary/Cazy/Daeje/'+i" target="_blank">
                {{i.replace(".txt",'')}}
              </a>  
            </span>
          </div> -->
        </div>

        <div class="badtablebig">
          <p class="summary-title">Transcription Regulators in Daemonorops jenkinsiana</p>
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
  computed: {

    
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
    },
    activeGH: function(data) {
      return data.filter(function(item) {
        return item.indexOf('GH') !== -1;
      })
    },
    activeGT: function(data) {
      return data.filter(function(item) {
        return item.indexOf('GT') !== -1;
      })
    },
    activePL: function(data) {
      return data.filter(function(item) {
        return item.indexOf('PL') !== -1;
      })
    },
    activeCE: function(data) {
      return data.filter(function(item) {
        return item.indexOf('CE') !== -1;
      })
    },
    activeAA: function(data) {
      return data.filter(function(item) {
        return item.indexOf('AA') !== -1;
      })
    },
    activeCBM: function(data) {
      return data.filter(function(item) {
        return item.indexOf('CBM') !== -1;
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
    color: rgb(97, 97, 97);
    transition: all 0.2s cubic-bezier(0.4, 0, 1, 1);
  }
  .badtable a:hover,.badtablebig a:hover {
    color: rgb(7, 119, 16);
    font-weight: 500;
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
    font-size: 20px;
    line-height: 36px;
    border-bottom: 1px solid rgb(175, 175, 175);
  }
  .cazy-title {
    margin: 24px 24px 0 24px;
    background: rgb(197, 197, 197);
  }
</style>