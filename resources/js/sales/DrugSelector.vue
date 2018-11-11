<template>
    <div>
    <div class="card mb-2" v-if="selectedDrug">
        <h3 class="cardTilte text-primary text-center text-capitalize pt-2">
           {{ selectedDrug.name }}
        </h3>
        <div class="card-body">
         <table class="table table-sm table-borderered" v-if="selectedBatch">
             <thead>
                 <tr>
                     <th>Quantity</th>
                     <th>Unit Price</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>{{ selectedBatch.quantity|currency }} units</td>
                     <td>{{ selectedBatch.unit_price|currency }} /=</td>
                 </tr>
             </tbody>
         </table>
        </div>
    </div>
    <div class="alert alert-light" v-else>
        Please select a drug
    </div>
 
      <div class="form-group">
        <label>Select A drug</label>
         <search-component 
            :data="drugs" 
            :keys="['name']" 
            keyBy="id"
            :render="drug=>drug.name"
            @selected="selectedDrugId=$event"

            />
      </div>

      <div class="alert alert-danger" v-if="selectedDrug && batches.length===0">
          No available Batches
      </div> 

      <div class="form-group"  v-if="batches.length!==0">
        <label>Select A Batch</label>
          <select class="form-control" v-model="selectedBatchIndex">
              <option value="">Select ....</option>
             <template v-for="(batch,index) in batches" >
                 <option :value="index">{{batch.number}}</option>
             </template>
          </select>
      </div>

      <div class="form-group"  v-if="selectedBatch">
        <label>Select the quantity</label>
        <input type="number"  :value="quantity" @input="updateQuantity" class="form-control">
        <p v-if="quantityError" class="text-danger">{{ quantityError }} </p>
      </div>
      <div class="form-group" >
          <button class="btn btn-primary btn-block" :disabled="!quantity|| !selectedBatch" @click="submit">
                <icon-cart></icon-cart>
              Add to cart
          </button>
      </div>
    </div>
</template>
<script>
export default {
    props: {
        drugs: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            selectedDrugId: "",
            selectedBatchIndex: "",
            quantity: "",
            quantityError: ""
        };
    },

    computed: {
        batches() {
            if (!this.selectedDrugId) return [];
            return this.selectedDrug.batches;
        },
        selectedDrug() {
            return this.drugs.find(({ id }) => id === +this.selectedDrugId);
        },

        selectedBatch() {
            return this.batches[this.selectedBatchIndex] || null;
        }
    },
    methods: {
        updateQuantity(event) {
            const value = +event.target.value;
            this.quantity = null;
            const availableQuantity = +this.selectedBatch.quantity;
            if (!value) {
                this.quantityError =
                    "Quantity must be a number that is greater than 0";
                this.quantity = null;
                return;
            }
            if (value > availableQuantity) {
                this.quantityError = "Please select a batch with more drugs";
                this.quantity = availableQuantity;
                return;
            }

            this.quantity = value;
        },
        submit() {
            this.$emit("selected", {
                quantity: this.quantity,
                selectedDrugId: this.selectedDrugId,
                drug:this.selectedDrug,
                batch:this.selectedBatch
            });
            for (let key in this.$data) {
                this[key] = "";
            }
        }
    }
};
</script>