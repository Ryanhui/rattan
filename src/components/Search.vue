<template>
  <div class="container">
    <p class="main-title">Search</p>

    <div v-if="!showResult">
      <!-- Gene function search -->
      <div>
        <p class="gfs-title">1.Gene function search</p>
        <el-tabs type="border-card" v-model="gfs_species" class="gfs" stretch v-if="!showGeneFunctionResult">
          <el-tab-pane label="Calsi" name="Calsi">
            <div>
              <el-input v-model="gfs_gene" placeholder="Please input" style="width: 200px"></el-input>
              <span style="margin-left:16px">(Example: Calsi_gene33960, Calsi_gene00246, Calsi_gene40036)</span>
            </div>
            <div>
              <el-button @click="gfs_submit" style="margin: 16px 0">Search</el-button>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Daeje" name="Daeje">
            <div>
              <el-input v-model="gfs_gene" placeholder="Please input" style="width: 200px"></el-input>
              <span style="margin-left:16px">(Example: Daeje_Gene00006, Daeje_Gene00014, Daeje_Gene00079)</span>
            </div>
            <div>
              <el-button @click="gfs_submit" style="margin: 16px 0">Search</el-button>
            </div>
          </el-tab-pane>
        </el-tabs>
      </div>

      <!-- Function domain/pathway Search -->
      <div style="margin-top:36px">
        <p class="gfs-title">2.Function domain/pathway Search</p>
        <el-tabs type="border-card" v-model="fds_species" class="gfs" stretch v-if="!showGeneFunctionResult">
          <el-tab-pane label="Calsi" name="Calsi">
            <el-collapse>
              <el-collapse-item title="1. Gene Family Search" name="1">
                <div>
                  <el-input v-model="gfam_function" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: Monolignol Biosynthesis ,COMT-like, MYB)</span>
                </div>
                <div>
                  <el-button @click="gfam_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="2. Pfam id Search" name="2">
                <div>
                  <el-input v-model="pfamId" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: PF14624, PTHR10579, SM0032, PS50234)</span>
                </div>
                <div>
                  <el-button @click="pfamId_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="3. Gene Ontology Search" name="3">
                <div>
                  <el-input v-model="go_id" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: GO:1905038)</span>
                </div>
                <div>
                  <el-button @click="go_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="4. KEGG Search" name="4">
                <div>
                  <el-input v-model="kegg_id" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: K11262, map00620)</span>
                </div>
                <div>
                  <el-button @click="kegg_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="5. PO Search" name="5">
                <div>
                  <el-input v-model="po_id" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: PO:0006343, axillary shoot system)</span>
                </div>
                <div>
                  <el-button @click="po_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
            </el-collapse>
          </el-tab-pane>
          <!-- Daeje -->
          <el-tab-pane label="Daeje" name="Daeje">
            <el-collapse>
              <el-collapse-item title="1. Gene Family Search" name="1">
                <div>
                  <el-input v-model="gfam_function" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: Cytoplasmic ribosomal protein gene family ,S4, MYB)</span>
                </div>
                <div>
                  <el-button @click="gfam_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="2. Pfam id Search" name="2">
                <div>
                  <el-input v-model="pfamId" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: PF02867, PTHR10579, SM00327, PS50234)</span>
                </div>
                <div>
                  <el-button @click="pfamId_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="3. Gene Ontology Search" name="3">
                <div>
                  <el-input v-model="go_id" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: GO:0042803)</span>
                </div>
                <div>
                  <el-button @click="kegg_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="4. KEGG Search" name="4">
                <div>
                  <el-input v-model="kegg_id" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: K03013, map00620)</span>
                </div>
                <div>
                  <el-button @click="kegg_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
              <el-collapse-item title="5. PO Search" name="5">
                <div>
                  <el-input v-model="po_id" placeholder="Please input" style="width: 200px"></el-input>
                  <span style="margin-left:16px">(Example: PO:0009025, inflorescence meristem)</span>
                </div>
                <div>
                  <el-button @click="po_submit" style="margin: 16px 0">Search</el-button>
                </div>
              </el-collapse-item>
            </el-collapse>
          </el-tab-pane>
        </el-tabs>

        <!-- function module search -->
        <div style="margin-top: 36px">
          <p class="gfs-title">3.Function Module Search</p>
          <el-tabs type="border-card" v-model="function_module_species" class="gfs" stretch>
          <el-tab-pane label="Calsi" name="Calsi">
            <div>
              <el-input v-model="function_module_keyword" placeholder="Please input" style="width: 200px"></el-input>
              <span style="margin-left:16px">(Example: Calsi_Module0004, flavonol)</span>
            </div>
            <div>
              <el-button @click="function_module_submit" style="margin: 16px 0">Search</el-button>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Daeje" name="Daeje">
            <div>
              <el-input v-model="function_module_keyword" placeholder="Please input" style="width: 200px"></el-input>
              <span style="margin-left:16px">(Example: Daeje_Module0002)</span>
            </div>
            <div>
              <el-button @click="function_module_submit" style="margin: 16px 0">Search</el-button>
            </div>
          </el-tab-pane>
        </el-tabs>
        </div>
      </div>
    </div>

    <!-- result -->
    <div v-if="showResult" style="min-height: 600px" v-loading="loading">
      <el-button type="primary" style="margin: 16px 0" icon="el-icon-back" @click="handleReturn">Return</el-button>
      <!-- gene function -->
      <div v-if="showGeneFunctionResult">
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
      <!-- gene family -->
      <div v-if="showGeneFamilyResult">
        <el-table
          :data="gfam_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="gene"
            label="gene"
          >
          </el-table-column>
          <el-table-column
            prop="function"
            label="function"
          >
          </el-table-column>
        </el-table>
      </div>
      <!-- pfam id -->
      <div v-if="showPfamIdResult">
        <el-table
          :data="pfamId_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="Query_id"
            label="Query_id"
          >
          </el-table-column>
          <el-table-column
            prop="Subject_id"
            label="Subject_id"
          >
          </el-table-column>
          <el-table-column
            prop="Subject_DB"
            label="Subject_DB"
          >
          </el-table-column>
          <el-table-column
            prop="Query_start"
            label="Query_start"
          >
          </el-table-column>
          <el-table-column
            prop="Query_end"
            label="Query_end"
          >
          </el-table-column>
          <el-table-column
            prop="E_value"
            label="E_value"
          >
          </el-table-column>
          <el-table-column
            prop="Subject_annotation"
            label="Subject_annotation"
          >
          </el-table-column>
        </el-table>
      </div>
      <!-- go -->
      <div v-if="showGoResult">
        <el-table
          :data="go_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="gene"
            label="gene"
          >
          </el-table-column>
          <el-table-column
            prop="go_id"
            label="go id"
          >
          </el-table-column>
          <el-table-column
            prop="description"
            label="description"
          >
          </el-table-column>
        </el-table>
      </div>
      <!-- kegg -->
      <div v-if="showKeggResult">
        <el-table
          :data="kegg_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="gene"
            label="gene"
          >
          </el-table-column>
          <el-table-column
            prop="kegg_id"
            label="kegg id"
          >
          </el-table-column>
          <el-table-column
            prop="description"
            label="description"
          >
          </el-table-column>
        </el-table>
      </div>
      <!-- po -->
      <div v-if="showPoResult">
        <el-table
          :data="po_tableData"
          style="width: 100%"
          size="mini"
          border
        >
          <el-table-column
            prop="gene"
            label="gene"
          >
          </el-table-column>
          <el-table-column
            prop="po_id"
            label="Po id"
          >
          </el-table-column>
          <el-table-column
            prop="description"
            label="description"
          >
          </el-table-column>
        </el-table>
      </div>
      <!-- function module -->
      <div v-if="showfunctionModuleResult">
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
    </div>
  </div>
</template>

<script>
export default {
  name: 'Search',
  components:{

  },
  data(){
    return {
      gfs_gene:'',
      gfs_species: 'Calsi',
      gfs_tableData: [],

      fds_species: 'Calsi',

      gfam_function: '',
      gfam_tableData: [],

      pfamId: '',
      pfamId_tableData: [],

      go_id: '',
      go_tableData: [],

      kegg_id: '',
      kegg_tableData: [],

      po_id: '',
      po_tableData: [],

      function_module_keyword: '',
      function_module_species: 'Calsi',
      function_module_tableData: [],

      showResult: false,
      loading: false,
      showGeneFunctionResult: false,
      showGeneFamilyResult: false,
      showPfamIdResult: false,
      showGoResult: false,
      showKeggResult: false,
      showPoResult: false,
      showfunctionModuleResult: false,
    }
  },
  methods: {
    handleReturn(){
      this.showResult = false;
      this.showGeneFunctionResult = false;
      this.showGeneFamilyResult = false;
      this.showPfamIdResult = false;
      this.showGoResult = false;
      this.showKeggResult = false;
      this.showPoResult = false;
      this.showfunctionModuleResult = false;
    },
    //1.Gene function search
    gfs_submit() {
      if(this.gf_gene === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_gene_function.php?gene=${this.gfs_gene}&species=${this.gfs_species}`).then((response)=>{
        this.gfs_tableData = response.data || [];
        this.showGeneFunctionResult = true;
        this.loading = false;
      })
    },
    // gene family search
    gfam_submit() {
      if(this.gfam_function === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.gfam_tableData = [];
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_gfam.php?function=${this.gfam_function}&species=${this.fds_species}`).then((response)=>{
        this.gfam_tableData = response.data;
        this.showGeneFamilyResult = true;
        this.loading = false;
      })
    },
    // pfam Id search
    pfamId_submit() {
      if(this.pfamId === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.pfamId_tableData =[];
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_pfam_id.php?subject_id=${this.pfamId}&species=${this.fds_species}`).then((response)=>{
        this.pfamId_tableData = response.data;
        this.showPfamIdResult = true;
        this.loading = false;
      })
    },
    // go search
    go_submit() {
      if(this.go_id === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.go_tableData = [];
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_go.php?go_id=${this.go_id}&species=${this.fds_species}`).then((response)=>{
        this.go_tableData = response.data;
        this.showGoResult = true;
        this.loading = false;
      })
    },
    // Kegg search
    kegg_submit() {
      if(this.kegg_id === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.kegg_tableData = [];
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_kegg.php?kegg_id=${this.kegg_id}&species=${this.fds_species}`).then((response)=>{
        this.kegg_tableData = response.data;
        this.showKeggResult = true;
        this.loading = false;
      })
    },
    // po search
    po_submit() {
      if(this.po_id === '') {
        this.$message.error('Please input gene');
        return;
      }
      this.po_tableData = [];
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_po.php?po_id=${this.po_id}&species=${this.fds_species}`).then((response)=>{
        this.po_tableData = response.data;
        this.showPoResult = true;
        this.loading = false;
      })
    },
    //function module search
    function_module_submit() {
      if(this.function_module_keyword === '') {
        this.$message.error('Please input gene');
        return;
      }
      
      this.loading = true;
      this.showResult = true;
      this.axios.get(`http://rattan.bamboogdb.org/php/search_fun_module.php?keyword=${this.function_module_keyword}&species=${this.function_module_species}`).then((response)=>{
        this.function_module_tableData = response.data;
        this.showfunctionModuleResult = true;
        this.loading = false;
        console.log(response);
      })
    }
  }
}

</script>

<style scoped>
  .container {
    min-height: 600px;
    width: 80%;
    margin: 36px auto;
    text-align: left;
  }
  .main-title {
    font-size: 32px;
    text-align: center;
    margin: 24px 0;
  }
  .gfs-title {
    margin: 8px 0;
    font-size: 24px;
  }
  .link {
    color: rgb(11, 146, 63);
  }
</style>

