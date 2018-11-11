<template>
    <FormComponent @submitted="proccessCart">
    <div class="card">
        <div v-if="hasItems" class="py-2">
            <div class="div">
                <label for="">Select a date</label>
                <DateInput name="date"></DateInput>
            </div>
            
            <table class="table table-stripped table-sm" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Batch No</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in cart">
                        <td>{{ item.name }}</td>
                        <td>{{ item.batchNumber }}</td>
                        <td>{{ item.unitPrice|currency }}</td>
                        <td>{{ item.quantity|currency }} units</td>
                        <td>{{ item.subTotal|currency }} /=</td>
                        <td>
                            <a @click="$emit('remove',item.id)">
                               <icon-minus-square/>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-center">Total</th>
                        <th colspan="2" class="font-weight-bold text-primary">
                            {{ total|currency }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
       
        <div class="card-body">      
            <div class="alert alert-danger" v-if="!hasItems">
                Please select some drugs
            </div>

            <div class="form-group" v-if="hasItems">
                <button class="btn btn-primary" >
                    <icon-cart></icon-cart>
                    Sale Drugs
                </button>
            </div>
        </div>
    </div>
    </FormComponent>
</template>
<script>
import sumBy from "lodash/sumBy";
export default {
    props: {
        cart: {
            required: true,
            type: Object
        }
    },
    computed: {
        hasItems() {
            return Object.keys(this.cart).length > 0;
        },
        total() {
            return sumBy(Object.values(this.cart), "subTotal");
        }
    },
    methods: {
        proccessCart({date}) {
            window.Notify.confirm("Data will be persisted to the database")
                .then(this.submitCart.bind(this,date))
        },
        submitCart(date){
          window.axios.post("/api/sales/",{
            date,
            cart:this.cart
          }).then(({data})=>{
            
            this.$emit("saleDone",data)
          })
        }
    }
};
</script>
<style scoped="">
    a:hover{
        cursor: pointer;
    }
</style>