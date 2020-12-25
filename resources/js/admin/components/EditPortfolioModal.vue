<template>
  <div>
    <transition name="fade">
      <div class="modal" @click="closeModal">
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group col-md-4">
              <input type="file" @change="selectFile" name="itempic" />
            </div>
            <div class="form-group col-md-4">
              <input type="text" v-model="name" />
            </div>
            <div class="form-group col-md-4">
              <textarea v-model="description" />
            </div>
            <div class="form-group col-md-4">
              <button
                slot="submit"
                @click.prevent="update(portfolioItem)"
                :disabled="subDisabled"
              >
                Change
              </button>
            </div>
            <div class="form-group col-md-4">
              <div>{{ validation }}</div>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
export default {
  props: {
    portfolioItem: "",
  },
  data() {
    return {
      p: this.$parent,
      file: "",
      name: this.portfolioItem.name,
      description: this.portfolioItem.description,
      subDisabled: true,
      id: this.portfolioItem.id,

      checkName: this.portfolioItem.name,
      checkDescription: this.portfolioItem.description,
    };
  },
  methods: {
    selectFile(event) {
      this.file = event.target.files[0];
    },
    closeModal(event) {
      if (event.target.matches(".modal")) {
        this.$emit('closeModal');
      }
    },

    async update(item) {
      let formData = new FormData();
      formData.append("id", this.id);
      formData.append("itempic", this.file);
      formData.append("name", this.name);
      formData.append("description", this.description);
      const res = await this.callApi("post", "/editPortfolio", formData);
      if (res.status == 200) {
        console.log("EDIT ", res.data);
        this.$parent.editPortfolioModal = false;
        this.p.getPortfolios();
      }
    },
  },
  computed: {
    validation() {
      let i = this.portfolioItem;
      if (this.name !== i.name || this.description !== i.description) {
        this.subDisabled = false;
      } else {
        this.subDisabled = true;
      }
    },
  },
  created() {
    console.log(this.p.select);
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