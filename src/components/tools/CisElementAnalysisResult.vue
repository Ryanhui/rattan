<template>
  <div class="container" v-loading="loading">
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
    }
  },
  mounted(){
    console.log(this.$route.query.jobid);
    let jobid = this.$route.query.jobid;
    let type = '';
    if(/s/g.test(jobid)){
      this.type = 'sequence';
      this.loading = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/motif/result.php?jobid=${jobid}&type=sequence`).then((response) => {
        this.sequence = response.data;
        this.loading = false;
      });
    }
    if(/n/g.test(jobid)){
      this.type = 'name';
      this.loading = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/motif/result.php?jobid=${jobid}&type=name`).then((response) => {
        this.name = response.data;
        this.loading = false;
      });
    }
    if(/c/g.test(jobid)){
      type = 'custom';
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
</style>

