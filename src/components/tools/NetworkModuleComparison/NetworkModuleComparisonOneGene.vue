<template>
    <div>
        <div class="title-sen">
            <p>Gene compares with {{this.geneA}}</p>
        </div>
        <el-table
          :data="tableData"
          stripe
          class="gene-table"
          border>
          <el-table-column
            prop="gene_b"
            label="gene Id">
              <template slot-scope="scope">
                <span style="margin-left: 10px; cursor: pointer" v-on:click='onGetResult(scope.row.gene_b)'>{{ scope.row.gene_b }}</span>
              </template>
          </el-table-column>
        </el-table>
    </div>
</template>

<script>
export default {
  name: 'NetworkModuleComparisonOneGene',
  components:{

  },
  data: function(){
      return {
          tableData: [],
          geneA: '',
      }
  },
  mounted() {
      this.geneA = this.$route.query.geneA;
      this.onSubmitGene();
  },
  methods: {
      onSubmitGene() {
        this.axios.get('http://rattan.bamboogdb.org/php/network_module_comparison/gene_compare_list.php?geneA='+this.geneA).then((response) => {
            //console.log(response.data);
            if(response.data) {
                this.tableData = response.data;
            }
        }).catch((error) => {
          console.log(error);
        })
      },
      onGetResult(gene_b) {
          let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_gene_result', query: { geneA: this.geneA, geneB: gene_b}})
          window.open(routeData.href, '_blank')
      }
  }
}
</script>

<style scoped>
  .container {
    height: 100%;
  }
  .title-sen {
      margin-top: 24px;
  }
  .gene-table {
      width: 300px;
      margin: 40px auto;
  }
</style>

