import Vue from "vue";
import VueRouter from "vue-router";
import DashboardComponent from "./components/DashboardComponent";
import DrugsComponent from "./components/DrugsComponent";
import SalesComponent from "./components/SalesComponent";
import ReportsComponent from "./components/ReportsComponent";
Vue.use(VueRouter);

const routes = [
    { path: "/home", component: DashboardComponent },
    { path: "/drugs", component: DrugsComponent },
    { path: "/sales", component: SalesComponent },
    { path: "/reports", component: ReportsComponent }
];

export default new VueRouter({
    routes,
    mode: "history",
    linkActiveClass: "active"
});
