<template>
    <div>
        <h3>Portfolios</h3>
         <section id="portfolio">
                   <main id="portfolio-gallery">

                       <transition name="fade">
                            <div  class="modal showItemModal" v-if="showItemModal"  @click="closeModal">
                                <div class="showItem-modal-header">
                                        <button  class="modal-close-btn" href="#" @click="closeModalBtn">
                                            <span>X</span>
                                        </button>
                                </div>

                                <div class="showItem-modal-body" id="modal-body">
                                    <img :src="'storage/itempics/'  + this.portfolio.img_path"/>
                                       <div id="project-description-area">
                                    <h1>{{this.portfolio.name}}</h1>
                                    <p>{{this.portfolio.description}}</p>
                                </div>
                                          
                                </div>
                            </div>
                        </transition>


    <figure class="item" v-for="(portfolio,i) in portfolios" :key="i">
        <div :style="'background:url(storage/itempics/' + portfolio.img_path + ');'" 
        class="itemNameParent" 
        @click="itemClicked(portfolio)">
                 
    
                    <p class="itemName">{{portfolio.name}}</p>
                </div>
</figure>

</main>
    </section>
 
    </div>
</template>
<script>
export default {
    data() {
        return {
            portfolios: '',
                    showItemModal: false,
                    portfolio: ''

        }
    },
    mounted(){
        this.getPortfolios();
    },
    methods: {
        async getPortfolios() {
      const res = await this.callApi("get", "/getPortfolios");
      if (res.status == 200) {
          
          console.log("Portfolios header: ", res.headers);
        this.portfolios = res.data;
      }
    },
    itemClicked(portfolio) {
        this.portfolio = portfolio
    if (this.showItemModal === false) {
        this.showItemModal = true
    } else if (this.showItemModal === true) {
        this.showItemModal = false
    }
},
closeModal(event) {
    if (event.target.matches('.modal')) {
        this.showItemModal = false;
    }
},
closeModalBtn() {
    this.showItemModal = false
}
    }
}
</script>

<style scoped>
h3{
    text-align: center;
}
img {max-width: 100%; height: auto;}
 #portfolio-gallery {display: flex; flex-wrap: wrap;  }


.itemNameParent {
    width: 320px; height: 240px;
    display: flex; align-items: flex-end;
    border: solid;
}
.itemNameParent:hover {
    box-shadow: HORIZONTAL VERTICLE BLURRY SPREAD COLOR
}
.item {
    flex-grow: 1;
    
    display: flex; justify-content: center;
}
.itemName {
    margin: 0; font-size: 3em; background-color: rgba(244,200,3,0.5);
    width: 100%; text-align: center;
}


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
.showItemModal {
    flex-direction: column;
}
.showItem-modal-header {
    background: #04BC92;
    border: solid;
    border-bottom: none;
    width:80vw;
}
.showItem-modal-body {
    background: rgb(73, 84, 238);
    border: solid;
    border-top: none;
    width:80vw;
    display: flex;
    flex-wrap: wrap;
}
.modal-close-btn {
    float: right;
}
#project-description-area {
    display: flex;
    flex-direction: column;
    flex: 1;
    color: black;
    text-align: center;
    font-size: 3em;
    background: #8c36dd;
}

</style>