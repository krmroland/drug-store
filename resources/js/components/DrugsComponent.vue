<template>
    <div>
        <data-table :data="[]" title="Available Drugs">
            <div slot="icons">
              
            </div>
            <table-col label="Name" data-key="name"></table-col>
            <table-col label="Unit Price" data-key="price"></table-col>
            <table-col label="Available Quantity" data-key="quantity"></table-col>
        </data-table>
        <modal-component :show="shouldShow">
                <h4 slot="title">Register A new Drug</h4>
        </modal-component> 
        <button  @click="shouldShow=true">
            <icon-plus></icon-plus>
            Register New Drug
        </button>
    </div>
</template>
<script>
export default {
    data(){
        return {
            shouldShow:false
        }
    }
};
</script>
