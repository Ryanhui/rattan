<template>
    <div>
        <div class="title-sen">
            <p>module compares with {{this.moduleA}}</p>
        </div>
        <el-table
          :data="tableData"
          stripe
          empty-text="No Result"
          class="gene-table"
          border>
          <el-table-column
            prop="gene_b"
            label="module Id">
              <template slot-scope="scope">
                <span style="margin-left: 10px; cursor: pointer" v-on:click='onGetResult(caculateModule(scope.row))'>{{ caculateModule(scope.row) }}</span>
              </template>
          </el-table-column>
        </el-table>
    </div>
</template>

<script>
export default {
  name: 'NetworkModuleComparisonOneModule',
  components:{

  },
  data: function(){
      return {
          tableData: [],
          moduleA: '',
      }
  },
  mounted() {
      this.moduleA = this.$route.query.moduleA;
      this.onSubmitModule();
  },
  methods: {
      caculateModule(row) {
        if(row.module_a.substring(0 ,4) === this.moduleA.substring(0, 4)) {
          return row.module_b;
        } else {
          return row.module_a;
        }
      },
      onSubmitModule() {
        this.axios.get('http://rattan.bamboogdb.org/php/network_module_comparison/module_compare_list.php?moduleA='+this.moduleA).then((response) => {
            //console.log(response.data);
            if(response.data) {
                this.tableData = response.data;
            }
        }).catch((error) => {
          console.log(error);
        })
      },
      onGetResult(module_b) {
          let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_module_result', query: { moduleA: this.moduleA, moduleB: module_b}})
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

