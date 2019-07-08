<template>
  <div class="container">
    <!-- <div id="holder">
    <cytoscape
      :config="config"
      v-on:cxttapstart="updateNode"
    >
      <cy-element
        v-for="def in elements"
        :key="`${def.data.id}`"
        :definition="def"
      />
    </cytoscape>
  </div> -->
  <div class="pannel">
    <p class="title">Co-expression network analysis</p>
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
            <el-button type="primary" style="margin-left: 28px" @click="onSubmit">Search</el-button>
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
            <el-button type="primary" style="margin-left: 28px" @click="onSubmit">Search</el-button>
          </el-form-item>
        </el-form>
      </el-tab-pane>
    </el-tabs>
  </div>
  </div>
</template>

<script>
const config = {
  elements: [
    {
      // node a
      data: { id: 'a' },
      position: { x: 589, y: 182 }
    },
    {
      // node b
      data: { id: 'b' },
      position: { x: 689, y: 282 }
    },
    {
      // node c
      data: { id: 'c' },
      position: { x: 489, y: 282 }
    },
    {
      // node c
      data: { id: 'd' },
      position: { x: 389, y: 282 }
    },
    {
      // edge ab
      data: { id: 'ab', source: 'a', target: 'b' },
    },
    {
      data: { id: 'bc', source: 'a', target: 'c' },
    },
    {
      data: { id: 'ad', source: 'a', target: 'd' },
    },
    {
      data: { id: 'adc', source: 'c', target: 'd' },
    }
  ],
  style: [
    {
      selector: 'node',
      style: {
        'background-color': '#666',
        label: 'data(id)'
      }
    },
    {
      selector: 'edge',
      style: {
        width: 3,
        'line-color': '#ccc',
        'target-arrow-color': '#ccc',
        'target-arrow-shape': 'triangle'
      }
    }
  ],
  layout: {
    name: 'grid',
    rows: 1
  }
}
const elements = [...config.elements]
delete config.elements

export default {
  name: 'CoExpression',
  components:{

  },
  data () {
    return {
      config,
      i: 0,
      elements,
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
      this.axios.get(`http://rattan.bamboogdb.org/ajax.php?gene=${this.form.gene}&database=${this.form.activeName}&type=${this.form.type}`).then((response) => {
        console.log(response.data)
      })
    },
    addNode (event) {
      const { position } = event
      const n = {
        group: 'nodes',
        data: { id: `n${this.i++}` },
        position
      }
      this.elements = [...this.elements, n]
    },
    updateNode (event) {
      if (event.target.id) {
        const n = {
          data: { id: event.target.id(), shape: 'rectangle' },
          position: event.target.position(),
          group: 'nodes'
        }
        // console.log('updating: ', n)
        const elements = [
          ...this.elements.filter(e => e.data.id !== event.target.id()),
          n
        ]
        // console.log('filtered elements: ', elements)
        this.elements = elements
      }
    },
    removeNode (event) {
      if (event.target.id) {
        // console.log('removing: ', event.target.id())
        this.elements = this.elements.filter(
          e => e.data.id !== event.target.id()
        )
      }
    }
  }
}

</script>

<style scoped>
  .container {
    min-height: 600px;
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
    margin: 24px auto 0 auto;
  }
  .form {
    width: 400px;
    margin: 24px auto 0 auto;
  }
  #holder {
    width: 100%;
    height: 100%;
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

