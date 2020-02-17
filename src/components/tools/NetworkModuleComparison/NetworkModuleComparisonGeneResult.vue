<template>
    <div v-loading="loading" class="container">
      <div class="cystyle" v-if="showNetwork">
        <cytoscape :config="config" />
      </div>
      <el-table
            :data="tableData"
            stripe
            size='small'
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
      "selector": "node[group = 'geneA']",
        "style": {
          "background-color": "#fcb503",
        }
    },
    {
      "selector": "node[group = 'geneB']",
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
      selector: 'edge[group = "geneA"]',
      style: {
        'width': 0.8,
        'line-color': '#fc6b03',
      }
    },
    {
      selector: 'edge[group = "geneB"]',
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
  name: 'NetworkModuleComparisonGeneResult',
  components:{

  },
  data: function(){
      return {
          geneA: '',
          geneB: '',
          showNetwork: false,
          config,
          nodes: [],
          edges: [],
          tableData: [],

          loading: true,
      }
  },
  mounted() {
    this.geneA = this.$route.query.geneA;
    this.geneB = this.$route.query.geneB;

    this.onSubmitGene();
  },
  methods: {
      onSubmitGene() {
        this.axios.get(`http://rattan.bamboogdb.org/php/network_module_comparison/gene_compare_result.php?geneA=${this.geneA}&geneB=${this.geneB}`).then((response) => {
            console.log(response.data);
            if(response.data.geneAdata.length > 0) {
                response.data.geneAdata.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item.gene2,
                        isRootA: item.isRootA || false,
                        group: 'geneA',
                    }
                    if(item.isRootA) {
                        newOne.position = { x: 360, y: 400 }
                    } else {
                        let x = Math.floor(Math.random() * 500);
                        let y = Math.floor(Math.random() * 700);
                        newOne.position = {x: x, y: y};
                    }

                    this.nodes.push(newOne);

                    if(!item.isRootA) {
                        let edgeNewOne = {};
                        edgeNewOne.data = {
                            id: item.uuid,
                            source: item.gene1,
                            target: item.gene2,
                            group: 'geneA'
                        }
                        this.edges.push(edgeNewOne);
                    }
                })
            }
            if(response.data.geneBdata.length > 0) {
                response.data.geneBdata.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item.gene2,
                        isRootB: item.isRootB || false,
                        group: 'geneB',
                    }
                    if(item.isRootB) {
                        newOne.position = { x: 660, y: 400 }
                    } else {
                        let x = Math.floor(Math.random() * 500 + 500);
                        let y = Math.floor(Math.random() * 700);
                        newOne.position = {x: x, y: y};
                    }
                    this.nodes.push(newOne);

                    if(!item.isRootB) {
                        let edgeNewOne = {};
                        edgeNewOne.data = {
                            id: item.uuid,
                            source: item.gene1,
                            target: item.gene2,
                            group: 'geneB'
                        }
                        this.edges.push(edgeNewOne);
                    }
                })
            }
            if(response.data.geneRelation.length > 0) {
                response.data.geneRelation.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item.id,
                        source: item.gene_a,
                        target: item.gene_b,
                        isRootA: item.isRootA || false,
                        isConnect: true,
                    }
                    this.edges.push(newOne);
                })
            }
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
            //console.log(JSON.stringify(this.config.elements) );
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

