<template>
  <div>
    <transition name="fade">
      <div class="modal" @click="closeModal">
        <div class="modal-body">
          <form enctype="multipart/form-data" id="portfolio-editor-form">
            <div class="form-group col-md-4">
              <input type="file" @change="selectFile" name="itempic"  />
            </div>
            <div class="form-group col-md-4">
              <input type="text" v-model="name" placeholder="Name" />
            </div>

            <div class="form-group col-md-4">
              <textarea v-model="description" placeholder="Description" />
            </div>
            <div class="form-group col-md-4">
              <button @click.prevent="onSubmit" :disabled="submitDisabled">
                Submit
              </button>
            </div>
            <div class="form-group col-md-4">
              <div>{{ validationErrors }}</div>
              <div v-if="serverErrors">{{ serverErrors[0] }}</div>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
export default {
  data() {
    return {
      p: this.$parent,
      file: "",
      name: "",
      description: "",
      submitDisabled: true,
      serverErrors: {},
    };
  },
  methods: {
    selectFile(event) {
      this.file = event.target.files[0];
    },
    closeModal(event) {
      if (event.target.matches(".modal")) {
        this.$emit('closeModal') ;
      }
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
        this.$emit('closeModal');
       // this.p.getPortfolios();
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
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;

        position: fixed;
    z-index: 1;
}

.modal-body {
  border: solid;
  padding: 120px;
  background: #745ef0;
}
form {
  display: block;
  margin-top: 0em;
}
.form-group {
  display: grid;
  margin: 1em 0;
}
</style>