<template>
  <div class="container" v-loading="loading" element-loading-text="please wait... It would take some time...">
    <p class="title" >Cis-element Analysis</p>
    <p class="jobid">
      You job id is: <span style="font-weight:700">{{this.$route.query.jobid}}</span>
    </p>
    <div class="table_wrapper" v-if="type==='sequence'">
      <el-table
        :data="sequence.cis_result"
        stripe
        border
        size="mini"
        style="width: 100%">
        <el-table-column
          prop="motif_id"
          label="Motif ID">
            <template slot-scope="scope">
              <a style="margin-left: 10px" target="_blank" class="link" :href="'/motif/data/motif_information/'+scope.row.motif_id+'.txt'">{{ scope.row.motif_id }}</a>
            </template>
        </el-table-column>
        <el-table-column
          prop="motif_name"
          label="Motif name">
        </el-table-column>
        <el-table-column
          prop="motif_pattern"
          label="Motif pattern">
        </el-table-column>
        <el-table-column
          prop="motif_counts"
          label="Motif counts">
        </el-table-column>
        <el-table-column
          prop="bg1k"
          label="Bg 1K">
        </el-table-column>
        <el-table-column
          prop="bg2k"
          label="Bg 2K">
        </el-table-column>
        <el-table-column
          prop="bg3k"
          label="Bg 3K">
        </el-table-column>
      </el-table>
      <el-table
        :data="sequence.length"
        stripe
        border
        size="mini"
        style="width: 100%;margin-top:24px">
        <el-table-column
          prop="sequence_id"
          label="Sequence ID">
        </el-table-column>
        <el-table-column
          prop="length"
          label="Length">
        </el-table-column>
      </el-table>
      <p style="margin-top:16px;text-align:justify">Bg 1K: Suppose we have n promoter sequences in our database, and the length of them are all 1000 bp, the total number of occurrences of motifi in these promoters is N, thus the bg 1k of motifi is computer by N/n. This is the same for Bg 2K and Bg 3K.
</p>
    </div>
    <div class="table_wrapper" v-if="type==='name'">
      <el-table
        :data="name.name_result"
        stripe
        border
        size="mini"
        style="width: 100%">
        <el-table-column
          prop="motif_id"
          label="Motif ID">
            <template slot-scope="scope">
              <a style="margin-left: 10px" target="_blank" class="link" :href="'/motif/data/motif_information/'+scope.row.motif_id+'.txt'">{{ scope.row.motif_id }}</a>
            </template>
        </el-table-column>
        <el-table-column
          prop="motif_name"
          label="Motif name">
        </el-table-column>
        <el-table-column
          prop="motif_counts"
          label="Motif counts">
        </el-table-column>
        <el-table-column
          prop="z_score"
          label="Z-score">
        </el-table-column>
        <el-table-column
          prop="p_value"
          label="P-value">
        </el-table-column>
      </el-table>
    </div>
<div class="table_wrapper" v-if="type==='custom'">
      <el-table
        :data="custom.custom_result"
        stripe
        border
        size="mini"
        style="width: 100%">
        <el-table-column
          prop="gene_id"
          label="Gene ID">
        </el-table-column>
        <el-table-column
          prop="motif"
          label="Motif">
        </el-table-column>
        <el-table-column
          prop="counts"
          label="Counts">
        </el-table-column>
        <el-table-column
          prop="location_forward"
          label="Location in forward">
        </el-table-column>
        <el-table-column
          prop="location_reverse"
          label="Location in reverse">
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CisElementAnalysisResult',
  components:{
    
  },
  data(){
    return {
      type: '',
      loading: false,
      sequence: {},
      name: {},
      custom: {}
    }
  },
  mounted(){
    let jobid = this.$route.query.jobid;
    let type = '';
    if(/s/g.test(jobid)){
      this.type = 'sequence';
      this.loading = true;
      let self = this;
      setTimeout(() => {
          self.axios.get(`http://rattan.bamboogdb.org/php/motif/result.php?jobid=${jobid}&type=sequence`).then((response) => {
          self.sequence = response.data;
          self.loading = false;
        });
      }, 2000);
    }
    if(/n/g.test(jobid)){
      this.type = 'name';
      this.loading = true;
      let timer;
      let self = this;
      function getData() {
        self.axios.get(`http://rattan.bamboogdb.org/php/motif/result.php?jobid=${jobid}&type=name`).then((response) => {
          if(response.data == 'not yet'){
            console.log(null);
          } else {
            if(response.data.file_size === self.name.file_size) {
              self.loading = false;
              clearInterval(timer);
            }
            self.name = response.data;
            console.log(response.data);
          }
        });
      }
      timer = setInterval(getData, 10000)
    }
    if(/c/g.test(jobid)){
      this.type = 'custom';
      this.loading = true;
      let timer;
      let self = this;
      function getData() {
        self.axios.get(`http://rattan.bamboogdb.org/php/motif/result.php?jobid=${jobid}&type=custom`).then((response) => {
          if(response.data == 'not yet'){
            console.log(null);
          } else {
            if(response.data.file_size === self.custom.file_size) {
              self.loading = false;
              clearInterval(timer);
            }
            self.custom = response.data;
            console.log(response.data);
          }
        });
      }
      timer = setInterval(getData, 10000)
    }
  }
}

</script>

<style scoped>
  .container {
    min-height: 800px;
  }
  .table_wrapper{
    width: 80%;
    margin: 24px auto;
  }
  .title {
    font-size: 32px;
    margin-bottom: 24px;
  }
  .jobid {
    margin: 24px auto;
    text-align: left;
    width: 80%;
  }
  .link {
    text-decoration: none;
    color: rgb(34, 124, 34);
  }
</style>

