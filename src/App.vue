<template>
  <div id="app">
    <MainPage class="main-page" />
  </div>
</template>

<script>
import MainPage from './components/MainPage.vue'

export default {
  name: 'app',
  components: {
    MainPage
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background: #548687;
  overflow: auto;
  min-width: 1000px;
}
.main-page {
  width: 1200px;
  margin: 16px auto;
}
p {
  margin: 0;
  padding: 0;
}
</style>
