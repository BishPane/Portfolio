<template>
  <section id="about-editor">
    <h1>About Editor</h1>
     
    <form enctype="multipart/form-data" id="about-form">
      <input
        type="file"
        @change="selectFile"
        name="cv"
        accept=".doc, .docx, .pdf"
      />
      <button @click.prevent="onSubmit" :disabled="submitDisabled">Submit</button>
       <div>{{ validation }}</div>
    </form>
<!-- currently active cv -->
   <a :href="'/storage/cvs/' + this.cv.cv_path" download>{{cv.cv_path}}</a>
    <!--  -->
   
    <cv-selector/>
  </section>
</template>
<script>
import CvSelector from './CvSelector.vue';
export default {
    name:"AboutEditor",
  components: { CvSelector },
    data(){
        return{
            cv:{
                type:Array
            },
            file:'',
            submitDisabled:true
           
        }
    },
    mounted(){
        this.getCv()
    },
  methods: {
    selectFile(event) {
      console.log(event.target.files[0]);
      this.file = event.target.files[0];
    },
    async onSubmit() {
      let formData = new FormData();
      formData.append("cv", this.file);
     const res = await this.callApi('post','/about',formData);
     if(res.status == 200){
     
         console.log("SUCCESS 200 abput :" , res.data);
         this.file='';
         this.cv =[];
     }
    },
    async getCv(){
      // get the cv which is active
        const res = await this.callApi('get','/cv_path');
        if(res.status == 200) {
            console.log("About:",res.data);
            this.cv = res.data
            
        }
    }
   
  },
  computed: {
    validation() {
      this.submitDisabled = true;
    
      if (!this.file) {
        return "please select cv";
      }      
       else {
        this.submitDisabled = false;
      }
    },
  },
 
};
</script>
<style scoped>
#about-editor{
      margin: 30px;
       display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

}
</style>