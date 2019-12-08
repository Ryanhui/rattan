<template>
  <div class="container">
    <p class="content" style="font-size: 32px;margin-top: 64px">How to contact us ?</p>
    <p class="content" style="margin-top: 32px;">If you have any questions or Suggestions, </p>
    <p class="content">please email us to jiongliangw@163.com</p>
    <el-divider style="width: 95%;margin: 0 auto;"></el-divider>
    <div class="fun-scan">
      <p class="fun-scan-title">Function Scanning</p>
      <img src="../assets/funscan_2.png" alt="funscan" width="100%">
      <img src="../assets/funscan_1.png" alt="funscan" width="100%">
    </div>
  </div>
</template>

<script>
export default {
  name: 'Contact',
  components:{

  },
}

</script>

<style scoped>
  .container {
    min-height: 600px;
    text-align: left;
    width: 95%;
    margin: 0 auto;
  }
  .content {
    font-size: 24px;
    margin-left: 100px;
  }
  .fun-scan-title {
    text-align: center;
    font-size: 24px;
  }
  .fun-scan {
    margin: 24px 0 24px 0;
  }
</style>

