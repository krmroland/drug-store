import "./bootstrap";
import Vue from "vue";

import router from "./router";
import "./components";
import "./icons";
import "./tables";

import "./forms";

import globalMixin from "./mixin";

import App from "./App";

import "./Notifications";

const app = new Vue({
    router,
    mixins: [globalMixin],
    render: h => h(App)
}).$mount("#app");
