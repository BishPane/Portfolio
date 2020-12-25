<template>
  <div class="grid-container">
   
    <profile :profile="profile"/>
      
    
   
    <portfolio/>
    <about/>
   <social-media/>
    
  </div>
</template>
<script>
import Portfolio from './components/Portfolio.vue';
import SocialMedia from './components/SocialMedia.vue';
import About from './components/About.vue';
import Profile from './components/Profile.vue';
export default {
  name:"Home",
  components: {  Portfolio, SocialMedia, About, Profile  },
  data() {
    return {
      profile: {type:Object}
    };
  },
  mounted(){
      this.getProfile()
      },
  methods: {
     async getProfile(){
          const res = await this.callApi("get", "/getProfile");
         if(res.status == 200) {
          console.log("Profile",res.data);
          this.profile = res.data
      
         

   }if(res.status == 401){
        let err = res.data.errors
        let disError = Object.values(err)
        alert(disError)
   }
   if(res.status == 500){
     console.log("500 getprofile:", res.data);
   }
    
  },
  }


}
</script>
<style scoped>
.grid-container {
  display: grid;
 grid-gap:50px ;
 
  background-color: #edf0f3;
  padding: 10px;
}
</style>