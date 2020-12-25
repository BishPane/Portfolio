<template>
  <div id="app">
    <!-- <home/> -->
    <!-- <about/> -->
    <!-- <social-media-editor/> -->
        
           <!-- <admin-home/> -->
        
        
     
<router-view/>
  </div>
</template>
<script>

export default {
  components: {  },
  props:[],
  data() {
    return {};
  },
  mounted() {},
  methods: {},
};
</script>
<style scoped>
#styling {
  display: grid;
  grid-auto-flow: column;
}
#app {
  display: grid;
  grid-auto-flow: column;
}
img {
  max-width: 100%;
  height: auto;
}
</style>