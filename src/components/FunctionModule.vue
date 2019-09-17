<template>
  <div class="container">
    <h3>{{ this.$route.params.gene }}</h3>
    <div class="cystyle" v-if="showNetwork">
      <!-- <cytoscape :config="config">
        <cy-element
          v-for="def in networkData"
          :key="`${def.data.id}`"
          :definition="def"
        />
      </cytoscape> -->
      <cytoscape :config="config" />
    </div>
  </div>
</template>

<script>
const config = {
  elements: [],
  minZoom: 0.5,
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
    name: 'random',

    fit: false, // whether to fit to viewport
    padding: 30, // fit padding
    boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
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
        },1000)
      })
    },
  },
  mounted: function() {
    this.network_submit();
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
</style>

