<template>
    <div>
       <data-table :data='sales' title="Sales List" :rowClickable="true" @rowClicked="showSale">
           <div slot="icons">
               <router-link to="/sales/create" class="btn btn-primary">
                 <icon-plus></icon-plus>
                 New Sale
               </router-link>
               </a>
           </div>
           <table-col label="Date" data-key="sold_at"/>
           <table-col label="Invoice Number" data-key="invoice_number"/>
           <table-col label="Total" data-key="total" data-type="currency"/>
       </data-table>
    </div>
</template>
<script>
export default {
    data(){
      return {
        sales:[],
      }
    },
    created(){
      window.axios.get("/api/sales").then(({data})=>{
        this.sales=data
      })
    },
    methods:{
      showSale(sale){
        this.$router.push(`/sales/${sale.id}`);
      }
    }
};
</script>
