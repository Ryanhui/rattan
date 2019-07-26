<template>
  <div class="container">
    <p class="title">GSEA Analysis</p>
    <div class="result" v-if="showResult">
      <div class="returnButtonWrap">
        <el-button @click="backToMain" type="primary" icon="el-icon-back" class="returnButton">Return</el-button>
      </div>
      <!-- <el-button @click="getResult" class="returnButton" style="margin-left: 8px">No result? Click To Try Again</el-button> -->
      <!-- <el-button @click="updateCanvas">updateCanvas</el-button> -->
      <div class="jobInfo">
        <p style="font-size: 24px">Basic computing summary</p>
        <p>ID number of the Job: {{jobId}} (Available in 3 months for retrieving).</p>
        <p>Categories selected: {{categories}}</p>
        <p>NO. query list after removing redundancy: <a :href="'/scripts/gsea/tmp/'+jobId+'/gene.query'" target="_blank">click</a></p>
        <p>NO. redundant list in original query: <a :href="'/scripts/gsea/tmp/'+jobId+'/gene.redu.query'" target="_blank">click</a></p>
        <p>Computing Result in Table formatted: <a :href="'/scripts/gsea/tmp/'+jobId+'/result.table.table_out'" target="_blank">click</a></p>
      </div>
      <el-table
        :data="tableData"
        stripe
        border
        size="mini"
        style="width: 100%">
        <el-table-column
          prop="gene"
          label="Gene Set Name(NO. Genes)"
          width="180">
        </el-table-column>
        <el-table-column
          prop="des"
          label="Description"
          width="180">
        </el-table-column>
        <el-table-column
          prop="cata"
          label="Category">
        </el-table-column>
        <el-table-column
          prop="no"
          label="NO. Genes in Overlap (k)">
        </el-table-column>
        <el-table-column
          prop="pvalue"
          label="p value">
        </el-table-column>
        <el-table-column
          prop="fdr"
          label="FDR">
        </el-table-column>
      </el-table>
      <div class="canvas">
        <canvas id="canvas" width="1000" height="1600"></canvas>
      </div>
    </div>
    <el-form ref="form" label-width="200px" class="form" v-if="!showResult">
      <el-form-item label="Choose Species">
        <el-select v-model="species" placeholder="please select">
          <el-option label="Calamus simplicifolius" value="Calsi"></el-option>
          <el-option label="Daemonorops jenkinsiana" value="Daeje"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Choose Gene Sets">
        <div>
          <el-checkbox :indeterminate="isIndeterminateG1" v-model="checkAllG1" @change="handleCheckAllG1Change">G1:GO gene sets</el-checkbox>
          <el-checkbox-group v-model="checkedG1" @change="handleCheckedG1Change" style="margin-left: 18px">
            <el-checkbox label="BP" key="BP">BP:GO biological process</el-checkbox>
            <el-checkbox label="CC" key="CC">CC:GO cellular component </el-checkbox>
            <el-checkbox label="MF" key="MF">MF:GO molecular function</el-checkbox>
          </el-checkbox-group>
        </div>

        <div>
          <el-checkbox v-model="checkedG2" label="GFam" key="GFam">G2:Gene Family Based gene sets</el-checkbox>
        </div>
        
        <div>
          <el-checkbox :indeterminate="isIndeterminateG3" v-model="checkAllG3" @change="handleCheckAllG3Change">G3:Curated gene sets</el-checkbox>
          <el-checkbox-group v-model="checkedG3" @change="handleCheckedG3Change" style="margin-left: 18px">
            <el-checkbox label="KEGG" key="KEGG">KEGG:KEGG gene sets</el-checkbox>
          </el-checkbox-group>
        </div>

      </el-form-item>
      <el-form-item label="Choose Background">
        <el-select v-model="background" placeholder="please select">
          <el-option label="Suggested background (Whole genome level)" value="suggested"></el-option>
          <el-option label="Customized background" value="customized"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Customized background" v-if="background === 'customized'">
        <el-input
          type="textarea"
          :rows="5"
          placeholder="please input genes"
          v-model="customizedBackground"
          style="width:240px">
        </el-input>
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
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  name: 'GeneSetsAnalysis',
  components:{

  },
  data() {
      return {
        categories: [],
        checkAllG1: false,
        isIndeterminateG1: false,
        checkedG1: [],

        checkedG2: false,

        checkAllG3: false,
        isIndeterminateG3: false,
        checkedG3: [],

        species: '',
        background: '',
        customizedBackground: '',
        testMethod: '',
        adjustmentMethod: '',
        level: '',
        textarea: '',

        jobId: '',

        showResult: false,
        tableData:[],
        chartData: {},
      }
    },
  methods: {
    handleCheckAllG1Change(val){
      this.checkedG1 = val ? ['BP', 'CC', 'MF'] : [];
      this.isIndeterminateG1 = false;
    },
    handleCheckedG1Change(val) {
      this.checkAllG1 = val.length === 3;
      this.isIndeterminateG1 = val.length > 0 && val.length < 3; 
    },

    handleCheckAllG3Change(val){
      this.checkedG3 = val ? ['KEGG'] : [];
      this.isIndeterminateG3 = false;
    },
    handleCheckedG3Change(val) {
      this.checkAllG3 = val.length === 1;
      this.isIndeterminateG3 = val.length > 0 && val.length < 1; 
    },

    onSubmit() {
      // 转换 gene Setes 数据
      let database = [];
      database = database.concat(this.checkedG1).concat(this.checkedG3);
      if(this.checkedG2) {
        database.push('GFam');
      }
      this.categories = database;

      // 判断用户输入完整
      if(this.species === '') {
        this.$message.error('Please Choose Species!');
        return;
      }
      if(database.length === 0) {
        this.$message.error('Choose Gene Sets!');
        return;
      }
      if(this.background === '') {
        this.$message.error('Please Choose Background!');
        return;
      }
      if(this.testMethod === '') {
        this.$message.error('Please Choose Statistical test method!');
        return;
      }
      if(this.adjustmentMethod === '') {
        this.$message.error('Please Choose Multi-test adjustment method!');
        return;
      }
      if(this.level === '') {
        this.$message.error('Please Choose Significance Level!');
        return;
      }
      if(this.textarea === '') {
        this.$message.error('Please Input Genes!');
        return;
      }

      // 生成请求数据
      var data = new FormData();
      data.append('database', database);
      data.append('species', this.species);
      data.append('background', this.background);
      data.append('customizedBackground', this.customizedBackground);
      data.append('testMethod', this.testMethod);
      data.append('adjustmentMethod', this.adjustmentMethod);
      data.append('level', this.level);
      data.append('textarea', this.textarea);
      
      for (var pair of data.entries()) {
        console.log(pair[0]+ ': ' + pair[1]); 
      }
      
      // 显示结果页
      this.showResult = true;
      this.onloading = this.$loading({
          lock: true,
          text: 'Loading',
          spinner: 'el-icon-loading',
          background: 'rgba(0, 0, 0, 0.7)'
      });
      this.tableData = [];

      // 开始请求
      this.axios.post('http://rattan.bamboogdb.org/php/gsea.php',data).then((response) => {
        console.log(response);
        this.jobId = response.data;
        
        // 获取结果
        setTimeout(() => {
          this.getResult();
        },2000)
      }).catch((error) => {
        console.log(error);
      })
    },

    getResult() {
      this.axios.get('http://rattan.bamboogdb.org/php/gsea_result.php?job_id='+this.jobId).then((response) => {
        console.log(response);
        this.tableData = response.data.table;
        this.chartData = response.data.chart;
        this.onloading.close();

        setTimeout(()=>{
          this.updateCanvas();
        },10)
      })
    },
    
    backToMain() {
      this.showResult = false;
    },

    updateCanvas: function (){
      var canvas = document.getElementById('canvas'),
          ctx = canvas.getContext('2d');
      ctx.clearRect(0,0,canvas.width,canvas.height);
      ctx.fillStyle = "black";
      ctx.font="20px";


      let startX = 50,startY = 500;
      let drawData = this.chartData.detail;
      let drawTitle = this.chartData.title;
      ctx.textAlign = "right";
      ctx.textBaseline = "middle";
      for(let i = 0; i<drawData.length; i++) {
        if(drawData[i][0] === '') break;
        ctx.fillStyle = "black";
        ctx.fillText(drawData[i][0], startX, startY + i *20 + 6);
        for(let j = 0;j < drawTitle.length; j++) {
          if(drawData[i].indexOf(drawTitle[j]) > -1) {
            ctx.fillStyle="#CC3300";
          }else {
            ctx.fillStyle="#C0C0C0";
          }
          ctx.fillRect(startX+20 + j*15, startY + i *20, 12, 12);
        }
      }

      ctx.save();
      ctx.translate(startX+25, startY-5);
      ctx.rotate(-Math.PI/2);
      ctx.fillStyle = "black";
      ctx.textAlign = "left";
      this.chartData.title.forEach((item, i) => {
        ctx.fillText(item, 0, 0 + 15 * i);
      })

      ctx.restore();
    },
  },
}

</script>

<style scoped>
  .container {
    min-height: 600px;
  }
  .title {
    font-size: 32px;
    margin-top: 24px;
  }
  .form {
    width: 900px;
    margin: 24px auto 0 auto;
    text-align: left;
  }
  .result {
    width: 1000px;
    margin: 24px auto 24px auto;
  }
  .returnButton {
    margin: 16px 0;
    float: left;
  }
  .returnButtonWrap {
    overflow: hidden;
  }
  .jobInfo{
    text-align: left;
    margin-bottom: 24px;
  }
  .jobInfo p {
    margin: 8px 0;
  }
  .canvas {
    margin-top: 24px;
  }
</style>

