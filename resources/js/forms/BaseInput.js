import Vue from "vue";

export default Vue.extend({
	inject: ["getFieldValue", "updateFieldValue", "registerInput"],

	mounted() {
		this.registerInput(this);

		//favor the objects data over the default data
		this.currentValue =
			this.getFieldValue(this.name) || this.defaultValue || null;

		//make an initial FieldValue update
		this.updateFieldValue(this.name, this.defaultValue);
	},
	data() {
		return {
			error: null,
			currentValue: null
		};
	},
	methods: {
		updateError(error) {
			this.error = error;
		}
	},
	watch: {
		currentValue(newValue) {
			this.updateFieldValue(this.name, newValue);
		}
	}
});
