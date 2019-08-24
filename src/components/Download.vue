<template>
  <div class="container">
    <el-row>
      <el-col :span="12">
        <el-table
          :data="tableData1"
          style="width: 100%">
          <el-table-column
            prop="name"
            label="name"
            width="380">
          </el-table-column>
          <el-table-column
            prop="address"
            label="Download">
            <template slot-scope="scope">
              <el-button type="primary" plain size="small" icon="el-icon-download" v-on:click="download(scope.row)"></el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-col>
      <el-col :span="12">
        <el-table
          :data="tableData2"
          style="width: 100%">
          <el-table-column
            prop="name"
            label="name"
            width="380">
          </el-table-column>
          <el-table-column
            prop="address"
            label="Download">
            <template slot-scope="scope">
              <el-button type="primary" plain size="small" icon="el-icon-download" v-on:click="download(scope.row)"></el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'Download',
  components:{

  },
  data() {
        return {
          tableData1: [{
            name: 'Calamus_simplicifolius.HIC.genome',
            address: '/download/Calsi/Calamus_simplicifolius.HIC.genome'
          }, {
            name: 'Calamus_simplicifolius.WGS.genome',
            address: '/download/Calsi/Calamus_simplicifolius.WGS.genome'
          }, {
            name: 'Calamus_simplicifolius.cds',
            address: '/download/Calsi/Calamus_simplicifolius.cds'
          }, {
            name: 'Calamus_simplicifolius.gene.gff3',
            address: '/download/Calsi/Calamus_simplicifolius.gene.gff3'
          }, {
            name: 'Calamus_simplicifolius.miRNA.gff3',
            address: '/download/Calsi/Calamus_simplicifolius.miRNA.gff3'
          },{
            name: 'Calamus_simplicifolius.proteins',
            address: '/download/Calsi/Calamus_simplicifolius.proteins'
          },{
            name: 'Calamus_simplicifolius.rRNA.gff3',
            address: '/download/Calsi/Calamus_simplicifolius.rRNA.gff3'
          },{
            name: 'Calamus_simplicifolius.snRNA.gff3',
            address: '/download/Calsi/Calamus_simplicifolius.snRNA.gff3'
          },{
            name: 'Calamus_simplicifolius.tRNA.gff3',
            address: '/download/Calsi/Calamus_simplicifolius.tRNA.gff3'
          }],
          tableData2: [{
            name: 'Daemonorops_jenkinsiana.HIC.genome',
            address: '/download/Daeje/Daemonorops_jenkinsiana.HIC.genome'
          },{
            name: 'Daemonorops_jenkinsiana.WGS.genome',
            address: '/download/Daeje/Daemonorops_jenkinsiana.WGS.genome'
          },{
            name: 'Daemonorops_jenkinsiana.cds',
            address: '/download/Daeje/Daemonorops_jenkinsiana.cds'
          },{
            name: 'Daemonorops_jenkinsiana.gene.gff3',
            address: '/download/Daeje/Daemonorops_jenkinsiana.gene.gff3'
          },{
            name: 'Daemonorops_jenkinsiana.miRNA.gff3',
            address: '/download/Daeje/Daemonorops_jenkinsiana.miRNA.gff3'
          },{
            name: 'Daemonorops_jenkinsiana.proteins',
            address: '/download/Daeje/Daemonorops_jenkinsiana.proteins'
          },{
            name: 'Daemonorops_jenkinsiana.rRNA.gff3',
            address: '/download/Daeje/Daemonorops_jenkinsiana.rRNA.gff3'
          },{
            name: 'Daemonorops_jenkinsiana.snRNA.gff3',
            address: '/download/Daeje/Daemonorops_jenkinsiana.snRNA.gff3'
          },{
            name: 'Daemonorops_jenkinsiana.tRNA.gff3',
            address: '/download/Daeje/Daemonorops_jenkinsiana.tRNA.gff3'
          }]
        }
    },
    methods: {
      download(data) {
        // window.open(data.address)
        // window.location.href = address;

        let eleLink = document.createElement('a');
        eleLink.download = data.name;
        eleLink.style.display = 'none';
        eleLink.href = data.address;
        // 受浏览器安全策略的因素，动态创建的元素必须添加到浏览器后才能实施点击
        document.body.appendChild(eleLink);
        // 触发点击  
        eleLink.click();
        // 然后移除
        document.body.removeChild(eleLink);
      }
    }
}

</script>

<style scoped>
  .container {
    height: 700px;
  }
  .el-table {
    padding: 32px;
  }
</style>

