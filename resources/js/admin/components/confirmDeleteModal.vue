<template>
    <transition name="fade">
        <div class="modal" @click="closeModal">
            <div class="modal-body">
                <h1>Delete <b style="color:red">{{portfolioItem.name}}</b> from your portfolio?</h1>
                <div class="btn-row">
                    <button @click="confirm">Yes</button>
                    <button @click="cancel">No</button>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props:{
        portfolioItem:''
    },
    data(){
        return{
            portfolio : this.portfolioItem
        }
    },
    methods:{
      async confirm(){
            const res = await this.callApi('post','/deletePortfolio',this.portfolioItem)
            if(res.status == 200) {
                this.$emit('closeModal');    
                
                    }
        },
          closeModal(event) {
      if (event.target.matches(".modal")) {
        this.$emit('closeModal');
      }
    },
        cancel(){
                          this.$emit('closeModal');
                         // this.$parent.confirmDelete = false

        }

    },
    created() {
        console.log(this.portfolioitem);
    }
}
</script>
<style scoped>
.modal {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-body {
  border: solid;
  padding: 120px;
  background: #745ef0;
}
</style>