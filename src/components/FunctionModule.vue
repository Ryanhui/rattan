<template>
  <div class="container">
    <h3>{{ this.$route.params.gene }}'s Networks</h3>
    <div class="cystyle" v-if="showNetwork">
      <cytoscape :config="config" />
    </div>
    <h3>Module annotation from GSEA</h3>
    <el-table
      :data="mafg_tableData"
      border
      class="mafg-table">
      <el-table-column
        prop="describe1"
        label="">
      </el-table-column>
      <el-table-column
        prop="value2"
        label="">
      </el-table-column>
    </el-table>
    <h3>Module member annotation</h3>
    <el-table
      :data="mma_tableData"
      border
      class="mafg-table">
      <el-table-column
        prop="query"
        label="">
      </el-table-column>
      <el-table-column
        prop="AT_gene"
        label="">
      </el-table-column>
      <el-table-column
        prop="e_value"
        label="">
      </el-table-column>
      <el-table-column
        prop="annotation"
        label="">
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
const config = {
  elements: [],
  minZoom: 0,
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
      selector: 'edge[length > 0]',
      style: {
        'width': 0.3,
        'line-color': '#566270',
        'target-arrow-color': '#566270',
        'target-arrow-shape': 'triangle'
      }
    },
    {
      selector: 'edge[length < 0]',
      style: {
        'width': 0.3,
        'line-color': '#F68657',
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
  name: 'FunctionModule',
  components:{

  },
  data: function() {
    return {
      config,
      networkData: [],
      showNetwork: false,

      mafg_tableData: [],
      mma_tableData: []
    }
  },
  methods: {
    network_submit() {
      this.showNetwork = false;
      this.axios.get(`http://rattan.bamboogdb.org/php/fun_module_search/networks.php?id=${this.$route.params.gene}`).then((response)=>{
        // console.log(response);
        // this.networkData = response.data;
        let result = [];
        let node = [];
        response.data.forEach(element => {
          node.push(element.source, element.target);
        });

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
          }
          result.push(obj);
        });

        // this.networkData = result;
        this.config.elements = result;
        let self = this;
        setTimeout(function(){
          self.showNetwork = true;
        },500)
      })
    },

    mafg_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/fun_module_search/mafg.php?id=${this.$route.params.gene}`).then((response)=>{
        // console.log(response);
        this.mafg_tableData = response.data || [];
      });
    },

    mma_submit() { //module memeber annotation
      let pattan = /Calsi/;
      let species = pattan.test(this.$route.params.gene) ? 'Calsi' : 'Daeje';
      let gene = this.$route.params.gene.replace('Module','gene0');
      this.axios.get(`http://rattan.bamboogdb.org/php/search_gene_function.php?gene=${gene}&species=${species}`).then((response)=>{
        console.log(response);
        this.mma_tableData = response.data || [];
      });
    }
  },
  mounted: function() {
    this.network_submit();
    this.mafg_submit();
    this.mma_submit();
  }
}

</script>

<style scoped>
  .container {
    min-height: 550px;
    position: relative;
  }
  .cystyle {
    height: 600px;
    text-align: left;
    position: relative;
    width: 95%;
    margin: 0 auto;
  }
  .mafg-table {
    width: 80%; 
    margin: 24px auto;
  }
</style>

