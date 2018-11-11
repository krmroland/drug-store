<template>
    <div class="card">
        <h4 class="text-center text-primary mt-2">Sales summary report {{range}}</h4>
        <FormComponent method="get" @submitted="fetchData">
               <div class="input-group">
                   <DateInput mode="range" name="range"/>
                   <button class="btn btn-primary">
                    Generate Report
                </button>
            </div>
        </FormComponent>
      
        <div v-if="range" class="mt-3">
            <table class="table table-bordered table-sm">
                <thead class="mb-0 pb-0">
                    <tr>
                        <th>Number of sales Made</th>
                        <th> {{ data.length|currency }}</th>
                    </tr>
                    <tr>
                        <th>Total Cash sold</th>
                        <th> {{ total |currency}}</th>
                    </tr>
                </thead>
            </table>
            <div  v-if="data.length">
                <hr>
                <table class="table table-bordered table-sm mb-0 pb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Invoice Number</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in data" :key="sale.id">
                            <td>{{ sale.sold_at }}</td>
                            <td>{{ sale.invoice_number }}</td>
                            <td>{{ sale.total|currency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>
<script>
    import sumBy from "lodash/sumBy";

    export default {
        data(){
            return {
                range:"",
                data:[]
            }
        },
        methods:{
            fetchData({range}){
                this.range=range
                window.axios.get(`api/reports?range=${range}`).then(({data})=>{
                    this.data=data;
                }).catch(({response})=>{
                    const {errors,message}=response.data
                  Notify.error(errors.range[0],message);
                })
            }
        },
        computed:{
            total(){
                return sumBy(this.data,"total")
            }
        }
    };
</script>
