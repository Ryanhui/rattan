<template>
  <div class="container">
    <div class="wrapper">
      <h3>1. Annotation</h3>
      <el-table
        :data="gfs_tableData"
        style="width: 100%"
        size="mini"
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
    </div>
    <div>
      <h3>2. Location</h3>
    </div>
    <div>
      <h3>3. Network</h3>
    </div>
    <div class="wrapper">
      <h3>4. Functional module</h3>
      <el-table
          :data="function_module_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="gene"
            label=""
            width="140"
          >
            <template slot-scope="scope">
              <router-link class="link" target="_blank" :to="{ name: 'FunctionModule', params: { gene: scope.row.gene }}">{{scope.row.gene}}</router-link>
              <!-- <a target="_blank" :href="'#/function_module?gene='+scope.row.gene">{{ scope.row.gene }}</a> -->
            </template>
          </el-table-column>
          <el-table-column
            prop="group"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="function"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="num1"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="describe1"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="num2"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="value1"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="value2"
            label=""
          >
          </el-table-column>
          <el-table-column
            prop="genes"
            label=""
          >
          </el-table-column>
        </el-table>
    </div>
    <div>
      <h3>5. Cis-elements</h3>
    </div>
    <div>
      <h3>6. Expression profilings</h3>
    </div>
    <div>
      <h3>7. Gene family</h3>
    </div>
    <div>
      <h3>8. Protein domain</h3>
      <div class="canvas">
        <canvas ref="canvas" width="900px" height="400px" >您的浏览器暂不支持canvas</canvas>
      </div>
      <div class="domin-table">
        <el-table
          :data="dominData"
          border
          size="small"
          style="width: 100%">
          <el-table-column
            prop="domin_id"
            label="Id"
            width="180">
              <template slot-scope="scope">
                <a target="_blank" :href="generate_domin_table_id_href(scope.row.domin_id)" style="margin-left: 10px;color: #1e6f15">{{scope.row.domin_id}}</a>
              </template>
          </el-table-column>
          <el-table-column
            prop="data_base"
            label="Database"
            width="180">
          </el-table-column>
          <el-table-column
            prop="start"
            label="Start">
          </el-table-column>
          <el-table-column
            prop="end"
            label="End">
          </el-table-column>
          <el-table-column
            prop="e_value"
            label="E-value">
          </el-table-column>
          <el-table-column
            prop="domin_length"
            label="Domin length">
          </el-table-column>
          <el-table-column
            prop="annotation"
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
    <div>
      <h3>9. KEGG Pathway</h3>
    </div>
    <div>
      <h3>10. Gene Ontology</h3>
    </div>
    <div>
      <h3>11. Orthologous in Rattans</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GeneFunctionSearch',
  components:{

  },
  data: function() {
    return {
      gfs_tableData: [],
      function_module_tableData: [],
      dominData: [],
      domin_detail_item: {},
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
        this.dominData = response.data;
        if(response.data.length > 0) {
          this.canvasDraw();
        }
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
      if(maxLength >= 900) {
        canvas.width = maxLength;
      }
      ctx.fillStyle = 'rgba(50, 50, 50, 0.5)';
      ctx.fillRect(0, 200, maxLength + 100, 3);

      // 画比例尺
      ctx.font = '12px serif';
      ctx.fillStyle = 'rgba(50, 50, 50, 0.8)';
      for(let i = 0; i <= maxLength + 200; i+=100) {
        ctx.fillRect(i, 255, 1, 3);
        ctx.fillText(i, i, 270);
      }
      ctx.fillRect(0, 257, maxLength + 200, 1);

      // 画domin
      this.dominData.forEach(item => {
        ctx.fillStyle = 'rgba('+(Math.random()*100).toFixed()+', '+(Math.random()*100).toFixed()+', '+(Math.random()*100).toFixed()+', 1)';
        ctx.fillRect(Number(item.start), 186, Number(item.domin_length), 30);
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
          if(pageX >= Number(item.start) && pageX <= Number(item.end) && pageY >= 190 && pageY <= 220){
            // console.log(item);
            that.domin_detail_item = item;
            that.$refs.domin_detail.style.display = 'block';
            that.$refs.domin_detail.style.left = mousePos.x + 10 + 'px';
            that.$refs.domin_detail.style.top = mousePos.y + 20 + 'px';
          }
        })
      });
      canvas.addEventListener("click", function(event) {
        that.$refs.domin_detail.style.display = 'none';
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
    }
  },
  mounted: function() {
    this.gfs_submit();
    this.function_module_submit();
    this.domin_submit();
  }
}

</script>

<style scoped>
  .container {
    
  }
  .wrapper {
    width: 80%;
    margin: 0 auto;
  }
  .link {
    color: rgb(11, 146, 63);

  }
  .canvas {
    padding: 16px; 
    border: 1px solid black; 
    width: 932px; 
    height: 432px;
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
  .domin-table {
    width: 80%;
    margin: 0 auto;
    margin-top: 24px;
  }
</style>

