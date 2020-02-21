<template>
    <div v-loading="loading" class="container">
      <div style="margin-top: 24px"><p>Comparison between <span class="red">{{geneA}}</span> and <span class="red">{{geneB}}</span></p></div>
      <div class="cystyle" v-if="showNetwork">
        <cytoscape :config="config" />
      </div>
      <div class="image-noti"><p>Orange and blue line links co-expression genes. Green line links orthologous genes between two rattans. The comparison based on top300 PCC co-expression genes.
</p></div>
      <div style="margin-top:12px">
        <el-button type="primary" plain size="small"  v-on:click="download('geneA')">{{geneA + '.PCC300'}}</el-button>
        <el-button type="primary" plain size="small"  v-on:click="download('geneB')">{{geneB + '.PCC300'}}</el-button>
      </div>
      <p class="table-title">orthologous genes between two rattans in the figure</p>
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
              prop="function_b"
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
    this.geneA = this.$route.query.geneA.trim();
    this.geneB = this.$route.query.geneB.trim();

    this.onSubmitGene();
  },
  methods: {
      onSubmitGene() {
        this.axios.get(`http://rattan.bamboogdb.org/php/network_module_comparison/gene_compare_result.php?geneA=${this.geneA}&geneB=${this.geneB}`).then((response) => {
            console.log(response.data);
            let correctGeneA = '',
                correctGeneB = '';
            if(/Calsi/.test(this.geneA)) {
              correctGeneA = this.geneA;
              correctGeneB = this.geneB;
            } else {
              correctGeneA = this.geneB;
              correctGeneB = this.geneA;
            }
            /////////////////////////////////////// geneA //////////////////////////////////////
            if(response.data.geneAdata.length > 0) {
                    let newOne = {};
                    let geneid = response.data.geneAdata[response.data.geneAdata.length-1].gene2;
                    if(/Calsi/.test(geneid)) {
                      newOne.data = {
                          id: geneid,
                          isRootA: true,
                          group: 'geneA',
                      }
                      newOne.position = { x: 360, y: 400 }
                    } else {
                        newOne.data = {
                          id: geneid,
                          isRootB: true,
                          group: 'geneB',
                      }
                      newOne.position = { x: 660, y: 400 }
                    }
                    this.nodes.push(newOne);
            }
            //////////////////////////////////////////// geneB ////////////////////////////////////////
            if(response.data.geneBdata.length > 0) {
                    let newOne = {};
                    let geneid = response.data.geneBdata[response.data.geneBdata.length-1].gene2;
                    if(/Calsi/.test(geneid)) {
                      newOne.data = {
                          id: geneid,
                          isRootA: true,
                          group: 'geneA',
                         
                      }
                      newOne.position = { x: 360, y: 400 }
                    } else {
                        newOne.data = {
                          id: geneid,
                          isRootB: true,
                          group: 'geneB',
                      }
                      newOne.position = { x: 660, y: 400 }
                    }
                    this.nodes.push(newOne);
            }
            //////////////////////////////////////// all nodes ////////////////////////////////////////////
            if(response.data.geneRelation.length > 0) {
                response.data.geneRelation.forEach(item => {
                    let newOne = {};
                    newOne.data = {
                        id: item.id,
                        source: item.gene_a,
                        target: item.gene_b,
                        // isRootA: item.isRootA || false,
                        isConnect: true,
                    }
                    this.edges.push(newOne);
                    /////////////// nodes ///////////////
                    if(item.gene_a !== correctGeneA && item.gene_b !== correctGeneB && item.gene_a !== correctGeneB && item.gene_b !== correctGeneA) {
                        if(/Calsi/.test(item.gene_a)) {
                            let newOne = {};
                            newOne.data = {
                                id: item.gene_a,
                                isRootA: false,
                                isRoot: false,
                                group: 'geneA',
                            }
                            let x = Math.floor(Math.random() * 500);
                            let y = Math.floor(Math.random() * 700);
                            newOne.position = {x: x, y: y};
                            this.nodes.push(newOne);

                            let newOne2 = {};
                            newOne2.data = {
                                id: item.gene_b,
                                isRootA: false,
                                group: 'geneB',
                            }
                            x = Math.floor(Math.random() * 500 + 500);
                            y = Math.floor(Math.random() * 700);
                            newOne2.position = {x: x, y: y};
                            this.nodes.push(newOne2);
                        } else {
                            let newOne = {};
                            newOne.data = {
                                id: item.gene_a,
                                isRootA: false,
                                isRoot: false,
                                group: 'geneB',
                            }
                            let x = Math.floor(Math.random() * 500 + 500);
                            let y = Math.floor(Math.random() * 700);
                            newOne.position = {x: x, y: y};
                            this.nodes.push(newOne);

                            let newOne2 = {};
                            newOne2.data = {
                                id: item.gene_b,
                                isRootA: false,
                                group: 'geneA',
                            }
                            x = Math.floor(Math.random() * 500);
                            y = Math.floor(Math.random() * 700);
                            newOne2.position = {x: x, y: y};
                            this.nodes.push(newOne2);
                        }
                    }
                    
                })
            }
            
            console.log(this.nodes);

            /////////////////////////// node edges ////////////////////////////
            this.nodes.forEach((item) => {
              if(!item.data.isRootA && !item.data.isRootB) {
                let newOne = {};
                newOne.data = {
                    //id: item.id,
                    source: item.data.id,
                    target: /Calsi/.test(item.data.id) ? correctGeneA : correctGeneB,
                    isRootA: false,
                    isConnect: false,
                    group: /Calsi/.test(item.data.id) ? 'geneA' : 'geneB'
                }
                this.edges.push(newOne);
              }
            }) 

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
      download(data) {
        // window.open(data.address)
        // window.location.href = address;
        if(data === 'geneA') {
          data = this.geneA;
        }
        data = this.geneB;
        let eleLink = document.createElement('a');
        eleLink.download = data + '.PCC300';
        eleLink.style.display = 'none';
        eleLink.href = '/web_data/Rattan_NET/comparision/PCC_top300/' + data + '.PCC300';
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
  .red {
    color: red;
  }
  .image-noti {
    width: 50%;
    margin: 0 auto;
  }
  .table-title {
    margin-top: 48px;
  }
</style>

