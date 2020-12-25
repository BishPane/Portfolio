<template>
<!-- <div>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Click</button> -->
   
          
         
          <!-- Content Header (Page header) -->
   <!-- Add modal -->
   <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div class="modal-body">
            <form>
              <input type="file" @change="selectFile" name="itempic" />
              <input type="text" v-model="name" />
              <textarea v-model="description" />
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click.prevent="onSubmit"
                :disabled="submitDisabled"
              >
                Save changes
              </button>
            </form>
          </div>
         
        </div>
      </div>
    </div> -->
    <!-- </div> -->

<!-- Button trigger modal -->

<div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</div>
</template>
<script>
export default {
  
  data() {
    return {
        showAddModal:false,
      p: this.$parent,
      file: "",
      name: "",
      description: "",
      submitDisabled: true,
      serverErrors: {},
    };
  },
  methods: {
    openModal(){

      this.showAddModal = true;
      console.log("Show modal: ", this.showAddModal);
    },
    selectFile(event) {
      this.file = event.target.files[0];
    },

    async onSubmit() {
      this.serverErrors = {};
      let formData = new FormData();
      formData.append("itempic", this.file);
      formData.append("name", this.name);
      formData.append("description", this.description);
      const res = await this.callApi("post", "/portfolio", formData);
      if (res.status == 201) {
        console.log(res.data);
        //this.$parent.showAddModal = false;
        this.$emit('reload');
        //this.p.getPortfolios();
      }
      if (res.status == 422) {
        console.log(res.data.errors.name[0]);
        this.serverErrors = res.data.errors.name;
      }
    },
  },
  computed: {
    validationErrors() {
      this.submitDisabled = true;
      if (this.name === "") {
        return "please fill in the project name";
      }
      if (!this.file) {
        return "please select an image";
      }
      if (this.file && !this.file.type.startsWith("image/")) {
        return "file must be an image";
      } else {
        this.submitDisabled = false;
      }
    },
  },
};
</script>
<style scoped>
.modal {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>