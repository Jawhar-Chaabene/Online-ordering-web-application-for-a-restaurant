<script setup>
import Menu from './components/Menu.vue';
</script>

<template>
  <div>
    <Menu class="sticky-header" />
    <div class="content container">

      <router-view></router-view>
    </div>
  </div>
</template>

<style scoped>
.sticky-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #f1f1f1;
  padding: 10px;
  z-index: 1000;
  margin-bottom: 60px;
  /* Add other styles as needed */
}


.content {
  margin-top: 60px;
  height: 90vh;
}
</style>
