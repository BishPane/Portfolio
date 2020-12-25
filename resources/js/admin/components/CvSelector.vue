<template>
<div id="cv-selector">
    <table>
        <thead>
        <tr>
            <th>CV</th>
            <th>Select</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="cv in cvlist" :key="cv.id">
            <td>{{cv.cv_path}}</td>
            <td>
                <button @click="selectCVPopup(cv)">SELECT CV</button>
            </td>
            <td>
                <button @click="deleteCVPopup(cv)">DELETE CV</button>
            </td>
        </tr>
        </tbody>
    </table>
    <select-cv-modal v-if="selectCvModal" :cv="cv" @reloadList="getcvlist" @closeModal="closeModal" />
    <delete-cv-modal v-if="delCvModal" :cv="cv" @reloadList="getcvlist" @closeModal="closeModal" />
    </div>
</template>

<script>
import DeleteCvModal from './DeleteCvModal.vue';
import SelectCvModal from './SelectCvModal.vue';
export default {
  components: { SelectCvModal, DeleteCvModal },
    data(){
        return{
            cvlist:'',
            cv:'',
            selectCvModal: false,
            delCvModal: false,

        }
    },
    mounted(){
        this.getcvlist()
    },
    methods:{
        async getcvlist(){
            // get all cv's
            const res = await this.callApi('get','/cvlist');
            if(res.status == 200){
                this.cvlist = res.data
            }
            this.selectCvModal = false
            this.delCvModal = false
        },
        selectCVPopup(cv){
            // open select cv modal
            this.cv = cv;
            this.selectCvModal = true;
        },
         deleteCVPopup(cv){
            //  open delete cv modal
            this.cv = cv;
            this.delCvModal = true;
        },
        closeModal(){
            this.selectCvModal=false;
            this.delCvModal = false
        }
    }
}
</script>