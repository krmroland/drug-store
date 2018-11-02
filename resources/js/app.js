import "./bootstrap";
import Vue from "vue";
import "./components/icons";
import router from "./router";
import "./components";

import "./tables";

const app = new Vue({
    el: "#app",
    router
});
