<template>
    <div v-loading="loading" class="container">
      <div class="cystyle" v-if="showNetwork">
        <cytoscape :config="config" />
      </div>
      <el-table
            :data="tableData"
            stripe
            size='small'
            empty-text="No Result"
            class="ann-table">
            <el-table-column
              prop="gene_a"
              label="Gene ID"
              width="180">
            </el-table-column>
            <el-table-column
              prop="function_a"
              label="Gene annotation"
              width="180">
            </el-table-column>
            <el-table-column
              prop="e_value"
              label="E-value">
            </el-table-column>
            <el-table-column
              prop="gene_b"
              label="Gene ID">
            </el-table-column>
            <el-table-column
              prop="funcion_b"
              label="Gene annotation">
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
const config = {
  elements: {},
  minZoom: 0.2,
  //maxZoom:100,
  style: [ // the stylesheet for the graph
    {
      selector: 'node',
      style: {
        'width': '30px',
        'height': '30px',
        'background-color': '#9baec8',
        'label': 'data(id)',
        'font-size': '15px',
      }
    },
    {
      "selector": "node[group = 'moduleA']",
        "style": {
          "background-color": "#fcb503",
        }
    },
    {
      "selector": "node[group = 'moduleB']",
        "style": {
          "background-color": "#03befc",
        }
    },
    {
      "selector": "node[?isRootA]",
        "style": {
          "background-color": "#fc3903",
        }
    },
    {
      "selector": "node[?isRootB]",
        "style": {
          "background-color": "#036ffc",
        }
    },
    {
      selector: 'edge[group = "groupA"]',
      style: {
        'width': 0.8,
        'line-color': '#fc6b03',
      }
    },
    {
      selector: 'edge[group = "groupB"]',
      style: {
        'width': 0.8,
        'line-color': '#035afc',
      }
    },
    {
      selector: 'edge[?isConnect]',
      style: {
        'width': 0.8,
        'line-color': '#03fc5a',
      }
    },
  ],

  layout: {
          name: "preset",
          fit: true,
      
      }
  }
export default {
  name: 'NetworkModuleComparisonModuleResult',
  components:{

  },
  data: function(){
      return {
          moduleA: '',
          moduleB: '',
          showNetwork: false,
          config,
          nodes: [],
          edges: [],
          tableData: [],

          loading: true,
      }
  },
  mounted() {
    this.moduleA = this.$route.query.moduleA;
    this.moduleB = this.$route.query.moduleB;

    this.onSubmitGene();
  },
  methods: {
      onSubmitGene() {
        this.axios.get(`http://rattan.bamboogdb.org/php/network_module_comparison/module_compare_result.php?moduleA=${this.moduleA}&moduleB=${this.moduleB}`).then((response) => {
            console.log(response.data);
            if(response.data.moduleAdata.length > 0) {
                response.data.moduleAdata.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item,
                        group: 'moduleA',
                    }

                    let x = Math.floor(Math.random() * 500);
                    let y = Math.floor(Math.random() * 700);
                    newOne.position = {x: x, y: y};
                    

                    this.nodes.push(newOne);

                    // if(!item.isRootA) {
                    //     let edgeNewOne = {};
                    //     edgeNewOne.data = {
                    //         id: item.uuid,
                    //         source: item.gene1,
                    //         target: item.gene2,
                    //         group: 'moduleA'
                    //     }
                    //     this.edges.push(edgeNewOne);
                    // }
                })
            }
            if(response.data.moduleBdata.length > 0) {
                response.data.moduleBdata.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item,
                        group: 'moduleB',
                    }
 
                    let x = Math.floor(Math.random() * 500 + 500);
                    let y = Math.floor(Math.random() * 700);
                    newOne.position = {x: x, y: y};
                    
                    this.nodes.push(newOne);

                    // if(!item.isRootB) {
                    //     let edgeNewOne = {};
                    //     edgeNewOne.data = {
                    //         id: item.uuid,
                    //         source: item.gene1,
                    //         target: item.gene2,
                    //         group: 'moduleB'
                    //     }
                    //     this.edges.push(edgeNewOne);
                    // }
                })
            }
            if(response.data.geneRelation.length > 0) {
                response.data.geneRelation.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item.id,
                        source: item.gene_a,
                        target: item.gene_b,
                        isConnect: true,
                    }
                    this.edges.push(newOne);
                })
            }
            let that = this;
            function getEdges(arr, group) {
              let temArr = [];
              for (let i = 0; i<arr.length; i++) {
                for (let j = i+1; j< arr.length; j++) {
                    let newOne = {};
                    newOne.data = {
                        id: arr[i]+arr[j],
                        source: arr[i],
                        target: arr[j],
                        isConnect: false,
                        group: group,
                    }
                  temArr.push(newOne);
                }
              }
              return temArr;
            }
            this.edges = this.edges.concat(getEdges(response.data.moduleAdata, 'groupA'));
            this.edges = this.edges.concat(getEdges(response.data.moduleBdata, 'groupB'));

            console.log(this.edges);
            if(response.data.tableData.length > 0) {
                this.tableData = response.data.tableData;
            }

            this.config.elements = {
                nodes: this.nodes,
                edges: this.edges,
            }
            setTimeout(()=>{
                this.showNetwork = true;
                this.loading = false;
            }, 100)
            console.log(JSON.stringify(this.config.elements) );
        }).catch((error) => {
          console.log(error);
        })
      },
  }
}
</script>

<style scoped>
  .container {
    min-height: 800px;
    position: relative;
  }
  .cystyle {
    height: 800px;
    text-align: left;
    position: relative;
    margin: 0 auto;
  }
  .ann-table {
      width: 80%;
      margin: 24px auto 96px auto;
  }
</style>

