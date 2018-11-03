<template>
  <div v-if="drug">

      <div class="row">
          <div class="col-md-10">
            <data-table :data="drug.batches" title="Available Batches ">
                <div slot="icons">
                    <div class="btn-group">
                        <CreateBatch :drugId="drugId" @created="addBatch"/>
                        <button class="btn btn-sm" @click="destroyDrug">
                            <icon-trash/>
                        </button>
                    </div>
                 
                </div>
                <table-col label="Date" data-key="recorded_at" />
                <table-col label="Batch No" data-key="number" />
                <table-col 
                 label="Quantity" 
                 data-key="quantity" 
                 data-type="currency"
                 :formatter="formatQuantity"/>
                 <table-col  label="Unit Price" data-key="unit_price" data-type="currency"/>
                 <table-col  label="Expiry date" data-key="expires_at"/>
            </data-table>
              

          </div>
      </div>
  </div>
</template>
<script>
import CreateBatch from "./batches/CreateBatch"
export default {
    components:{CreateBatch},
    props: {
        drugId: { required: true }
    },
    data() {
        return {
            drug: null
        };
    },

    mounted() {
     window.axios.get(`/api/drugs/${this.drugId}`).then(({data})=>{
        this.drug=data
     })
    },
    methods:{
        destroyDrug(){
           Notify.confirm("This drug will be destroyed").then(done=>{
            axios.delete(`/api/drugs/${this.drugId}`).then(done=>this.$router.push("/drugs"))
           })
        },
        addBatch(batch){
          this.drug.batches.unshift(batch)
        },
        formatQuantity(quantity){
          return this.$options.filters.currency(quantity)+ ' units'
        }
    }
};
</script>