<template>
    <div>
        <data-table 
            :data="data" 
            title="Available Drugs"
            :rowClickable="true"
            @rowClicked="showDrugDetails"
            >
            <div slot="icons">
              <button  @click="shouldShow=true" class="btn btn-primary btn-sm">
                  <icon-plus></icon-plus>
                  Register New Drug
              </button>
            </div>
            <table-col label="Name" data-key="name"></table-col>
            <table-col label="No of batches" data-key="batches_count"></table-col>
        </data-table>
        <CreateDrug :shouldShow.sync="shouldShow" @created="drugCreated"/>
    </div>
</template>
<script>
import CreateDrug from "./CreateDrug"
export default {
    components:{CreateDrug},
    data(){
        return {
            shouldShow:false,
            data:[]
        }
    },
    mounted(){
        window.axios.get("api/drugs").then(({data})=>{
            this.data=data
        })
    },
    methods:{
       drugCreated(drug){
         this.data.unshift(drug)
         this.shouldShow=false
         Notify.success("Drug was registered successfully")
       },
       showDrugDetails({id}){
         this.$router.push(`/drugs/${id}`)
       }
    }
};
</script>
