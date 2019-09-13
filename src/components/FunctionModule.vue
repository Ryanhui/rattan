<template>
  <div class="container">
    <h3>{{ this.$route.params.gene }}</h3>
  </div>
</template>

<script>
export default {
  name: 'FunctionModule',
  components:{

  },
}

</script>

<style scoped>
  .container {
    height: 550px;
  }
</style>

