<template>
  <div class="container">
    <p class="title">Sequence extractor</p>
    <p>You can extract sequences of promoter resign, cds, pep and whole-length gene by Sequence extractor</p>
    <!-- result -->
    <div v-if="showResult" class="result-area">
      <el-button type="primary" v-on:click="handleBack" size="small" class="back-button">Return</el-button>
      <el-input type="textarea" :rows="35" placeholder="Result" v-model="sequenceResult"></el-input>
    </div>
    <!-- pannel -->
    <el-tabs v-model="activeName" @tab-click="handleClick" type="border-card" stretch class="tab" v-if="!showResult">
      <el-tab-pane label="Calsi" name="Calsi">
        <el-form label-position="right" label-width="100px" style="width: 350px; margin: 0 auto;">
          <el-form-item label="Data sets:">
            <el-select v-model="type" placeholder="Please Select" size="small" style="width: 100%">
              <el-option-group v-for="group in options" :key="group.label" :label="group.label">
                <el-option
                  v-for="item in group.options"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value"
                ></el-option>
              </el-option-group>
            </el-select>
          </el-form-item>
          <el-form-item label="Gene ID:">
            <el-input type="textarea" :rows="5" placeholder="Please input" v-model="sequences"></el-input>
            <span class="examples" v-on:click="addExample">example</span>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit" class="submit-button" :loading="loading">Submit</el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>
      <el-tab-pane label="Daeje" name="Daeje">
        <el-form label-position="right" label-width="100px" style="width: 350px; margin: 0 auto;">
          <el-form-item label="Data sets:">
            <el-select v-model="type" placeholder="Please Select" size="small" style="width: 100%">
              <el-option-group v-for="group in options" :key="group.label" :label="group.label">
                <el-option
                  v-for="item in group.options"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value"
                ></el-option>
              </el-option-group>
            </el-select>
          </el-form-item>
          <el-form-item label="Gene ID:">
            <el-input type="textarea" :rows="5" placeholder="Please input" v-model="sequences"></el-input>
            <span class="examples" v-on:click="addExample">example</span>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit" class="submit-button" :loading="loading">Submit</el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
export default {
  name: "Blast",
  components: {},
  data() {
    return {
      activeName: "Calsi",
      type: "",
      sequences: "",
      sequenceResult: '',
      showResult: false,
      loading: false,

      options: [
        {
          label: "Promoter",
          options: [
            {
              value: "promoter1k",
              label: "1K Promoter"
            },
            {
              value: "promoter2k",
              label: "2K Promoter"
            },
            {
              value: "promoter3k",
              label: "3K Promoter"
            }
          ]
        },
        {
          label: "Domain sequences",
          options: [
            {
              value: "domainCds",
              label: "cds"
            },
            {
              value: "domainPep",
              label: "pep"
            }
          ]
        },
        {
          label: "Gene sequences",
          options: [
            {
              value: "geneWhole",
              label: "whole length gene sequences"
            },
            {
              value: "genePep",
              label: "pep"
            },
            {
              value: "geneCds",
              label: "cds"
            }
          ]
        }
      ]
    };
  },
  methods: {
    handleClick() {
      this.type = '';
      this.sequences = '';
    },
    onSubmit() {
      console.log(this.type, this.sequences);
      var data = new FormData();

      data.append('species', this.activeName);
      data.append('type', this.type);
      data.append('sequences', this.sequences);

      /////////////////////////////////////////
      function compare(property){
          return function(obj1, obj2){
            var value1 = Number(obj1[property].slice(10));
            var value2 = Number(obj2[property].slice(10));
            return value1 - value2;     
        }
      }
      /////////////////////////////////////////
      this.loading = true;
      this.axios.post('http://rattan.bamboogdb.org/php/search_sequence_extractor.php',data).then((response) => {
        console.log(response)
        let sortObj = response.data.sort(compare("gene_id"));
        console.log(sortObj);
        
        let text = ``;
        if(this.type === 'genePep' || this.type === 'geneCds') {
          sortObj.forEach((item) => {
            text = `${text}>${item.gene_id} ${item.pf_id} ${item.pfam} ${item.start} ${item.end} ${item.value} ${item.annotation} ${item.length}
${item.sequence}
`})
        } else {
          sortObj.forEach((item) => {
            text = text + '>' + item.gene_id + '\n' + item.sequence + '\n';
          })
        }
        this.sequenceResult = text;
        this.showResult = true;
        this.loading = false;
      })
    },

    addExample() {
      if(this.activeName === 'Calsi') {
        this.sequences = `Calsi_gene14976
Calsi_gene45768
Calsi_gene17400
Calsi_gene27018`;
      }
      if(this.activeName === 'Daeje') {
        this.sequences = `Daeje_Gene32641
Daeje_Gene16374
Daeje_Gene28386
Daeje_Gene64410
Daeje_Gene67057`;
      }
    },
    handleBack () {
      this.showResult = false;
    }
  }
};
</script>

<style scoped>
.container {
  min-height: 600px;
  width: 80%;
  margin: 0 auto;
}
.title {
  font-size: 32px;
  margin-top: 24px;
}
.tab {
  margin-top: 36px;
}
.submit-button {
  margin-top: 16px;
  margin-right: 32px;
}
.examples {
  margin-right: 195px;
  cursor: pointer;
  color: #349D38;
}
.result-area {
  margin: 24px 0 48px 0;
  text-align: left;
}
.back-button {
  margin: 8px 0 24px 0;
}
</style>

