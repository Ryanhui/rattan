<template>
  <div class="main-footer">
    <el-row>
      <el-col :span="12">
        <div class="copyright">
          <p>版权所有 © 2004-2019 国际竹藤中心 | International center for bamboo and rattan</p>
        </div>
      </el-col>
      <el-col :span="12">
        <div class="pv">
          <a href="http://fzamsc.top/" target="_blank">Powered by Fuzhou AMSC Co.,Ltd.</a>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'MainFooter'
}
</script>

<style>
  .main-footer {
    background: #8FBC94;
    height: 50px;
    /* margin-top: 8px; */
  }
  .copyright {
    color: #56445D;
    text-align: left;
    margin-left: 24px;
    line-height: 50px;
    font-size: 14px;
  }
  .pv {
    color: #56445D;
    text-align: right;
    margin-right: 24px;
    line-height: 50px;
    font-size: 14px;
  }
  .pv a {
    text-decoration: none;
    color: inherit;
  }
</style>