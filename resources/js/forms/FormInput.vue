<template>
	<div>
			<input 
			type="text" 
			:placeholder="placeholder" 
			:name="name"
			:disabled="disabled"
			:class="{'is-invalid':error}"
			v-model="currentValue"
			class="form-control" 
		>
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
		disabled: { default: false },
		placeholder: {},
		rules: { default: () => [], type: Array },
		defaultValue: { default: null },
		name: { required: true, type: String }
	}
});
</script>
