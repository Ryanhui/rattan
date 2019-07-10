<template>
  <div class="container">
  <div class="pannel">
    <p class="title">Co-expression network analysis</p>
    <div id="holder" v-if="show">
      <cytoscape :config="config" />
    </div>
    <el-tabs type="border-card" v-model="form.activeName" @tab-click="handleTabClick" stretch class="tabs">
      <el-tab-pane label="Calsi" name="calsi">
        <el-form ref="form" :model="form" label-width="120px" class="form">
          <el-form-item label="Single Or List">
            <el-radio-group v-model="form.singleOrList">
              <el-radio label="single"></el-radio>
              <el-radio label="list"></el-radio>
            </el-radio-group>
          </el-form-item>          
          <el-form-item label="Single gene" required v-show="form.singleOrList === 'single'">
            <el-input v-model="form.gene" ></el-input>
            <span>Example: Calsi_gene44939</span>
          </el-form-item>
          <el-form-item label="List of genes" required v-show="form.singleOrList === 'list'">
            <el-input type="textarea" v-model="form.genes" rows="5"></el-input>
            <span v-on:click="addExample" style="cursor: pointer">Example: Calsi</span>
          </el-form-item>
          <el-form-item label="Type">
            <el-radio-group v-model="form.type">
              <el-radio label="Positive"></el-radio>
              <el-radio label="Negative"></el-radio>
            </el-radio-group>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" style="margin-left: 28px" :loading="loading" @click="onSubmit">Search</el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>
      <el-tab-pane label="Daeje" name="daeje">
        <el-form ref="form" :model="form" label-width="120px" class="form">
          <el-form-item label="Single Or List">
            <el-radio-group v-model="form.singleOrList">
              <el-radio label="single"></el-radio>
              <el-radio label="list"></el-radio>
            </el-radio-group>
          </el-form-item>          
          <el-form-item label="Single gene" required v-show="form.singleOrList === 'single'">
            <el-input v-model="form.gene"></el-input>
            <span>Example: Daeje_Gene46292</span>
          </el-form-item>
          <el-form-item label="List of genes" required v-show="form.singleOrList === 'list'">
            <el-input type="textarea" v-model="form.genes" rows="5"></el-input>
            <span v-on:click="addExample" style="cursor: pointer">Example: daeje</span>
          </el-form-item>
          <el-form-item label="Type">
            <el-radio-group v-model="form.type">
              <el-radio label="Positive"></el-radio>
              <el-radio label="Negative"></el-radio>
            </el-radio-group>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" style="margin-left: 28px" :loading="loading" @click="onSubmit">Search</el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>
    </el-tabs>
  </div>
  </div>
</template>

<script>
const config = {
  elements: [],
  minZoom: 1,
  //maxZoom:100,
  style: [ // the stylesheet for the graph
    {
      selector: 'node',
      style: {
        'width': '10px',
        'height': '10px',
        'background-color': '#666',
        'label': 'data(id)',
        'font-size': '4px',
      }
    },

    {
      selector: 'edge',
      style: {
        'width': 1,
        'line-color': '#ccc',
        'target-arrow-color': '#ccc',
        'target-arrow-shape': 'triangle'
      }
    }
  ],

  layout: {
    name: 'concentric',

    fit: true,
    padding: 30, // the padding on fit
    startAngle: 3 / 2 * Math.PI, // where nodes start in radians
    sweep: undefined, // how many radians should be between the first and last node (defaults to full circle)
    clockwise: true, // whether the layout should go clockwise (true) or counterclockwise/anticlockwise (false)
    equidistant: false, // whether levels have an equal radial distance betwen them, may cause bounding box overflow
    minNodeSpacing: 10, // min spacing between outside of nodes (used for radius adjustment)
    boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
    avoidOverlap: true, // prevents node overlap, may overflow boundingBox if not enough space
    nodeDimensionsIncludeLabels: false, // Excludes the label when calculating node bounding boxes for the layout algorithm
    height: undefined, // height of layout area (overrides container height)
    width: undefined, // width of layout area (overrides container width)
    spacingFactor: undefined, // Applies a multiplicative factor (>0) to expand or compress the overall area that the nodes take up
    concentric: function( node ){ // returns numeric value for each node, placing higher nodes in levels towards the centre
      return node.degree();
    },
    levelWidth: function( nodes ){ // the letiation of concentric values in each level
      return nodes.maxDegree() / 4;
    },
    animate: false, // whether to transition the node positions
    animationDuration: 500, // duration of animation in ms if enabled
    animationEasing: undefined, // easing of animation if enabled
    animateFilter: function ( node, i ){ return true; }, // a function that determines whether the node should be animated.  All nodes animated by default on animate enabled.  Non-animated nodes are positioned immediately when the layout starts
    ready: undefined, // callback on layoutready
    stop: undefined, // callback on layoutstop
    transform: function (node, position ){ return position; } 
    },
  }
  // const elements = [...config.elements]
  // delete config.elements

export default {
  name: 'CoExpression',
  components:{

  },
  data () {
    return {
      config,
      i: 0,
      elements: [],
      loading: false,
      show: false,

      form: {
          activeName: 'calsi',

          singleOrList: 'single',
          gene: '',
          genes: '',
          type: 'Positive',
      }
    }
  },
  methods: {
    addExample () {
      if (this.form.activeName === 'calsi') {
        this.form.genes = `Calsi_gene46977 
Calsi_gene44939 
Calsi_gene13781`;
      } else {
        this.form.genes = `Daeje_Gene09510 
Daeje_Gene00887 
Daeje_Gene26990`;
      }
    },
    handleTabClick () {
      this.form.gene = '';
      this.form.genes = '';
    },
    onSubmit () {
      if(this.form.singleOrList === 'single' && this.form.gene === '') {
        this.$message({
          message: 'Please input gene',
          type: 'error'
        });
        return;
      }
      if(this.form.singleOrList === 'list' && this.form.genes === '') {
        this.$message({
          message: 'Please input genes',
          type: 'error'
        });
        return;
      }
      console.log(this.form)
      if(this.form.singleOrList === 'single') {
        this.show = false;
        this.loading = true;
        this.axios.get(`http://rattan.bamboogdb.org/coExpressionGet.php?gene=${this.form.gene}&database=${this.form.activeName}&type=${this.form.type}`).then((response) => {
          console.log(response.data)
          const rowData = response.data;
          if(response.data === 'no_data') {
              this.$message({
                message: 'No result',
                type: 'error'
              });
              this.loading = false;
              return;
          }
          let newElement = [];
          newElement.push({data: { id: rowData.root }});
          rowData.node.forEach(element => {
            newElement.push({data: { id: element }});
          });
          rowData.edge.forEach(element => {
            newElement.push({data: { id: element.id, source: element.source, target: element.target }})
          });
          this.elements = newElement;
          this.config.elements = newElement;
          const self = this;
          setTimeout(function(){
            self.show = true;  
            self.loading = false;
          },1000);
        })
      } else {
        var data = new FormData();
        data.append('database',this.form.activeName);
        data.append('genes',this.form.genes);
        data.append('type', this.form.type);
        
        this.show = false;
        this.loading = true;
        this.axios.post('http://rattan.bamboogdb.org/coExpressionPost.php', data).then((response) => {
          console.log(response);
          const rowData = response.data;
          let stop = false;
          let newElement = [];

          rowData.root.forEach((item) => {
            if(item === '') {
              this.$message({
                message: 'Please check input format',
                type: 'error'
              });
              stop = true;
            }
            newElement.push({data: { id: item.replace(/\s/g, '')}});
          })
          
          if(stop) {
            this.loading = false;
            return;
          }

          rowData.node.forEach(element => {
            newElement.push({data: { id: element }});
          });

          rowData.edge.forEach(element => {
            newElement.push({data: { id: element.id, source: element.source, target: element.target }})
          });
          this.elements = newElement;
          this.config.elements = newElement;
          const self = this;
          setTimeout(function(){
            self.show = true;  
            self.loading = false;
          },1000);
        }).catch((error) => {

        })
      }
    }
  }
}

</script>

<style scoped>
  .container {
    min-height: 800px;
    position: relative;
    text-align: initial;
  }
  .pannel {
    margin-top: 24px;
  }
  .title {
    font-size: 32px;
    text-align: center;
  }
  .tabs {
    width: 80%;
    margin: 24px auto 24px auto;
  }
  .form {
    width: 400px;
    margin: 24px auto 0 auto;
  }
  #holder {
    width: 100%;
    height: 700px;
  }
  .cytoscape-area {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 9;
  }
</style>

