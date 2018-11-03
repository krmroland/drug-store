import Vue from "vue";
import startCase from "lodash/startCase";
export default Vue.mixin({
	filters: {
		currency(value) {
			const number = +value;
			return number
				? Number(value).toLocaleString(undefined, {
						maximumFractionDigits: 3
				  })
				: value;
		},
		startCase(value) {
			return startCase(value);
		}
	}
});
