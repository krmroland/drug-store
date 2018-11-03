<template>
    <div>
        <button class="btn btn-primary btn-sm" @click="isCreating=true">
            <icon-plus/>
            New Batch
        </button>
        <modal-component :show.sync="isCreating" size="modal-sm">
            <h5 slot="title">Record a new batch</h5>
            <FormComponent :action="action" @submitted="submitted">
                <div class="form-group">
                    <label>Date</label>
                    <DateInput name="recorded_at"></DateInput>
                </div>
                <div class="form-group">
                    <label>Quantity Purchased</label>
                    <FormInput name="quantity"></FormInput>
                </div>
                <div class="form-group">
                    <label>Unit Price</label>
                    <FormInput name="unit_price"></FormInput>
                </div>
                <div class="form-group">
                    <label>Expiry date</label>
                    <DateInput name="expires_at" :is-max="false"></DateInput>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">
                        <icon-save/>
                        Record batch
                    </button>
                </div>
            </FormComponent>
        </modal-component>
    </div>
   
</template>
<script>
    export default {
        props:{
            drugId:{required:true},
        },
        data(){
            return {
                isCreating:false
            }
        },
        computed:{
            action(){
                return `/api/drugs/${this.drugId}/batches`
            }
        },
        methods:{
            submitted(data){
                this.$emit('created',data)
                Notify.success("Batch was added successfully")
                this.isCreating=false;
            }
        }
    };
</script>
