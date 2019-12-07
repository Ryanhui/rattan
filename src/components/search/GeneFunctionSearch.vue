<template>
  <div class="container">
    <h3>Gene function search result of <span style="color: rgb(47, 141, 50)">{{this.$route.params.gene}}</span></h3>
      <el-collapse v-model="activeNames" class="collapse-style">
        <el-collapse-item title="1. Annotation" name="1">
          <div class="wrapper">
           <!-- <h3>1. Annotation</h3> -->
           <el-table
             :data="gfs_tableData"
             style="width: 100%"
             size="mini"
             stripe
             border
             >
             <el-table-column
               prop="query"
               label="query"
               width="180">
             </el-table-column>
             <el-table-column
               prop="AT_gene"
               label="AT_gene"
               width="180">
             </el-table-column>
             <el-table-column
               prop="e_value"
               label="e_value">
             </el-table-column>
             <el-table-column
               prop="annotation"
               label="annotation">
             </el-table-column>
           </el-table>
           <p style="text-align: left;margin-top: 8px;color: #909399;font-style: italic;">based on blast</p>
          </div>
        </el-collapse-item>
        <el-collapse-item title="2. Location" name="2">
            <div>
              <!-- <h3>2. Location</h3> -->
              <div class="a80-table">
                <p class="location-p">Scaffold: {{this.locationTableData[0] ? this.locationTableData[0].scaffold : null }}</p>
                <p class="location-p">Strand: {{this.locationTableData[0] ? this.locationTableData[0].direction : null }}</p>
                <p class="location-p">Based on: {{this.locationTableData[0] ? this.locationTableData[0].maker : null }}</p>
                <el-table
                  :data="locationTableData"
                  border
                  size="small"
                  stripe
                  style="width: 100%;margin-top: 8px">
                  <el-table-column
                    prop="resion"
                    label="Resion">
                  </el-table-column>
                  <el-table-column
                    prop="start"
                    label="Start">
                  </el-table-column>
                  <el-table-column
                    prop="end"
                    label="End">
                  </el-table-column>
                </el-table>
                <div style="text-align: left">
                  <el-link :href="`/php/search_location_show_sequence.php?gene_id=${this.$route.params.gene}&species=${this.$route.params.species}`" target="_blank" type="primary" style="margin-top: 8px">Get Sequence</el-link>
                </div>
              </div>

            </div>
        </el-collapse-item>
        <el-collapse-item title="3. Network" name="3">
          <div style="width: 80%;margin: 0 auto;">
            <el-table
              :data="networkTableData"
              border
              stripe
              size="mini"
              >
              <el-table-column
                prop="source"
                label="Gene A"
                width="180">
              </el-table-column>
              <el-table-column
                prop="target"
                label="Gene B"
                width="180">
              </el-table-column>
              <el-table-column
                prop="length"
                label="PCC">
              </el-table-column>
              <el-table-column
                prop="mr"
                label="MR">
              </el-table-column>
              <el-table-column
                label="Relationship">
                <template slot-scope="scope">
                  {{scope.row.length > 0 ? 'Positive': 'Negative'}}
                </template>
              </el-table-column>
            </el-table>
            <div style="text-align: left">
              <el-link :href="`/php/search_top300.php?gene_id=${this.$route.params.gene}&species=${this.$route.params.species}`" target="_blank" type="primary" style="margin-top: 8px">Show top 300 PCC co-expression genes</el-link>
            </div>
          </div>
        </el-collapse-item>
        <el-collapse-item title="4. Functional module" name="4">
          <div class="wrapper">
            <!-- <h3>4. Functional module</h3> -->
            <el-table
                :data="function_module_tableData"
                style="width: 100%"
                size="mini"
                stripe
                border
              >
                <el-table-column
                  prop="gene"
                  label="Module Id"
                  width="140"
                >
                  <template slot-scope="scope">
                    <router-link class="a-link" target="_blank" :to="{ name: 'FunctionModule', params: { gene: scope.row.gene }}">{{scope.row.gene}}</router-link>
                    <!-- <a target="_blank" :href="'#/function_module?gene='+scope.row.gene">{{ scope.row.gene }}</a> -->
                  </template>
                </el-table-column>
                <el-table-column
                  prop="num1"
                  label="Background"
                >
                </el-table-column>
                <el-table-column
                  prop="describe1"
                  label="Annotation"
                >
                </el-table-column>
                <el-table-column
                  prop="num2"
                  label="Counts"
                >
                </el-table-column>
                <el-table-column
                  prop="value1"
                  label="P-value"
                >
                </el-table-column>
                <el-table-column
                  prop="value2"
                  label="FDR"
                >
                </el-table-column>
              </el-table>
          </div>
        </el-collapse-item>
        <el-collapse-item title="5. Cis-elements" name="5">
          <div>
            <div class="a80-table">
              <el-table
                :data="cisElementTableData"
                border
                size="small"
                stripe
                style="width: 100%">
                <el-table-column
                  prop="motif_id"
                  label="Motif Id">
                    <template slot-scope="scope">
                      <a style="margin-left: 10px" target="_blank" class="a-link" :href="'/motif/data/motif_information/'+scope.row.motif_id+'.txt'">{{ scope.row.motif_id }}</a>
                    </template>
                </el-table-column>
                <el-table-column
                  prop="motif_name"
                  label="Motif Name">
                </el-table-column>
                <el-table-column
                  prop="motif_pattern"
                  label="Motif Pattern">
                </el-table-column>
                <el-table-column
                  prop="counts"
                  label="Counts">
                </el-table-column>
                <el-table-column
                  prop="forward_position"
                  label="Forward Position">
                </el-table-column>
                <el-table-column
                  prop="reverse_postion"
                  label="Reverse Position">
                </el-table-column>
              </el-table>
            </div>
          </div>
        </el-collapse-item>
        <el-collapse-item title="6. Expression profilings" name="6">
          <div style="width: 100%;height:400px">
            <ve-bar :data="fpkmTableData" :settings="chartSettings" :legend-visible='false'></ve-bar>
          </div>
        </el-collapse-item>
        <el-collapse-item title="7. Gene family" name="7">
          <div>
            <!-- <h3>7. Gene family</h3> -->
            <div class="a80-table">
              <el-table
                :data="familyTableData"
                border
                size="small"
                stripe
                style="width: 100%">
                <el-table-column
                  prop="gene"
                  label="Gene">
                </el-table-column>
                <el-table-column
                  prop="function"
                  label="Gene Family">
                </el-table-column>
              </el-table>
            </div>
          </div>
        </el-collapse-item>
        <el-collapse-item title="8. Protein domain" name="8">
          <div>
            <!-- <h3>8. Protein domain</h3> -->
            <div class="canvas">
              <canvas ref="canvas" width="700px" height="200px" >您的浏览器暂不支持canvas</canvas>
              <span>
              Domains annotated by interpro were showed in image only
              </span>
            </div>
            <div class="a80-table">
              <el-table
                :data="dominTableData"
                border
                size="small"
                stripe
                style="width: 100%">
                <el-table-column
                  prop="Subject_id"
                  label="Id"
                  width="180">
                    <template slot-scope="scope">
                      <a target="_blank" :href="generate_domin_table_id_href(scope.row.Subject_id)" style="margin-left: 10px;color: #1e6f15">{{scope.row.Subject_id}}</a>
                    </template>
                </el-table-column>
                <el-table-column
                  prop="Subject_DB"
                  label="Database"
                  width="180">
                </el-table-column>
                <el-table-column
                  prop="Query_start"
                  label="Start">
                </el-table-column>
                <el-table-column
                  prop="Query_end"
                  label="End">
                </el-table-column>
                <el-table-column
                  prop="E_value"
                  label="E-value">
                </el-table-column>
                <el-table-column
                  prop="Subject_annotation"
                  label="Annotation">
                </el-table-column>
              </el-table>
            </div>
            <div ref="domin_detail" id="domin_detail">
              <p><span>Id: </span> <a target="_blank" style="color:#1e6f15" :href="'http://pfam.xfam.org/family/'+domin_detail_item.domin_id">{{domin_detail_item.domin_id}}</a></p>
              <p><span>Position: </span>{{domin_detail_item.start}} to {{domin_detail_item.end}}</p>
              <p><span>E-value: </span>{{domin_detail_item.e_value}}</p>
              <p><span>Domin length: </span>{{domin_detail_item.domin_length}}</p>
              <p><span>Annotation:</span> {{domin_detail_item.annotation}}</p>
              <p style="word-break:break-word;"><span>Pep sequence:</span> {{domin_detail_item.pep}}</p>
              <p style="word-break:break-word;"><span>Cds sequence:</span> {{domin_detail_item.cds}}</p>
            </div>
          </div>
        </el-collapse-item>
        <el-collapse-item title="9. KEGG Pathway" name="9">
          <div>
            <!-- <h3>9. KEGG Pathway</h3> -->
            <div class="a80-table">
              <el-table
                :data="keggTableData"
                border
                size="small"
                stripe
                style="width: 100%">
                <el-table-column
                  prop="description"
                  label="KEGG Ortholog">
                </el-table-column>
                <el-table-column
                  prop="kegg_id"
                  label="Pathway ID">
                    <template slot-scope="scope">
                      <a target="_blank" :href="generate_kegg_table_id_href(scope.row.kegg_id)" style="margin-left: 10px;color: #1e6f15">{{scope.row.kegg_id}}</a>
                    </template>
                </el-table-column>
              </el-table>
            </div>
          </div>
        </el-collapse-item>
        <el-collapse-item title="10. Gene Ontology" name="10">
          <div>
            <!-- <h3>10. Gene Ontology</h3> -->
            <div class="a80-table">
              <el-table
                :data="ontologyTableData"
                border
                size="small"
                stripe
                style="width: 100%">
                <el-table-column
                  prop="go_id"
                  label="GO Accession">
                    <template slot-scope="scope">
                      <a target="_blank" :href="'http://amigo.geneontology.org/amigo/term/'+scope.row.go_id" style="margin-left: 10px;color: #1e6f15">{{scope.row.go_id}}</a>
                    </template>
                </el-table-column>
                <el-table-column
                  prop="description"
                  label="GO Annotation">
                </el-table-column>
              </el-table>
            </div>
          </div>
        </el-collapse-item>
        <el-collapse-item title="11. Orthologous in Rattans" name="11">
          <div>
            <div class="a80-table">
              <el-table
                :data="orthologousTableData"
                border
                size="small"
                stripe
                style="width: 100%">
                <el-table-column
                  prop="gene_id_a"
                  label="Gene ID">
                </el-table-column>
                <el-table-column
                  prop="gene_id_b"
                  label="Gene ID">
                </el-table-column>
                <el-table-column
                  prop="value_a"
                  label="E-Value">
                </el-table-column>
              </el-table>
            </div>
          </div>
        </el-collapse-item>
      </el-collapse>
  
  </div>
</template>

<script>
export default {
  name: 'GeneFunctionSearch',
  components:{

  },
  data: function() {
    this.chartSettings = {
      yAxisType: 'category',
    }
    return {
      activeNames: ['1', '6'],

      gfs_tableData: [],
      function_module_tableData: [],
      dominData: [],
      dominTableData: [],
      domin_detail_item: {},
      locationTableData: [],
      familyTableData: [],
      keggTableData: [],
      ontologyTableData: [],
      networkTableData: [],
      cisElementTableData: [],
      orthologousTableData: [],

      fpkmTableData: {
          columns: [],
          rows: [
          ]
      },
    }
  },
  methods: {
    //1.Gene function search
    gfs_submit() {
      this.gfs_gene = this.$route.params.gene;
      this.gfs_species = this.$route.params.species;

      this.axios.get(`http://rattan.bamboogdb.org/php/search_gene_function.php?gene=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        this.gfs_tableData = response.data || [];
      })
    },
    //4.function module search
    function_module_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_fun_module.php?keyword=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        this.function_module_tableData = response.data || [];
      })
    },
    domin_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_domin.php?keyword=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        //console.log(response.data);
        this.dominData = response.data || [];
        if(response.data.length > 0) {
          this.canvasDraw();
        }
      })
      this.axios.get(`http://rattan.bamboogdb.org/php/search_pfam_id.php?subject_id=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        // console.log(response.data);
        this.dominTableData = response.data || [];
      })
    },
    location_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_location.php?gene_id=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        // console.log(response.data);
        this.locationTableData = response.data || [];
      })
    },
    family_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_gfam.php?function=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        // console.log(response.data);
        this.familyTableData = response.data || [];
      })
    },
    kegg_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_kegg.php?kegg_id=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        // console.log(response.data);
        this.keggTableData = response.data || [];
      })
    },
    ontology_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_go.php?go_id=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        // console.log(response.data);
        this.ontologyTableData = response.data || [];
      })
    },
    network_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/coExpressionGet.php?gene=${this.$route.params.gene}&database=${this.$route.params.species.toLowerCase()}&type=All`).then((response)=>{
        // console.log(response.data);
        this.networkTableData = response.data.edge || [];
      })
    },
    cisElement_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_cis_element.php?gene_id=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
        this.cisElementTableData = response.data || [];
      })
    },
    orthologous_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/search_orthologous.php?gene_id=${this.$route.params.gene}`).then((response)=>{
        this.orthologousTableData = response.data || [];
      })
    },
    fpkm_submit() {
      this.axios.get(`http://rattan.bamboogdb.org/php/fun_module_search/fpkm.php?gene=${this.$route.params.gene}&species=${this.$route.params.species}`).then((response)=>{
      let rows = [];
        response.data.forEach((item) => {
          for(let key in item){
            if(/cirrus/g.test(key)) {
              rows.push({
                //gene_id: item.gene_id,
                cirrus: key,
                value: item[key]
              })
            }
          } 
        })
        let chartData = {
          columns: ['cirrus', 'value'],
          rows: rows,
        }
        this.fpkmTableData = chartData;
      })
    },
    // draw picture
    canvasDraw() {
      let canvas = this.$refs.canvas;
      let ctx = canvas.getContext("2d");

      // 获取鼠标相对cavas位置
	    function getMousePosCanvas(canvas, evt) {
	      var rect = canvas.getBoundingClientRect(); 
	      return { 
	        x: evt.clientX - rect.left * (canvas.width / rect.width),
	        y: evt.clientY - rect.top * (canvas.height / rect.height)
	      }
      }

      // 获取鼠标相对于屏幕位置
      function getMousePos(event) {
        var e = event || window.event;
        return {'x':e.clientX,'y':e.clientY}
      }

      let maxLength = 0;
      let baseHeight = 100;
      // ctx.font = '18px Arial';
      // ctx.fillStyle = 'rgba(50, 50, 50, 1)';
      // ctx.fillText(this.$route.params.gene, 10, 20);

      // 画gene线
      this.dominData.forEach((item) => {
        let newLength = Number(item.end);
        if( newLength > maxLength) {
          maxLength = newLength;
        }
      });
      // 重设画布大小
      if(maxLength >= 700) {
        canvas.width = maxLength;
      }
      ctx.fillStyle = 'rgba(50, 50, 50, 0.5)';
      ctx.fillRect(0, baseHeight, maxLength + 100, 3);

      // 画比例尺
      ctx.font = '12px serif';
      ctx.fillStyle = 'rgba(50, 50, 50, 0.8)';
      for(let i = 0; i <= maxLength + 200; i+=100) {
        ctx.fillRect(i, baseHeight + 55, 1, 3);
        ctx.fillText(i, i, baseHeight + 70);
      }
      ctx.fillRect(0, baseHeight+ 57, maxLength + 200, 1);

      // 画domin
      this.dominData.forEach(item => {
        ctx.fillStyle = 'rgba('+(Math.random()*100).toFixed()+', '+(Math.random()*100).toFixed()+', '+(Math.random()*100).toFixed()+', 1)';
        ctx.fillRect(Number(item.start), 86, Number(item.domin_length), 30);
        let textY = 40 + Math.floor(Math.random() * 5) * 10;
        ctx.fillText(item.domin_id, Number(item.start)-11,  textY);
        ctx.fillRect(Number(item.start)+10, textY + 3, 1, 80 - textY);
      })

      //添加事件
      let that = this;
      ctx.save();
      canvas.addEventListener("mousemove", function(event) {
        let mousePosCanvas = getMousePosCanvas(canvas, event);
        let pageX = mousePosCanvas.x;
        let pageY = mousePosCanvas.y;

        let mousePos = getMousePos();
        
        //that.$refs.domin_detail.style.display = 'none';
        
        that.dominData.forEach(item => {
          if(pageX >= Number(item.start) && pageX <= Number(item.end) && pageY >= 90 && pageY <= 120){
            // console.log(item);
            that.domin_detail_item = item;
            that.$refs.domin_detail.style.display = 'block';
            that.$refs.domin_detail.style.left = mousePos.x + 10 + 'px';
            that.$refs.domin_detail.style.top = mousePos.y + 20 + 'px';
          }
        })
      });
      document.addEventListener("click", function(event) {
        let flag = false;
        for (let i = 0; i < event.path.length; i++) {
          if(event.path[i].id === 'domin_detail') {
            flag = true;
            break;
          }
        }
        if (flag) {
          return;
        } else {
          that.$refs.domin_detail.style.display = 'none';
        };
      });
    },
    generate_domin_table_id_href(id){
      if(/PF/g.test(id)) {
        return (`http://pfam.xfam.org/family/${id}`);
      }
      if(/PTHR/g.test(id)) {
        return (`http://pantherdb.org/panther/family.do?clsAccession=${id}`);
      }
      if(/SM/g.test(id)) {
        return (`http://smart.embl-heidelberg.de/smart/do_annotation.pl?BLAST=DUMMY&DOMAIN=${id}`);
      }
      if(/PS/g.test(id)) {
        return (`https://prosite.expasy.org/${id}`);
      }
    },
    generate_kegg_table_id_href(id){
      if(/K/g.test(id)) {
        return (`https://www.genome.jp/dbget-bin/www_bget?ko:${id}`);
      }
      if(/map/g.test(id)) {
        return (`https://www.genome.jp/kegg-bin/show_pathway?${id}`);
      }
    }
  },
  mounted: function() {
    this.gfs_submit();
    this.function_module_submit();
    this.domin_submit();
    this.location_submit();
    this.family_submit();
    this.kegg_submit();
    this.ontology_submit();
    this.network_submit();
    this.cisElement_submit();
    this.orthologous_submit();
    this.fpkm_submit();
  }
}

</script>

<style scoped>
  .container {
    
  }
  .wrapper {
    width: 80%;
    margin: 16px auto;
  }
  .collapse-style {
    width: 85%;
    margin: 24px auto;
  }
  .a-link {
    color: rgb(11, 146, 63);

  }
  .canvas {
    padding: 16px; 
    border: 1px solid black; 
    width: 732px; 
    height: 252px;
    margin: 0 auto;
    overflow-x: scroll;
  }
  #domin_detail {
    position: absolute;
    z-index: 99;
    width: 400px;
    min-height: 300px;
    padding: 8px 16px;
    text-align: left;
    font-size: 14px;
    top: 300px;
    left: 400px;
    color: rgb(109, 108, 108);
    background: rgb(255, 255, 255);
    display: none;
    border-radius: 5px;
    box-shadow:0px 0px 5px 0px rgba(105, 105, 105, 0.7);
  }
  #domin_detail p {
    padding: 4px 0;
  }
  #domin_detail span {
    font-weight: 700;
    font-size: 16px;
    color: rgb(39, 39, 39);
  }
  .a80-table {
    width: 80%;
    margin: 0 auto;
    margin-top: 16px;
  }
  .location-p {
    color: #909399;
    text-align: left;
    font-size: 14px;
  }
</style>

