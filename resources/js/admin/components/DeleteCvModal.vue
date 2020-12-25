<template>
    <transition name="fade">
        <div id="my-modal" style="border: solid; z-index: 1" class="modal">
            <div class="modal-body">
                <h1>Delete <b style="color:red">{{cv.cv_path}}</b> from the cv list?</h1>
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
        props: {
            cv:{
                type:Object
            }
        },
        methods: {
           async confirm() {
                    const res = await this.callApi('post','/deleteCv', this.cv)
                    if(res.status == 200) {
                        console.log("DELETED");
                        this.$emit('reloadList')
                    }
                  
                
            },
            cancel() {
                this.$emit('closeModal')
            },

        },
    }
</script>
<style scoped>
.modal {
    position: fixed;
    z-index:1;
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