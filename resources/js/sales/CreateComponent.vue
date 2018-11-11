<template>
    <div>
        <div class="row">
            <div class="col-md-4">
              <drug-selector :drugs="unSelectedDrugs" @selected="this.addToCart"/>
            </div>
            <div class="col-md-8">
              <CartComponent :cart="cart" @remove="removeFromCart" @saleDone="saleDone"/>
            </div>
        </div>
    </div>
</template>
<script>
import DrugSelector from "./DrugSelector";
import CartComponent from "./CartComponent";

export default {
    components: { DrugSelector, CartComponent },
    data() {
        return {
            drugs: [],

            cart: {}
        };
    },
    created() {
        window.axios.get("/api/drugs?batches=true").then(({ data }) => {
            this.drugs = data;
        });
    },
    computed: {
        unSelectedDrugs() {
            return this.drugs.filter(drug => !this.cart[drug.id]);
        }
    },
    methods: {
        addToCart(data) {
            const { quantity, batch, drug } = data;
            const unitPrice = +batch.unit_price;
            const subTotal = unitPrice * +quantity;
            this.$set(this.cart, drug.id, {
                subTotal,
                unitPrice,
                quantity,
                name: drug.name,
                batchNumber: batch.number,
                id: drug.id
            });
        },
        removeFromCart(id) {
            this.$delete(this.cart, id);
        },
        saleDone(data) {
            this.cart = {};
            Notify.confirm(
                "Sale was successful, do you need a receipt?",
                "All Good"
            ).then(confirmed => this.$router.push(`/sales/${data.id}`));
        }
    }

};
</script>
