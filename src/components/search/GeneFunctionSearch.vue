<template>
  <div class="container">
    <div class="wrapper">
      <h3>1. Annotation</h3>
      <el-table
        :data="gfs_tableData"
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
    <div>
      <h3>2. Location</h3>
    </div>
    <div>
      <h3>3. Network</h3>
    </div>
    <div class="wrapper">
      <h3>4. Functional module</h3>
      <el-table
          :data="function_module_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="gene"
            label=""
            width="140"
          >
            <template slot-scope="scope">
              <router-link class="link" target="_blank" :to="{ name: 'FunctionModule', params: { gene: scope.row.gene }}">{{scope.row.gene}}</router-link>
              <!-- <a target="_blank" :href="'#/function_module?gene='+scope.row.gene">{{ scope.row.gene }}</a> -->
            </template>
          </el-table-column>
          <el-table-column
            prop="group"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="function"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="num1"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="describe1"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="num2"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="value1"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="value2"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="genes"
            label=""
          >
          </el-table-column>
        </el-table>
    </div>
    <div>
      <h3>5. Cis-elements</h3>
    </div>
    <div>
      <h3>6. Expression profilings</h3>
    </div>
    <div>
      <h3>7. Gene family</h3>
    </div>
    <div>
      <h3>8. Protein domain</h3>
    </div>
    <div>
      <h3>9. KEGG Pathway</h3>
    </div>
    <div>
      <h3>10. Gene Ontology</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GeneFunctionSearch',
  components:{

  },
  data: function() {
    return {
      gfs_tableData: [],
      function_module_tableData: [],
    }
  },
  methods: {
    //1.Gene function search
    gfs_submit() {
      this.gfs_gene = this.$route.params.gene;
      this.gfs_species = this.$route.params.species;

      this.axios.get(`http://rattan.bamboogdb.org/php/search_gene_function.php?gene=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        this.gfs_tableData = response.data || [];
      })
    },
    //4.function module search
    function_module_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_fun_module.php?keyword=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        this.function_module_tableData = response.data || [];
      })
    }
  },
  mounted: function() {
    this.gfs_submit();
    this.function_module_submit();
  }
}

</script>

<style scoped>
  .container {
    
  }
  .wrapper {
    width: 80%;
    margin: 0 auto;
  }
  .link {
    color: rgb(11, 146, 63);
  }
</style>

