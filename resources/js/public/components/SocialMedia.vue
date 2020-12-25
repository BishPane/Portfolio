<template>
<footer>
     <div id="social-links">
    <a
      v-if="social.facebook"
      v-bind:href="'https://facebook.com/' + social.facebook"
      >{{ social.facebook }}</a
    >
    <a
      v-if="social.twitter"
      v-bind:href="'https://twitter.com/' + social.twitter"
      >{{ social.twitter }}</a
    >
  </div>
</footer>
 
</template>
<script>
export default {
  name:"SocialMedia",
  data() {
    return {
      social: "",
    };
  },
  mounted(){
      this.getSocial();
  },

  methods: {
    async getSocial() {
        const res = await this.callApi('get','/getSocial');
        if(res.status == 200) {
            this.social = res.data
        }
    },
  },
};
</script>
<style scoped>
footer{
     background: #5a57fc;
    height: 100px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;

           

}
#social-links {
    display:flex;
    justify-content:space-evenly;

   
}
a {
      color:white;
    border:solid black;
    background: black;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
}

a:hover {
    border-style: groove;
    border-width:10px;
}
h1 { text-align:center; }
</style>