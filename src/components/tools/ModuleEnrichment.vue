<template>
  <div>
    <p class="title">ModuleSEA Analysis</p>
    <p v-if="showTable" style="text-align:left;margin:60px 0 0 120px">Click to show ModuleSEA result in image: <span @click="handlePdf" class="clickColor">{{showPdf ? 'hide' : 'show'}}</span></p>
    <div v-if="showTable && showPdf" style="margin: 24px 0 48px 0">
      <pdf :src="dotplotPdf" style="width: 60%"></pdf>
      <p>Dotplot of ModuleSEA result (You can edit it by Powerpoint, <a :href="dotplotPptx" target="_blank">download</a> the .pptx file)</p>
      
      <pdf :src="barplotPdf" style="width: 60%;margin-top: 60px"></pdf>
      <p>Barplot of ModuleSEA result (You can edit it by Powerpoint, <a :href="barplotPptx" target="_blank">download</a> the .pptx file)</p>
    </div>
    <el-table
      :data="tableData"
      border
      class="table"
      v-if="showTable"
      style="width: 80%">
      <el-table-column
        prop="geneSetName"
        label="Gene Set Name(NO. Genes)"
        width="180">
          <template slot-scope="scope">
              <router-link class="a-link" target="_blank" :to="{ name: 'FunctionModule', params: { gene: scope.row.geneSetName.replace(/\(\S+\)/g, '') }}">{{scope.row.geneSetName}}</router-link>
          </template>
      </el-table-column>
      <el-table-column
        prop="description"
        label="Description"
        width="180">
      </el-table-column>
      <!-- <el-table-column
        prop="category"
        label="Category">
      </el-table-column> -->
      <el-table-column
        prop="overlap"
        label="Overlap Genes">
      </el-table-column>
      <el-table-column
        prop="pvalue"
        label="p-value">
      </el-table-column>
      <el-table-column
        prop="fdr"
        label="FDR">
      </el-table-column>
    </el-table>
    <el-form ref="form" label-width="200px" class="form">
      <el-form-item label="Choose Species">
        <el-select v-model="species" placeholder="please select" v-on:change="changeSpeices">
          <el-option label="Calamus simplicifolius" value="Calsi"></el-option>
          <el-option label="Daemonorops jenkinsiana" value="Daeje"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Statistical test method">
        <el-select v-model="testMethod" placeholder="please select">
          <el-option label="Fisher" value="fisher"></el-option>
          <el-option label="Hypergeometric" value="dhyper"></el-option>
          <el-option label="Chi-square" value="chi2"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Multi-test adjustment method">
        <el-select v-model="adjustmentMethod" placeholder="please select">
          <el-option label="Yekutieli (FDR under dependency)" value="BY"></el-option>
          <el-option label="Bonferroni" value="bonferroni"></el-option>
          <el-option label="Hochberg" value="hochberg"></el-option>
          <el-option label="Hochberg(FDR)" value="BH"></el-option>
          <el-option label="Hommel" value="hommel"></el-option>
          <el-option label="Holm" value="holm"></el-option>
          <el-option label="Not adjust" value="none"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Significance Level">
        <el-select v-model="level" placeholder="please select">
          <el-option label="0.05" value="0.05"></el-option>
          <el-option label="0.1" value="0.1"></el-option>
          <el-option label="0.01" value="0.01"></el-option>
        </el-select>
      </el-form-item>

      <el-form-item>
        <el-input
          type="textarea"
          :rows="5"
          placeholder="please input genes"
          v-model="textarea"
          style="width:240px">
        </el-input>
        <span class="example" v-on:click="handelExample">example</span>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Submit</el-button>
        <!-- <el-button @click="getResult">adfsdf</el-button> -->
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
import pdf from 'vue-pdf';
export default {
  name: 'ModuleEnrichment',
  components:{
    pdf
  },
  data() {
    return {
      species: 'Calsi',
      testMethod: 'fisher',
      adjustmentMethod: 'BY',
      level: '0.05',
      textarea: '',

      jobId: '',
      tableData: [],
      showTable: false,
      loading: null,
      
      showPdf: false,
      dotplotPdf: '',
      barplotPdf: '',
      dotplotPptx: '',
      barplotPptx: '',

      calsiExample: `Calsi_gene14976
Calsi_gene45768
Calsi_gene17400
Calsi_gene27018
Calsi_gene38529
Calsi_gene22211
Calsi_gene47040
Calsi_gene01037
Calsi_gene02724
Calsi_gene04583
Calsi_gene06096
Calsi_gene14471
Calsi_gene24814
Calsi_gene32530
Calsi_gene42790
Calsi_gene45374
Calsi_gene48073
Calsi_gene50416
Calsi_gene27120
Calsi_gene49864
Calsi_gene34465
Calsi_gene25727
Calsi_gene45961
Calsi_gene47420
Calsi_gene34228
Calsi_gene04910
Calsi_gene15756
Calsi_gene42007
Calsi_gene08349
Calsi_gene09567
Calsi_gene33854
Calsi_gene09494
Calsi_gene14638
Calsi_gene39106
Calsi_gene47559
Calsi_gene43457
Calsi_gene23996
Calsi_gene45366
Calsi_gene36004
Calsi_gene10259
Calsi_gene11877
`,
      daejeExample: `Daeje_Gene32641
Daeje_Gene16374
Daeje_Gene28386
Daeje_Gene64410
Daeje_Gene67057
Daeje_Gene18412
Daeje_Gene59534
Daeje_Gene24534
Daeje_Gene34355
Daeje_Gene68231
Daeje_Gene49181
Daeje_Gene00605
Daeje_Gene00607
Daeje_Gene04737
Daeje_Gene52976
Daeje_Gene63840
Daeje_Gene33109
`,
    }
  },
  methods: {
    handlePdf() {
      this.showPdf = !this.showPdf;
    },

    onSubmit() {
      var data = new FormData();
      data.append('species', this.species);
      data.append('testMethod', this.testMethod);
      data.append('adjustmentMethod', this.adjustmentMethod);
      data.append('level', this.level);
      data.append('textarea', this.textarea);

      // 开始请求
      this.loading = this.$loading({
          lock: true,
          text: 'Loading',
          spinner: 'el-icon-loading',
          background: 'rgba(0, 0, 0, 0.7)'
      });
      this.showTable = false;
      this.axios.post('http://rattan.bamboogdb.org/php/modulesea.php',data).then((response) => {
        console.log(response);
        this.jobId = response.data;

        setTimeout(() => {
          this.getResult();
        },2000)
      }).catch((error) => {
        console.log(error);
      })
    },

    getResult() {
      this.axios.get('http://rattan.bamboogdb.org/php/modulesea_result.php?job_id='+this.jobId).then((response) => {
        console.log(response);
        this.tableData = response.data;
        this.showTable = true;
        this.loading.close();

        this.dotplotPdf = '/scripts/gsea/tmp/'+this.jobId+'/GSEA_dotplot.pdf',
        this.barplotPdf = '/scripts/gsea/tmp/'+this.jobId+'/GSEA_barplot.pdf',
        this.dotplotPptx = '/scripts/gsea/tmp/'+this.jobId+'/dotplot.pptx',
        this.barplotPptx = '/scripts/gsea/tmp/'+this.jobId+'/barplot.pptx',

        setTimeout(() => {
          document.querySelector('#app').scrollTo({
            top: 100,
            left: 0,
            behavior: 'smooth'
          })
        },200)
      }).catch((error) => {
        console.log(error);
      })
    },

    handelExample() {
      if(this.species === 'Calsi') {
        this.textarea = this.calsiExample;
      }
      if(this.species === 'Daeje') {
        this.textarea = this.daejeExample;
      }
    },

    changeSpeices() {
      console.log('eueuue')
      this.textarea = '';
    }
  }
}
</script>
<style>
  .title {
    font-size: 32px;
    margin-top: 24px;
  }
  .form {
    width: 900px;
    margin: 24px auto 0 auto;
    text-align: left;
  }
  .table {
    margin: 24px auto 24px auto;
  }
  .clickColor {
    text-decoration: none;
    color: rgb(2, 128, 86);
    cursor: pointer;
  }
  .example {
    margin-left: 8px;
    color:rgb(2, 128, 86);
    font-size: 18px;
    cursor: pointer;
  }
  .a-link {
    color: rgb(2, 128, 86);
  }
</style>


