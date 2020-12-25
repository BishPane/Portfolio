<template>
    <div>
        
  <table>
    <thead>
        <tr>
            <th>Portfolio Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
      <tr v-for="(portfolio,i) in portfolios" :key="i" >
            <td>{{portfolio.name}}</td>

            <td><img height="200px" v-bind:src="'storage/itempics/' + portfolio.img_path"/>
</td>
            <td>
                <button @click="edit(portfolio)">EDIT</button>
            </td>
            <td>
                
                <button @click="deletePortfolio(portfolio)">DELETE</button>
            </td>
        </tr>
    </tbody>
</table>
    </div>
</template>
<script>
export default {
    props:{
        portfolios: '',
        
    },
    data() {
        return {
               
                editPortfolio: '',
                deletePortfolioItem:''

                
        }
    },
    methods:{
        edit(portfolio){
            console.log("int editor table", portfolio);
            this.editPortfolio = portfolio
            console.log("EDit ptfolio: ", this.editPortfolio);
            this.$emit('edit', this.editPortfolio)
        },
        deletePortfolio(portfolio) {
             console.log("int editor table on delete", portfolio);
            this.deletePortfolioItem = portfolio
            console.log("EDit ptfolio: ", this.deletePortfolioItem);
            this.$emit('deletePortfolio', this.deletePortfolioItem)
        }
    },
    created(){
        console.log(this.portfolios);
    }
}
</script>
<style scoped>
table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 2px;
    border-color: grey;
}
</style>