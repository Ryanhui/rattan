<template>
  <div class="container">
    <p class="title" >Cis-element Analysis</p>
    <p class="intro">Combining text-mining technology with data sources from <a class="link" href="http://bioinformatics.psb.ugent.be/webtools/plantcare/html/">plantCARE</a>, 
    <a href="https://www.hsls.pitt.edu/obrc/index.php?page=URL1100876009" class="link">PLACE</a>, <a class="link" href="http://www.athamap.de/">AthMap</a> etc. 
    We collected 1,035 motifs with published annotations. With these identified motifs and published 
    annotations, we predicted TF/TR-binding regions. In addition to scanning for motif sequences, 
    we offered a Z–score method that calculates the significance enrichment of motifs.</p>
    <div class="wrapper">
      <p class="sub-title">1. Sequence Scan</p>
      <p>Input a fasta sequence, we'll find out all the possible motifs.</p>
      <el-tabs type="border-card" v-model="sequenceSpecies" stretch style="margin-top: 8px">
        <el-tab-pane label="Calsi" name="Calsi">
          <el-input
            type="textarea"
            :rows="5"
            class="input"
            placeholder="Please input"
            v-model="sequence">
          </el-input>
          <span class="example" v-on:click="sequenceExample">example</span>
          <div style="margin-top: 8px">
            <el-button type="primary" size="small" plain v-on:click="sequenceSubmit">GO</el-button>
            <el-button type="primary" size="small" plain v-on:click="reset('sequence')">RESET</el-button>
          </div>
        </el-tab-pane>
        <el-tab-pane label="Daeje" name="Daeje">
          <el-input
            type="textarea"
            :rows="5"
            class="input"
            placeholder="Please input"
            v-model="sequence">
          </el-input>
          <span class="example" v-on:click="sequenceExample">example</span>
          <div style="margin-top: 8px">
            <el-button type="primary" size="small" plain v-on:click="sequenceSubmit">GO</el-button>
            <el-button type="primary" size="small" plain v-on:click="reset('sequence')">RESET</el-button>
          </div>
        </el-tab-pane>
      </el-tabs>

    </div>
    <div class="wrapper">
      <p class="sub-title">2. Name Scan</p>
      <p>Input a gene list in rattans, and we'll compute the significant motifs located at 3000bp upstream of the gene, then show each motif and its frequency. users can also significantly analyze these motifs. It may take a lot of time in calculation.</p>
      <el-input
        type="textarea"
        :rows="5"
        class="input"
        placeholder="Please input"
        v-model="name">
      </el-input>
      <span class="example" v-on:click="nameExample">example</span>
      <div style="margin-top: 8px">
        <el-button type="primary" size="small" plain>GO</el-button>
        <el-button type="primary" size="small" plain v-on:click="reset('name')">RESET</el-button>
      </div>
    </div>
    <div class="wrapper" style="border: none">
      <p class="sub-title">3. Custom motif Scan</p>
      <p>Please input a list of rattans gene names and the motif sequences you interested, we'll extract all these genes promoter sequence (3000bp upstream), then show each motif's frequency and significant analysis result.</p>
      <el-input
        type="textarea"
        :rows="5"
        class="input"
        placeholder="Please input"
        v-model="custom">
      </el-input>
      <p style="margin-top: 8px">Please input motifs splited by ":"</p>
      <el-input
        type="textarea"
        :rows="5"
        class="input"
        placeholder="Please input"
        v-model="customMotifs">
      </el-input>
      <span class="example" v-on:click="customExample">example</span>
      <div style="margin-top: 8px">
        <el-button type="primary" size="small" plain>GO</el-button>
        <el-button type="primary" size="small" plain v-on:click="reset('custom')">RESET</el-button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CisElementAnalysis',
  components:{

  },
  data() {
    return {
      sequenceSpecies: 'Calsi',

      sequence: '',
      name: '',
      custom: '',
      customMotifs: ''
    }
  },
  methods: {
    sequenceExample() {
      this.sequence = '>CRO_T006982CTTTCTCTCTCTACACATATTTCTTCATACGCGGAAATACATATAAAGTGGTAGCTTCAAAGATCAGTATTCTTCAATCTTCATTCATTCAGGAGTTGTGGTTGTAGCTCTGATTTCAGTGTTCTTGTGGAAATTCGTGATCTGGGTCGGAAAAAAAATCTGGTTTTGTTAATTGTGGAAGAAAATCAATGGCTTCATCGGAGATGATTATGGATTCCGGCAGGGCTTCTGCTGTTCAGAAGTCTAACTTTTCTCAGACTTGTAGTCTTTTGAGTCAGTATTTGAAGGAAAACGGTAGTTTTGGAGATCTCAGCCTTGGACTCAACCGTAATTTTGAACCCAATGGTACTAATTTGCGGCTTCTTTTTCTATTTCATTCATGGCGTTTCCAGATCGAATTTGGGGGTACTTACTTTGGAAAAAATTGGTTTGTTTTCCAAATCAAAGGGGTTTTCTTAATCTGGGTTTTGATGGGTTTGGTTTATTTATGGAAGTAATTCAGTGAAAATAATGAGCCTTAAATCTATCTCCCTAGTTTTCTATTTTCGATTTTGTTTCCTTTTTTAAGATAGGATTTTTAATTTTACTCTGTTTTTTGCTTCATTATTTAGGGGTTCCTGCAAAAACTATGAATTTGCTATCAACGATGGATAAATCTGGCCAGAATTTAGAGGCTCCGGCTGTGAAAGAGAACAAACCTGGGAATTTGTTTCCTCAGCCGGCTGGTTTCTACACCATCCCTGATATAAGGTTAGCGCATAGAAATTTTTGCTCTTAAATTCATATCCTAGGCCAAAGATATTCAAGCAATTTACATGTTTTTTTTAATCCATTTTTGCTGAATCTTGTCTGCAATTCATGTACAGTGTTGCAAAATCTGAACCAGACACAGCACAAATGACCATCTTTTATGGTGGACAAGTCTTGGTTTTCAATGACTTCCCAGCTGAAAAGGCCAGAGAAATCATGCTTTTGGCAAGCAATGGAAGCCCACTTAATTTCACCCCTAAACCAGCTGAATCTGCCACCGGTTTGGTCACTCCTCCACCCCCTGCTGCATCAAATGTTGTCCCAAGTTTTGGAAATGGTCTTGTGCAGCAGGAGAATGTCCCAAGCCCTCTTTATCCACGCATCAATGGTGAGTATTTCTTCATGAAAGAAAATCAGAAATATTGTTCTTGATTTCTTCTGCCAATTATGTGCTGATGGGATTTTGTTTTTCCTTGTGTTTGCAGATTTACCACTCTCAAGAAAAGCATCACTTACCAGGTTCTTGGAGAAGAGAAAAGATAGGTAGGCATTTTAGAATTGAGATCTTGAAATTTTATTCTAGAAATGTTTAGAGAGGGAGAAAGAAAGATCTGTTAATGTTCAATTTCTAGTTGAATTTTCTTCTTTCTTTAAGGGTGGTTTGTTCTTTGTTCTTGATTTAAGGTAGGCTTTTAGGGTGGTTTGTTGTTTGTTCTTGAGTTGCTGAACAAAAAAATGTAAATAAAATGAAGAAATTTTCAAATTTCAATGAAAAATTGTGGCTGCTTTTTGGGTGTTTTTAAATATTTTGTGTTAATTTTTTCATATTACAGGATTACAGCAAAAGCACCATACCAGATGATGAACAACTATTCTTCTAAGGCTGCTGCTGCTTCTGATCAAAAAGGAACATGGTTGGGTTTTGGTCAACAATTTCCTGCAAATGGAACGCCAAGTATAGAAATTGGCTTTCCTTTTTAAAACCCCTCAAGAACTTCTTGGGGTTGGTTGACTCTCTCTACCAAGTTTAAGTTTAGATCTAACTATTTATATTCATCTTTTAATGTAATTAAAATTAAAAATTCCCAACGATCTATCTAGTTAGTATTATTTCTATATTTTCAGATCTTGAAAATGTATTTTTGAAGGCATGTTTCCCTACAATTTCGTATGGGAGCATAAATTTTATTATATCTGTTTATTTCCTTTCAG'
    },
    nameExample() {
      this.name = `CRO_T006982
CRO_T008347`;
    },
    customExample() {
      this.custom = `CRO_T006982
CRO_T008347`;
      this.customMotifs = `CC[AT]ACC:CGGTCA`;
    },
    reset(item) {
      if(item === 'sequence') {
        this.sequence = '';
      }
      if(item === 'name') {
        this.name = '';
      }
      if(item === 'custom') {
        this.custom = '';
        this.customMotifs = '';
      }
    },

    sequenceSubmit() {
      let data = new FormData();
      data.append('sequence',this.sequence);
      data.append('species',this.sequenceSpecies);
      
      this.axios.post('http://rattan.bamboogdb.org/php/motif/sequence.php', data).then((response) => {
        console.log(response);
      });
    }
  }
}

</script>

<style scoped>
  .container {
    min-height: 100%;
    width: 80%;
    margin: 0 auto;
    font-size: 18px;
  }
  .title {
    font-size: 32px;
    margin-bottom: 24px;
  }
  .link {
    color: rgb(34, 124, 34);
    text-decoration: none;
  }
  .intro{
    text-align: justify;
  }
  .wrapper {
    margin: 24px 0 64px 0;
    text-align: left;
    padding-bottom: 64px;
    border-bottom: 2px solid rgba(155, 155, 155, 0.3);
  }
  .sequence p {
    text-align: left;
  }
  .sub-title {
    color: rgb(34, 124, 34);
    font-weight: 500;
    font-size: 24px;
  }
  .input {
    width: 700px;
    margin-top: 8px;
  }
  .example {
    color: rgb(34, 124, 34);
    margin-left: 8px;
    cursor: pointer;
  }
</style>

