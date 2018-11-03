<template>
    <input type="text" class="form-control" :name="name" >
</template>

<script>
import flatpickr from "flatpickr";
import endOfMonth from "date-fns/end_of_month";
import startOfMonth from "date-fns/start_of_month";
import format from "date-fns/format";
import BaseInput from "./BaseInput";


export default BaseInput.extend({
    props: {
        defaultValue: { deafult: "" },
        format: { default: "Y-m-d" },
        name: { required: true },
        mode: { default: "single" },
        isMax: { default: true },
        minDate: { default: "" },
        enableTime: { default: false }
    },
    mounted() {
        flatpickr(this.$el, this.options);
    },
    computed: {
        maxDate(){
        if (this.isMax && this.mode === "single") {
            return new Date();
        }
        return null;
        },
        defaultDate() {
            if (this.currentValue) {
                return this.currentValue;
            }
            if (this.defaultValue) {
                return this.defaultValue;
            }
            if (this.mode === "single") {
                return "today";
            }
            return null;
            // const today = new Date();
            // const monthStarts = format(startOfMonth(today), "YYYY-MM-DD");
            // const monthEnds = format(endOfMonth(today), "YYYY-MM-DD");
            // return `${monthStarts} to ${monthEnds} `;
        },
        options() {
            let $options = {
                maxDate: this.maxDate,
                mode: this.mode,
                // dateFormat: this.format,
                defaultDate: this.defaultDate,
                onChange: (selectedDates, dateStr, instance) => {
                    this.updateFieldValue(this.name, dateStr);
                    this.$emit("updated", dateStr);
                },
                //we will make the initial dispatch to update the default defaultValue
                onReady: (selectedDates, dateStr, instance) => {
                    this.$emit("updated", dateStr);
                    this.updateFieldValue(this.name, dateStr);
                }
            };
            if (this.minDate) {
                $options.minDate = this.minDate;
            }
            if (this.enableTime) {
                $options.enableTime = true;
            }
            return $options;
        }
    }
});
</script>

<style lang="scss" scoped>
</style>
