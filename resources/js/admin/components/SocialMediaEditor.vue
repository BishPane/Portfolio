<template>
  <section id="socialMediaLinksEditor">
    <h1>Add  social media links</h1>
    <form>
      <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="text" id="facebook" v-model="social.facebook" />
      </div>
      <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="text" id="twitter" v-model="social.twitter" />
      </div>
      
      <input type="submit" value="submit"  @click.prevent="onSubmit" />
    </form>
  </section>
</template>
<script>
export default {
  data() {
    return {
      social: {
        facebook: "",
      
        twitter: "",
      },
    };
  },
  mounted(){
      this.getSocial();
  },
  methods: {
   async onSubmit() {
      let formData = new FormData();
      formData.append("facebook", this.social.facebook);
      formData.append("twitter", this.social.twitter);
     
      const res = await this.callApi('post','/postSocial', formData);
      if(res.status == 200) {
          console.log(res.data);
           this.getSocial();
      }
    },
    async getSocial(){
              const res = await this.callApi('get','/getSocial');
              if(res.status == 200){
                  this.social = res.data
              }


    }
  },
};
</script>
<style scoped>
#socialMediaLinksEditor {
  background: rgb(205, 173, 252);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
form {
  display: flex;
  flex-direction: column;
  border: solid;
  background: rgb(164, 163, 228);
}
input {
  height: 30px;
  font-size: 1em;
}
.form-group {
  display: grid;
  grid-template-columns: 1fr 1fr;
  padding: 10px;
  
}
label {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>