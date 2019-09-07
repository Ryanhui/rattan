<template>
  <div class="container">
    <p class="main-title">Search</p>
    <p class="gfs-title">1.Gene function search</p>
    <el-tabs type="border-card" v-model="species" class="gfs" stretch v-if="!showGeneFunctionResult">
      <el-tab-pane label="Calsi" name="Calsi">
        <div>
          <el-input v-model="gene" placeholder="Please input" style="width: 200px"></el-input>
          <span style="margin-left:16px">(Example: Calsi_gene33960, Calsi_gene00246, Calsi_gene40036)</span>
        </div>
        <div>
          <el-button @click="submit" style="margin: 16px 0">Search</el-button>
        </div>
      </el-tab-pane>
      <el-tab-pane label="Daeje" name="Daeje">
        <div>
          <el-input v-model="gene" placeholder="Please input" style="width: 200px"></el-input>
          <span style="margin-left:16px">(Example: Daeje_Gene00006, Daeje_Gene00014, Daeje_Gene00079)</span>
        </div>
        <div>
          <el-button @click="submit" style="margin: 16px 0">Search</el-button>
        </div>
      </el-tab-pane>
  </el-tabs>

    <div v-if="showGeneFunctionResult">
      <el-button type="primary" style="margin: 16px 0" icon="el-icon-back" @click="handleGeneFunction">Return</el-button>
      <el-table
        :data="tableData"
        style="width: 100%"
        size="mini"
        border
        >
        <el-table-column
          prop="query"
          label="query"
          width="180">
        </el-table-column>
        <el-table-column
          prop="AT_gene"
          label="AT_gene"
          width="180">
        </el-table-column>
        <el-table-column
          prop="e_value"
          label="e_value">
        </el-table-column>
        <el-table-column
          prop="annotation"
          label="annotation">
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Search',
  components:{

  },
  data(){
    return {
      gene:'',
      species: 'Calsi',

      showGeneFunctionResult: false,
      tableData: [],
    }
  },
  methods: {
    handleGeneFunction(){
      this.showGeneFunctionResult = !this.showGeneFunctionResult;
    },
    submit() {
      if(this.gene === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.axios.get(`http://rattan.bamboogdb.org/php/search_gene_function.php?gene=${this.gene}&species=${this.species}`).then((response)=>{
        console.log(response);
        this.tableData = response.data || [];
        this.showGeneFunctionResult = true;
      })
    }
  }
}

</script>

<style scoped>
  .container {
    min-height: 600px;
    width: 80%;
    margin: 0 auto;
    text-align: left;
  }
  .main-title {
    font-size: 32px;
    text-align: center;
    margin: 24px 0;
  }
  .gfs-title {
    margin: 8px 0;
    font-size: 24px;
  }
</style>

