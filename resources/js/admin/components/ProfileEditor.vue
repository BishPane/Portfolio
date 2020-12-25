<template>
    <div id="profileEdit">

          <header>
                    <h1>Profile editor</h1>
                    <img v-bind:src="'storage/userpics/' + profile.imagePath"/>
                   <h3>{{profile.name}}</h3>  
           </header>
        <form>
           
    <input v-model="name" type="text">
    <input type="file" accept="image/*" @change="selectImage">
    <button @click.prevent="submitData" :disabled="submitDisabled">Submit</button>
</form>
<div id="errorBar" >{{validationErrors}}</div>
    </div>
</template>
<script>
export default {
    props:{
        profile: {type:Object}
    },
    data() {
        return {
            name: '',
            file: '',
            submitDisabled: true
        }
    },
    methods: {
        selectImage(event) {
            // console.log(event.target.files[0]);
            this.file = event.target.files[0];
        },
 
       async submitData(){
             
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('userpic', this.file);
                 const res = await this.callApi('post','/uploadProfile',formData);
                if(res.status == 200){
                    this.$emit('getProfile');
                    console.log("REsponse data:", res.data);
                }
                if(res.status == 401){
                    console.log("ERROR: ", res.data.errors);
                }
        },

    
    },
    computed: {
                   validationErrors(){
        this.submitDisabled = true;
        if (this.name === '' && this.file.length <= 0) {
            return 'please fill at least one field';
        }
        if (this.file && !this.file.type.startsWith("image/")) {
            return 'file must be an image';
        }
        else {
            this.submitDisabled = false;
        }
    }
    }
}
</script>
<style scoped>
#profileEdit{
    margin: 30px;
}
#errorBar {
    background-color: #333;
    color: #fff;
    padding: 16px;
}
</style>