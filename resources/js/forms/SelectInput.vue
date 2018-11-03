<template>
	<div>
		<select
		 type="text" 
		 :placeholder="placeholder" 
		 :name="name"
		 :class="{'is-invalid':error}"
		 v-model="currentValue"
		 class="form-control" 
		 >
		 <option :value="undefined">{{ placeholder }}</option>
		 <option :value="key" v-for="(value,key) in normalizedOptions">
		 	{{ value }}
		 </option>
		 </select>

		<p class="invalid-feedback" v-if="error">
			<strong v-text="error"></strong>
		</p>
	</div>

</template>
<script>
import BaseInput from "./BaseInput";

export default BaseInput.extend({
	props: {
		type: { default: "text" },
		defaultValue: { default: undefined },
		placeholder: { default: "Select ...." },
		rules: { default: () => [], type: Array },
		name: { required: true, type: String },
		options: { required: false, type: [Object, Array, Number] },
		useKeysAsValues: { default: false },
		filter: {
			type: Function,
			default: value => true
		},
		format: {
			type: Function,
			default: value => value
		}
	},
	computed: {
		normalizedOptions() {
			let options = this.options;

			let newOptions = {};

			if (!options) {
				return {};
			}
			if (Array.isArray(options)) {
				options.forEach((option, index) => {
					newOptions = this.addIfValid(newOptions, option, index);
				});
				return newOptions;
			}
			if (Number(options)) {
				for (let i = 1; i <= Number.parseInt(options); i++) {
					newOptions = this.addIfValid(newOptions, i, i);
				}
				return newOptions;
			}
			return options;
		}
	},
	methods: {
		addIfValid(newOptions, option, index) {
			if (this.filter(option, index)) {
				const formated = this.format(option);
				if (this.useKeysAsValues) {
					newOptions[index] = formated;
				} else {
					newOptions[formated] = formated;
				}
			}
			return newOptions;
		}
	}
});
</script>
