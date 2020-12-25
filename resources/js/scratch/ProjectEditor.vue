<template>
  <section>
    <h3>Project Editor</h3>
    <caption>
       
        </caption>
   <add-project-modal/>
    <!-- List all projects -->
    <project-editor-table :portfolios="portfolios" @edit="editPortfolioPopup" @deletePortfolio="deletePortfolio" />
    <!-- End list all projects -->

   
    <!-- End add modal -->
  </section>
</template>
<script>
import AddProjectModal from './AddProjectModal.vue';
import ProjectEditorTable from "./ProjectEditorTable.vue";
export default {
  components: { ProjectEditorTable, AddProjectModal },
  data() {
    return {
      portfolios: "",
      editPortfolioModal: false,
      showAddModal: false,
      confirmDelete: false,
      portfolioItem: "",
    };
  },
  mounted() {
    this.getPortfolios();
  },
  methods: {
    closeDeleteModal() {
      this.getPortfolios();
      this.confirmDelete = false;
    },
    deletePortfolio(portfolio) {
      console.log("Received from emit", portfolio);
      this.portfolioItem = portfolio;
      console.log("Inserted using emite: ", this.portfolioItem);
      this.confirmDelete = true;
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
      } else if (this.editPortfolioModal === true) {
        this.editPortfolioModal = false;
      }
    },
  },
  created() {
    console.log(this.portfolioItem);
  },
};
</script>