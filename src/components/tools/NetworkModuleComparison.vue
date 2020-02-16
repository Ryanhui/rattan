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
                    </div>
                    <div class="input-field">
                        Gene Id B: 
                        <el-input v-model="geneIdB" :disabled="!twoGene" size="small" placeholder="Please input gene" style="width: 200px"></el-input>
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
                    </div>
                    <div class="input-field">
                        Module Id B: 
                        <el-input v-model="moduleIdB" :disabled="!twoModule" size="small" placeholder="Please input module" style="width: 200px"></el-input>
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
        let routeData = this.$router.resolve({ path: '/tools/network_module_comparison_one_gene', query: { geneA: this.geneIdA}})
        window.open(routeData.href, '_blank')
      },
      onSubmitModule(){

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
</style>

