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
            name: 'Phyllostachys_edulis_V1.BAC-ends',
            address: '/BambooV1/Phyllostachys_edulis_V1.BAC-ends'
          }, {
            name: 'Phyllostachys_edulis_V1.Gene-clusters',
            address: '/BambooV1/Phyllostachys_edulis_V1.Gene-clusters'
          }, {
            name: 'Phyllostachys_edulis_V1.Interpro',
            address: '/BambooV1/Phyllostachys_edulis_V1.Interpro'
          }, {
            name: 'Phyllostachys_edulis_V1.Repeats',
            address: '/BambooV1/Phyllostachys_edulis_V1.Repeats'
          }, {
            name: 'Phyllostachys_edulis_V1.cds',
            address: '/BambooV1/Phyllostachys_edulis_V1.cds'
          },{
            name: 'Phyllostachys_edulis_V1.genome',
            address: '/BambooV1/Phyllostachys_edulis_V1.genome'
          },{
            name: 'Phyllostachys_edulis_V1.gff',
            address: '/BambooV1/Phyllostachys_edulis_V1.gff'
          },{
            name: 'Phyllostachys_edulis_V1.miRNA',
            address: '/BambooV1/Phyllostachys_edulis_V1.miRNA'
          },{
            name: 'Phyllostachys_edulis_V1.pep',
            address: '/BambooV1/Phyllostachys_edulis_V1.pep'
          },{
            name: 'Phyllostachys_edulis_V1.rRNA',
            address: '/BambooV1/Phyllostachys_edulis_V1.rRNA'
          }],
          tableData2: [{
            name: 'Phyllostachys_edulis_V2.Hic.cds',
            address: '/BambooV2/Phyllostachys_edulis_V2.Hic.cds'
          },{
            name: 'Phyllostachys_edulis_V2.Hic.genome',
            address: '/BambooV2/Phyllostachys_edulis_V2.Hic.genome'
          },{
            name: 'Phyllostachys_edulis_V2.Hic.gff',
            address: '/BambooV2/Phyllostachys_edulis_V2.Hic.gff'
          },{
            name: 'Phyllostachys_edulis_V2.Hic.pep',
            address: '/BambooV2/Phyllostachys_edulis_V2.Hic.pep'
          },{
            name: 'Phyllostachys_edulis_V2.WGS.genome',
            address: '/BambooV2/Phyllostachys_edulis_V2.WGS.genome'
          },{
            name: 'Phyllostachys_edulis_V2.WGS.gff3',
            address: '/BambooV2/Phyllostachys_edulis_V2.WGS.gff3'
          },{
            name: 'Phyllostachys_edulis_V2.WGS.miRNA.gff',
            address: '/BambooV2/Phyllostachys_edulis_V2.WGS.miRNA.gff'
          },{
            name: 'Phyllostachys_edulis_V2.WGS.rRNA.gff',
            address: '/BambooV2/Phyllostachys_edulis_V2.WGS.rRNA.gff'
          },{
            name: 'Phyllostachys_edulis_V2.WGS.snRNA.gff',
            address: '/BambooV2/Phyllostachys_edulis_V2.WGS.snRNA.gff'
          },{
            name: 'Phyllostachys_edulis_V2.WGS.tRNA.gff',
            address: '/BambooV2/Phyllostachys_edulis_V2.WGS.tRNA.gff'
          }]
        }
    },
    methods: {
      download(data) {
        console.log(data)
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

