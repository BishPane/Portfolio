<template>
  <section>
      <h3>PortfolioEditor</h3>
      <caption>
            <button @click.prevent="addPortfolioPopup"> Add New Item</button>
        </caption>
         
                <add-portfolio-modal v-if="showAddModal" @closeModal="closeModal" />
                 <confirm-delete-modal v-if="confirmDelete" :portfolioItem="portfolioItem" @closeModal="closeModal" />
                  <edit-portfolio-modal v-if="editPortfolioModal" :portfolioItem="portfolioItem" @closeModal="closeModal"/>
                  <portfolio-editor-table :portfolios="portfolios" @edit="editPortfolioPopup" @deletePortfolio="deletePortfolio" />
  </section>
</template>
<script>
import PortfolioEditorTable from "./PortfolioEditorTable";
import EditPortfolioModal from './EditPortfolioModal';
import AddPortfolioModal from './AddPortfolioModal'
import ConfirmDeleteModal from './confirmDeleteModal.vue';
export default {
  components: { PortfolioEditorTable, EditPortfolioModal, AddPortfolioModal,ConfirmDeleteModal },
  data() {
    return {
     
    
      portfolios: '',
      editPortfolioModal: false,
      showAddModal: false,
      confirmDelete:false,
        portfolioItem: ''
    };
  },
  mounted() {
    this.getPortfolios();
  },
  methods: {
    
    closeModal(){
      this.showAddModal = false;
      this.confirmDelete = false;
      this.editPortfolioModal=false;
      this.confirmDelete=false;

      this.getPortfolios();

    },
     deletePortfolio(portfolio){
       console.log("Received from emit", portfolio);
      this.portfolioItem = portfolio
      console.log("Inserted using emite: ", this.portfolioItem);
      this.confirmDelete = true
    },
   

    async getPortfolios() {
      const res = await this.callApi("get", "/getPortfolios");
      if (res.status == 200) {
        this.portfolios = res.data;
      }
    },
   addPortfolioPopup() {
     
    if (this.showAddModal == false) {
        this.showAddModal = true;
    }
    else if (this.showAddModal == true) {
        this.showAddModal = false;
    }
},
    editPortfolioPopup(portfolio) {
      console.log(portfolio);
      this.portfolioItem = portfolio;
    if (this.editPortfolioModal === false) {
        this.editPortfolioModal = true;
    }
    else if (this.editPortfolioModal === true) {
        this.editPortfolioModal = false;
    }
},
  },
  created(){
    console.log(this.portfolioItem);
  },
  
  
};
</script>
<style scoped>
div{
  margin-top: 50px;
}
section {
  margin: 30px;
  
    /* display: block; */
     display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
caption {
    display: block;
    text-align: center;
}

form {
    display: block;
    margin-top: 0em;
}
</style>