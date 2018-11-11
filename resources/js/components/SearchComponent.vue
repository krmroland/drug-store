<template>
    <div class="form-group">
        <div class="input-group">
            <input 
                type="search" 
                class="form-control" 
                :value="query"
                @input="search($event.target.value)"
                placeholder="Type in to begin searching">
            <div class="input-group-append">
              <span class="input-group-text text-primary">
                  <icon-search></icon-search>
              </span>
            </div>
        </div>
        <div class="list-group" v-if="searchList.length>0 || error">
            <li v-if="error"  class="list-group-item list-group-item-action list-group-item-danger">
                {{ error }}
            </li>
          <li class="list-group-item list-group-item-action" v-for="result in searchList" :key="result.key" @click="itemClicked(result)">
            {{result.value}}
          </li>
        </div>
    </div>
   
</template>
<script>
import Fuse from "fuse.js";
export default {
    props: {
        data: {
            required: true,
            type: Array
        },
        keys: {
            type: Array,
            required: true
        },
        id: {
            default: null
        },
        render: {
            type: Function,
            required: true
        },
        keyBy: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            query: "",
            error: null,
            searchList: []
        };
    },
    computed: {
        fuse() {
            return new Fuse(this.data, this.options);
        },
        options() {
            return {
                keys: this.keys,
                shouldSort: true,
                tokenize: true,
                minMatchCharLength: 2
            };
        }
    },

    methods: {
        itemClicked(result) {
            this.query =result.value;
            this.$emit("selected", result.key);
            this.searchList = [];
        },
        search(value) {
            this.query = value;
            this.error = null;
            let results = this.fuse.search(value);

            if (!value) {
                results = this.data;
            }

            this.searchList = results.map(item => ({
                key: item[this.keyBy],
                value: this.render(item)
            }));
            
            if (results.length === 0 && value) {
                this.error = "No matches found";
            }
        }
    }
};
</script>
<style scoped>
li:hover {
    cursor: pointer;
}
</style>