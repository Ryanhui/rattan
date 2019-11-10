<template>
  <div>
    <h3>
    Comparision between <span style="color: red">{{ this.$route.params.module1 }}</span> and <span style="color: red">{{ this.$route.params.module2 }}</span>
    </h3>
    <div class="cystyle" v-if="showNetwork">
      <cytoscape :config="config" />
    </div>
    <div>
      <h3>1.Module annotation (GSEA enrichment result)</h3>
      <el-table
      :data="mafg_tableData"
      border
      stripe
      size="mini"
       :default-sort = "{prop: 'value2', order: 'descending'}"
      class="mafg-table">
      <el-table-column
        prop="gene"
        label="Gene Id">
      </el-table-column>
      <el-table-column
        prop="describe1"
        label="Annotation">
      </el-table-column>
      <el-table-column
        prop="value2"
        label="FDR"
        sortable
        >
      </el-table-column>
    </el-table>
    </div>
    <div style="margin: 24px 0">
      <h3>2.Module member annotation</h3>
      <el-table
        :data="mma_tableData"
        border
        stripe
        size="mini"
        class="mafg-table">
        <el-table-column
          prop="query"
          label="Gene ID">
        </el-table-column>
        <el-table-column
          prop="AT_gene"
          label="Orthologous gene in Arabidopsis thaliana">
        </el-table-column>
        <el-table-column
          prop="e_value"
          label="E-value">
        </el-table-column>
        <el-table-column
          prop="annotation"
          label="Annotation">
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>

<script>
const config = {
  elements: [],
  minZoom: 0.4,
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
      "selector": "node[?isRoot]",
        "style": {
          "background-color": "#2b90d9",
        }
    },
    {
      selector: 'edge[group = "module1"]',
      style: {
        'width': 0.8,
        'line-color': '#F68657',
        'target-arrow-color': '#F68657',
        'target-arrow-shape': 'triangle'
      }
    },
    {
      selector: 'edge[group = "module2"]',
      style: {
        'width': 0.8,
        'line-color': '#566270',
        'target-arrow-color': '#F68657',
        'target-arrow-shape': 'triangle'
      }
    }
  ],

  layout: {
      name: 'concentric',

      fit: true, // whether to fit the viewport to the graph
      padding: 30, // the padding on fit
      startAngle: 3 / 2 * Math.PI, // where nodes start in radians
      sweep: undefined, // how many radians should be between the first and last node (defaults to full circle)
      clockwise: true, // whether the layout should go clockwise (true) or counterclockwise/anticlockwise (false)
      equidistant: false, // whether levels have an equal radial distance betwen them, may cause bounding box overflow
      minNodeSpacing: 30, // min spacing between outside of nodes (used for radius adjustment)
      boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
      avoidOverlap: true, // prevents node overlap, may overflow boundingBox if not enough space
      nodeDimensionsIncludeLabels: true, // Excludes the label when calculating node bounding boxes for the layout algorithm
      height: undefined, // height of layout area (overrides container height)
      width: undefined, // width of layout area (overrides container width)
      spacingFactor: undefined, // Applies a multiplicative factor (>0) to expand or compress the overall area that the nodes take up
      concentric: function( node ){ // returns numeric value for each node, placing higher nodes in levels towards the centre
      return node.degree();
      },
      levelWidth: function( nodes ){ // the letiation of concentric values in each level
      return nodes.maxDegree() / 4;
      },
      animate: true, // whether to transition the node positions
      animationDuration: 500, // duration of animation in ms if enabled
      animationEasing: undefined, // easing of animation if enabled
      animateFilter: function ( node, i ){ return true; }, // a function that determines whether the node should be animated.  All nodes animated by default on animate enabled.  Non-animated nodes are positioned immediately when the layout starts
      ready: undefined, // callback on layoutready
      stop: undefined, // callback on layoutstop
      transform: function (node, position ){ return position; } // transform a given node position. Useful for changing flow direction in discrete layouts
    },
  }
export default {
  name: 'FunctionModuleDetail',
  components:{

  },
  data:function() {
    return {
      config,
      module1_network: [],
      module2_network: [],
      network: [],
      showNetwork: false,

      module1_gene_list: [],
      module2_gene_list: [],

      mafg_module1_tableData: [],
      mafg_module2_tableData: [],
      mafg_tableData: [],

      mma_module1_tableData: [],
      mma_module2_tableData: [],
      mma_tableData: [],
    }
  },
  methods: {
    async network_submit(module) {
      //this.showNetwork = false;
      let whichModule = '';
      if(module === 'module1') {
        whichModule = this.$route.params.module1;
      } else {
        whichModule = this.$route.params.module2;
      }
      await this.axios.get(`http://rattan.bamboogdb.org/php/fun_module_search/networks.php?id=${whichModule}`).then((response)=>{
        console.log(response);
        let result = [];
        let node = [];
        let geneList = [];
        
        response.data.forEach(element => {
          node.push(element.source, element.target);
          geneList.push(element.source, element.target);
        });

        geneList = Array.from(new Set(geneList));

        Array.from(new Set(node)).forEach(element => {
          let obj = {};
          obj.data = {
            id: element,
          }
          result.push(obj);
        })

        response.data.forEach(element => {
          let obj = {};
          obj.data = {
            id: element.id,
            source: element.source,
            target: element.target,
            distance: element.distance,
            group: module === 'module1' ? 'module1' : 'module2',
          }
          result.push(obj);
        });

        if(module === 'module1') {
          this.module1_network = result;
          this.module1_gene_list = geneList;
        } else {
          this.module2_network = result;
          this.module2_gene_list = geneList;
        }
      })
    },
    async getNetwork() {
      await this.network_submit('module1');
      await this.network_submit('module2');

      this.config.elements = this.module1_network.concat(this.module2_network);
      this.showNetwork = true;
    },

    async mafg_submit(module) {
      let whichModule = '';
      if(module === 'module1') {
        whichModule = this.$route.params.module1;
      } else {
        whichModule = this.$route.params.module2;
      }
      await this.axios.get(`http://rattan.bamboogdb.org/php/fun_module_search/mafg.php?id=${whichModule}`).then((response)=>{
        // console.log(response);
        if(module === 'module1') {
          this.mafg_module1_tableData = response.data || [];
        } else {
          this.mafg_module2_tableData = response.data || [];
        }
      });
    },
    async getMafg() {
      await this.mafg_submit('module1');
      await this.mafg_submit('module2');
      this.mafg_tableData = this.mafg_module1_tableData.concat(this.mafg_module2_tableData);
      //console.log(this.mafg_tableData);
      await this.mma_submit();
    },

    async mma_submit() { //module memeber annotation
      let pattan = /Calsi/;
      let species = pattan.test(this.$route.params.module1) ? 'Calsi' : 'Daeje';
      let gene = this.module2_gene_list.concat(this.module1_gene_list).join(',');
      await this.axios.get(`http://rattan.bamboogdb.org/php/fun_module_search/mma.php?gene=${gene}&species=${species}`).then((response)=>{
        let newList = [];
        response.data.forEach(item => {
          newList.push(item.query);
        });
        let geneList = this.module1_gene_list.concat(this.module2_gene_list);
        let addList = newList.concat(geneList).filter(v => !newList.includes(v));
        addList = Array.from(new Set(addList));
        let setResult = addList.map(item => {
          return {
            query: item,
            AT_gene: '-',
            e_value: '-',
            annotation: '-'
          }
        })
        this.mma_tableData = response.data.concat(setResult) || [];
      });
    },
  },
  mounted: function() {
   this.getNetwork();
   this.getMafg();
  }
}
</script>

<style scoped>
  .cystyle {
    height: 600px;
    text-align: left;
    position: relative;
    width: 95%;
    margin: 0 auto;
  }
  .mafg-table {
    width: 80%;
    margin: 0 auto;
  }
</style>