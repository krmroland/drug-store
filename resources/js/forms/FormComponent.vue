
<template>
	<form @submit.prevent="onSubmit">
		<slot></slot>
	</form>
</template>
<script>
import get from "lodash/get";
import set from "lodash/set";
import Errors from "./Errors";

export default {
	props: {
		fields: { default: () => ({}), type: Object },
		method: { default: "post" },
		action: { required: true }
	},
	provide() {
		return {
			updateFieldValue: this.updateFieldValue,
			getFieldValue: this.getFieldValue,
			registerInput: this.registerInput
		};
	},
	data() {
		return {
			currentFields: this.fields,
			formFields: {},
			inputs: {},
			errors:new Errors()
		};
	},

	methods: {
		onSubmit() {
			window.axios[this.method](this.action, this.formFields)
				.then(({data}) => this.$emit("submitted", data))
				.catch(this.updateInputErrors.bind(this));
		},
		updateInputErrors(error) {
			this.errors.set(error.response.data.errors);
			this.errors.keys().forEach(name=>{
				this.inputs[name].updateError(this.errors.first(name))
			})
		},
		updateFieldValue(name, value) {
			this.formFields = set(this.formFields, name, value);
			this.errors.clear(name)
			this.inputs[name].updateError(this.errors.first(name))
		},
		registerInput(input) {
			this.inputs[input.name] = input;
		},

		getFieldValue(name) {
			return get(this.currentFields, name, null);
		}
	}
};
</script>