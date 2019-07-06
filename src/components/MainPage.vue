<template>
  <el-container>
    <el-header height="160px" class="no-padding">
      <MainHeader />
    </el-header>
    <el-main class="no-padding">
      <router-view></router-view>
    </el-main>
    <el-footer class="no-padding" height="50px">
      <MainFooter />
    </el-footer>
  </el-container>
</template>

<script>
import MainHeader from './MainHeader.vue'
import MainFooter from './MainFooter.vue'

export default {
  name: 'MainPage',
  components:{
    MainHeader,
    MainFooter
  },
}

</script>

<style scoped>
  .el-container {
    box-shadow: 0px 0px 11px 3px #00000052;
  }
  .no-padding {
    padding: 0;
    /* box-shadow: 0px 0px 15px 1px black; */
  }
  .el-main {
    background: white;
  }
</style>

