<template>
  <div class="container">
    <p class="title">Sequence extractor</p>
    <el-tabs v-model="activeName" @tab-click="handleClick" type="border-card" stretch class="tab">
      <el-tab-pane label="Calsi" name="Calsi">
        <el-form label-position="right" label-width="150px" style="width: 350px; margin: 0 auto;">
          <el-form-item label="Promoter:">
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
          <el-form-item label="Sequences:">
            <el-input type="textarea" :rows="5" placeholder="Please input" v-model="sequences"></el-input>
          </el-form-item>
        </el-form>
      </el-tab-pane>
      <el-tab-pane label="Daeje" name="Daeje">
        <el-form label-position="right" label-width="150px" style="width: 350px; margin: 0 auto;">
          <el-form-item label="Promoter:">
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
          <el-form-item label="Sequences:">
            <el-input type="textarea" :rows="5" placeholder="Please input" v-model="sequences"></el-input>
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
  margin-top: 24px;
}
</style>

