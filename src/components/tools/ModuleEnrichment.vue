<template>
  <div>
    <p class="title">ModuleSEA Analysis</p>
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
      </el-table-column>
      <el-table-column
        prop="description"
        label="Description"
        width="180">
      </el-table-column>
      <el-table-column
        prop="category"
        label="Category">
      </el-table-column>
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
        <el-select v-model="species" placeholder="please select">
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
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Submit</el-button>
        <!-- <el-button @click="getResult">adfsdf</el-button> -->
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
export default {
  name: 'ModuleEnrichment',
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
      loading: null
    }
  },
  methods: {
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
</style>


