<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Projects</h1>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 1%">#</th>
                <th style="width: 20%">Project Name</th>

                <th style="width: 20%"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(portfolio, i) in portfolios" :key="i">
                <td class="project-actions text-right">
                  <a class="btn btn-info btn-sm" @click="edit(portfolio)">
                    <i class="fas fa-pencil-alt"> </i>
                    Edit
                  </a>
                  <a
                    class="btn btn-danger btn-sm"
                    @click="deletePortfolio(portfolio)"
                  >
                    <i class="fas fa-trash"> </i>
                    Delete
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
</template>
<script>
export default {
  props: {
    portfolios: "",
  },
  data() {
    return {
      p: this.$parent,
      editPortfolio: "",
      deletePortfolioItem: "",
    };
  },
  methods: {
    edit(portfolio) {
      console.log("int editor table", portfolio);
      this.editPortfolio = portfolio;
      console.log("EDit ptfolio: ", this.editPortfolio);
      this.$emit("edit", this.editPortfolio);
    },
    deletePortfolio(portfolio) {
      console.log("int editor table on delete", portfolio);
      this.deletePortfolioItem = portfolio;
      console.log("EDit ptfolio: ", this.deletePortfolioItem);
      this.$emit("deletePortfolio", this.deletePortfolioItem);
    },
  },
  created() {
    console.log(this.portfolios);
  },
};
</script>