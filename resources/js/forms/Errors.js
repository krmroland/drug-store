import debounce from "lodash/debounce";
class Errors {
    constructor(errors) {
        this.errors = {};
    }
    set(errors = {}) {
        this.errors = errors;
    }
    first(name) {
        if (!this.has(name)) return;
        return this.errors[name][0];
    }
    has(name) {
        return Object.prototype.hasOwnProperty.call(this.errors, name);
    }
    keys() {
        return Object.keys(this.errors);
    }
    clear(name) {
        if (this.has(name)) {
            delete this.errors[name];
        }
    }
}

export default Errors;
