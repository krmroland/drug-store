<template>
    <div class="card">
        <div class="d-flex justify-content-end print-button">
            <button class="btn btn-primary" @click="printReceipt">
                Print Receipt
                <icon-print/>
            </button>
        </div>
        <ReceiptComponent :sale="sale" :shouldPrint.sync="shouldPrint" v-if="sale"/>
    </div>
</template>
<script>
import ReceiptComponent from "./ReceiptComponent"

export default {

    components:{ReceiptComponent},

    props:{
        id:{
            required:true,

        }
    } ,
    data(){
        return {
            sale:null,
            shouldPrint:false
        }
    },
    mounted(){
        window.axios.get(`/api/sales/${this.id}`).then(({data})=>{
            this.sale=data
        });
    },
    methods:{
        printReceipt(){
            window.Notify.confirm("This will print a receipt").then(done=>{
              this.shouldPrint=true
            })
        }
    }
};
</script>
<style>
    .card{
        display:relative;
    }
    .print-button{
        position:absolute;
        top:0;
        right:0;
    }
</style>
