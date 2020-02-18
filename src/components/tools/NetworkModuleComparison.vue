<template>
    <div>
        <p class="title">Network and module comparison</p>
        <el-tabs type="border-card" class="my-el-tabs" stretch v-model="geneOrModule">
            <el-tab-pane label="Network comparison" name="gene">
                <div id='items'>
                    <div>
                        <el-switch
                          v-model="twoGene"
                          active-text="Based on TWO genes"
                          inactive-text="Based on One gene">
                        </el-switch>
                    </div>
                    <div class="input-field">
                        Gene Id A: 
                        <el-input v-model="geneIdA" placeholder="Please input gene" size="small" style="width: 200px"></el-input>
                        <span class="gene-example">
                            example: Daeje_Gene00045
                        </span>
                    </div>
                    <div class="input-field">
                        Gene Id B: 
                        <el-input v-model="geneIdB" :disabled="!twoGene" size="small" placeholder="Please input gene" style="width: 200px"></el-input>
                        <span class="gene-example">
                            example: Calsi_gene15519
                        </span>
                    </div>
                    <div class='submit-button'>
                        <el-button type="primary" @click="onSubmitGene">Submit</el-button>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Module comparison" name="module">
                <div id='items' style="width: 360px">
                    <div>
                        <el-switch
                          v-model="twoModule"
                          active-text="Based on TWO modules"
                          inactive-text="Based on One module">
                        </el-switch>
                    </div>
                    <div class="input-field">
                        Module Id A: 
                        <el-input v-model="moduleIdA" placeholder="Please input module" size="small" style="width: 200px"></el-input>
                        <span class="module-example">
                            example: Calsi_Module0437
                        </span>
                    </div>
                    <div class="input-field">
                        Module Id B: 
                        <el-input v-model="moduleIdB" :disabled="!twoModule" size="small" placeholder="Please input module" style="width: 200px"></el-input>
                        <span class="module-example">
                            example: Daeje_Module0680
                        </span>
                    </div>
                    <div class='submit-button'>
                        <el-button type="primary" @click="onSubmitModule">Submit</el-button>
                    </div>
                </div>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
export default {
  name: 'NetworkModuleComparison',
  components:{

  },
  data: function(){
      return {
          geneOrModule: 'gene',

          twoGene: true,
          geneIdA: '',
          geneIdB: '',

          twoModule: true,
          moduleIdA: '',
          moduleIdB: '',
      }
  },
  methods: {
      onSubmitGene() {
        if(!this.twoGene && this.geneIdA) {
            let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_one_gene', query: { geneA: this.geneIdA}})
            window.open(routeData.href, '_blank')
        } else {
            this.$message({
                message: 'please input gene',
                type: 'warning'
            });
        }
        if(this.twoGene && this.geneIdA && this.geneIdB) {
            let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_gene_result', query: { geneA: this.geneIdA, geneB: this.geneIdB}})
            window.open(routeData.href, '_blank')
        } else {
            this.$message({
                message: 'please input gene',
                type: 'warning'
            });
        }
      },
      onSubmitModule(){
        if(!this.twoModule && this.moduleIdA) {
            let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_one_module', query: { moduleA: this.moduleIdA}})
            window.open(routeData.href, '_blank')
        } else {
            this.$message({
                message: 'please input module',
                type: 'warning'
            });
        }
        if(this.twoModule && this.moduleIdA && this.moduleIdB) {
            let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_module_result', query: { moduleA: this.moduleIdA, moduleB: this.moduleIdB}})
            window.open(routeData.href, '_blank')
        } else {
            this.$message({
                message: 'please input module',
                type: 'warning'
            });
        }
      },
  }
}
</script>

<style scoped>
  .container {
    height: 100%;
  }
  .my-el-tabs {
      width: 80%;
      margin: 24px auto;
  }
  #items {
      text-align: left;
      width: 340px;
      margin: 40px auto;
  }
  .input-field {
      margin-top: 24px;
  }
  .submit-button {
      margin-top: 72px;
      text-align: center;
  }
  .gene-example {
      display: block;
      font-size: 14px;
      margin-left: 82px;
      margin-top: 12px;
  }
  .module-example {
      display: block;
      font-size: 14px;
      margin-left: 98px;
      margin-top: 12px;
  }
</style>

