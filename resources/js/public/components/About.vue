<template>
   <section id="about">
        <p>CV</p>
         <a :href="'/storage/cvs/' + this.cv.cv_path" download>{{cv.cv_path}}</a>
        
        
       
      
    </section>
    
</template>
<script>
export default {
  components: {  },
  data(){
    return{
       cv:{
                type:Array
            },
    }
  },
  mounted(){
    this.getCv();
  },
  methods:{
    async getCv(){
        const res = await this.callApi('get','/cv_path');
        if(res.status == 200) {
            console.log("About:",res.data);
            this.cv = res.data
            
        }
    }
  }
   
}
</script>