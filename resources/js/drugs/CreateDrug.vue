<template>
    <modal-component :show="shouldShow" size="modal-sm" @closed="closeModel">
        <h5 slot="title">Register A new Drug</h5>
       <FormComponent action="/api/drugs" @submitted="$emit('created',$event)" >
           <div class="form-group">
               <FormInput name="name" placeholder="The drugs name"/>
           </div>
           <div class="form-group">
            <button class="btn btn-primary btn-block">
               <icon-save></icon-save>
               Register Drug
           </button>
           </div>
       </FormComponent>  
    </modal-component>
</template>
<script>
export default {
    props: {
        shouldShow: { required: true }
    },
    methods:{
        closeModel(){
            this.$emit("update:shouldShow",false)
        }
    }
};
</script>