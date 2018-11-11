<template>
    <div  id="receipt">
        <h3 class="text-center py-1">Invoice {{ sale.invoice_number }}</h3>
        <table class="table table-stripped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(sale,index) in sale.drugs">
                    <td>{{ index+1 }}</td>
                    <td>{{ sale.drug.name }}</td>
                    <td>{{ sale.quantity|currency}}</td>
                    <td>{{ sale.unit_price }}</td>
                    <td>{{ (sale.quantity * sale.unit_price)|currency}}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total</td>
                    <td>{{ total }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>
<script>
import { Printd } from "printd";

import sum from "lodash/sum";

const printer = new Printd();

const css=`
#receipt{
    font-size:1.1rem;
}
h2{
    text-align:center;
}
table{
    width:100%;
    border-collapse:collapse;
}
td{
    border-top:1px solid #3e4e59;
    padding:0.5em 1em;
}
th{
    border-top:2px solid #3e4e59;
    border-bottom:2px solid #3e4e59;
    padding:1em;
}
tfoot,td{
    font-weight:900;
}
`

export default {
    mounted() {
        const { contentWindow } = printer.getIFrame();

        contentWindow.addEventListener("afterprint", () =>
            this.$emit("update:shouldPrint", false)
        );
    },

    props: {
        sale: {
            required: true,
            type: Object
        },
        shouldPrint: { required: true, type: Boolean }
    },
    watch: {
        shouldPrint(newValue) {
            if (newValue) {
                printer.print(this.$el,css);
            }
        }
    },
    computed: {
        total() {
            return sum(
                this.sale.drugs.map(sale => sale.quantity * sale.unit_price)
            );
        }
    }
};
</script>