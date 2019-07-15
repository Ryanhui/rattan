<template>
  <div class="container">
    <p class="title">GSEA Analysis</p>
    <el-form ref="form" label-width="200px" class="form">
      <el-form-item label="Choose Species">
        <el-select v-model="species" placeholder="please select">
          <el-option label="Calsi" value="calsi"></el-option>
          <el-option label="Daeje" value="daeje"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Choose Gene Sets">
        <div>
          <el-checkbox :indeterminate="isIndeterminateG1" v-model="checkAllG1" @change="handleCheckAllG1Change">G1:GO gene sets</el-checkbox>
          <el-checkbox-group v-model="checkedG1" @change="handleCheckedG1Change" style="margin-left: 18px">
            <el-checkbox label="bp" key="bp">BP:GO biological process</el-checkbox>
            <el-checkbox label="cc" key="cc">CC:GO cellular component </el-checkbox>
            <el-checkbox label="mf" key="mf">MF:GO molecular function</el-checkbox>
          </el-checkbox-group>
        </div>

        <div>
          <el-checkbox v-model="checkedG2">G2:Gene Family Based gene sets</el-checkbox>
        </div>
        
        <div>
          <el-checkbox :indeterminate="isIndeterminateG3" v-model="checkAllG3" @change="handleCheckAllG3Change">G3:Curated gene sets</el-checkbox>
          <el-checkbox-group v-model="checkedG3" @change="handleCheckedG3Change" style="margin-left: 18px">
            <el-checkbox label="kegg" key="kegg">KEGG:KEGG gene sets</el-checkbox>
          </el-checkbox-group>
        </div>

      </el-form-item>
      <el-form-item label="Choose Background">
        <el-select v-model="background" placeholder="please select">
          <el-option label="Suggested background (Whole genome level)" value="suggested"></el-option>
          <el-option label="Customized background" value="customized"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Statistical test method">
        <el-select v-model="testMethod" placeholder="please select">
          <el-option label="Fisher" value="Fisher"></el-option>
          <el-option label="Hypergeometric" value="Hypergeometric"></el-option>
          <el-option label="Chi-square" value="Chi-square"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Multi-test adjustment method">
        <el-select v-model="adjustmentMethod" placeholder="please select">
          <el-option label="Fisher" value="Fisher"></el-option>
          <el-option label="Hypergeometric" value="Hypergeometric"></el-option>
          <el-option label="Chi-square" value="Chi-square"></el-option>
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
        <el-button type="primary" @click="onSubmit">立即创建</el-button>
        <el-button>取消</el-button>
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
        checkAllG1: false,
        isIndeterminateG1: false,
        checkedG1: [],

        checkedG2: false,

        checkAllG3: false,
        isIndeterminateG3: false,
        checkedG3: [],

        species: '',
        background: '',
        testMethod: '',
        adjustmentMethod: '',
        level: '',
      }
    },
  methods: {
    handleCheckAllG1Change(val){
      console.log(val);
      this.checkedG1 = val ? ['bp', 'cc', 'mf'] : [];
      this.isIndeterminateG1 = false;
    },
    handleCheckedG1Change(val) {
      console.log(val);
      this.checkAllG1 = val.length === 3;
      this.isIndeterminateG1 = val.length > 0 && val.length < 3; 
    },

    handleCheckAllG3Change(val){
      console.log(val);
      this.checkedG3 = val ? ['kegg'] : [];
      this.isIndeterminateG3 = false;
    },
    handleCheckedG3Change(val) {
      console.log(val);
      this.checkAllG3 = val.length === 1;
      this.isIndeterminateG3 = val.length > 0 && val.length < 1; 
    }
  }
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
</style>

