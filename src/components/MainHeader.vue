<template>
<div>
  <el-row class="bg-green">
    <el-col :span="18">
      <div class="head-title">
        <p class="head-title-big">Rattan</p>
        <p class="head-title-small">Database of co-expression network with functional modules for rattans</p>
      </div>
    </el-col>
    <el-col :span="6">

    </el-col>
  </el-row>
      <el-row class="menu">
      <el-col :span="2"><div class="meun-item"><router-link to="/">Home</router-link></div></el-col>
      <!-- <el-col :span="2"><div class="meun-item"><router-link to="/gbrowser">Gbrowser</router-link></div></el-col> -->
      <el-col :span="2">
        <div class="meun-item" v-bind:class="{addColor: isInList}" @mouseenter="enter()" @mouseleave="leave('title')">Gbrowser</div>
        <ul class="gbrowser-dropdown" style="width: 210px" v-show="show" @mouseenter="enterList()" @mouseleave="leave()">
          <li style="border-bottom: 1px solid white"><router-link to="/gbrowser1">Calamus simplicifolius</router-link></li>
          <li><router-link to="/gbrowser2">Daemonorops jenkinsiana</router-link></li>
        </ul>
      </el-col>
      <el-col :span="2"><div class="meun-item"><router-link to="/blast">Blast</router-link></div></el-col>
      <el-col :span="2"><div class="meun-item"><router-link to="/download">Download</router-link></div></el-col>
      <el-col :span="2">
        <div class="meun-item" v-bind:class="{addColor: isInToolsList}" @mouseenter="enterTools()" @mouseleave="leaveTools('title')">Tools</div>
        <ul class="gbrowser-dropdown" style="width:200px" v-show="showTools" @mouseenter="enterToolsList()" @mouseleave="leaveTools()">
          <li class="tools-dropdown-list"><router-link to="/">Annotation</router-link></li>
          <li class="tools-dropdown-list"><router-link to="/">Search</router-link></li>
          <li class="tools-dropdown-list"><router-link to="/tools/coexpression">Co-expression Network</router-link></li>
          <li class="tools-dropdown-list"><router-link to="/tools/moduleenrichment">Module enrichment</router-link></li>
          <li class="tools-dropdown-list"><router-link to="/">Cis-element Analysis</router-link></li>
          <li class="tools-dropdown-list"><router-link to="/tools/genesetsanalysis">Gene Sets Analysis</router-link></li>
          <li><router-link to="/">Annotation Summary</router-link></li>
        </ul>
      </el-col>
      <el-col :span="2"><div class="meun-item"><router-link to="/contact">Contact Us</router-link></div></el-col>
      <el-col :span="12"></el-col>
    </el-row>
</div>
</template>

<script>
export default {
  name: 'MainHeader',
  data() {
    return {
      show: false,
      isInList: false,

      showTools: false,
      isInToolsList: false,
    }
  },
  methods: {
    enter() {
      this.show = true;
    },
    enterTools() {
      this.showTools = true;
    },
    enterList() {
      this.isInList = true;
    },
    enterToolsList () {
      this.isInToolsList = true;
    },
    leave(position) {
      if (position === 'title') {
        const self = this;
        setTimeout(function(){
          if(self.isInList) {
            return;
          } else {
            self.show = false;
            self.isInList = false;
          }
        }, 100)
      } else {
          this.show = false;
          this.isInList = false;
      }
    },
    leaveTools(position) {
      if (position === 'title') {
        const self = this;
        setTimeout(function(){
          if(self.isInToolsList) {
            return;
          } else {
            self.showTools = false;
            self.isInToolsList = false;
          }
        }, 100)
      } else {
          this.showTools = false;
          this.isInToolsList = false;
      }
    }
  }
}
</script>

<style>
  .bg-green {
    background: #8FBC94;
    height: 120px;
    color: #56445D;
  }
  .head-title {
    text-align: left;
    color: #56445D;
    margin-left: 24px;
    margin-top: 16px;
    width: 530px;
  }
  .head-title-big {
    font-size: 36px;
    margin: 0;
    font-weight: 700;
    border-bottom: 1px solid;
  }
  .head-title-small {
    margin-top: 4px;
    font-weight: 500;
    color: #56445D;
  }
  .menu {
    background: #C5E99B;
    height: 40px;
  }
  .meun-item {
    line-height: 40px;
    color: #56445D;
    transition: all ease 0.3s;
    cursor:default;
  }
  .meun-item:hover {
    background: #5A9367;
  }
  .meun-item a {
    text-decoration: none;
    color: #56445D;
    display: block;
  }
  .tools-dropdown-list {
    border-bottom: 1px solid white;
  }
  .gbrowser-dropdown {
    position: relative;
    z-index: 99;
    background: #5A9367;
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  .gbrowser-dropdown li {
    height: 40px;
    line-height: 40px;
    color: #56445D;
  }
  .gbrowser-dropdown li:hover {
    background: rgb(158, 184, 109);
  }
  .gbrowser-dropdown li a{
    text-decoration: none;
    color: #56445D;
  }
  .addColor {
    background: #5A9367;
  }
</style>