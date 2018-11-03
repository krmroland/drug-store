import Vue from "vue";
import VueRouter from "vue-router";

import SalesComponent from "./components/SalesComponent";
import ReportsComponent from "./components/ReportsComponent";
Vue.use(VueRouter);

const routes = [
    { path: "/home", component: require("./components/DashboardComponent") },
    {
        path: "/drugs",
        component: require("./drugs/LayoutComponent"),
        children: [
            {
                path: "/",
                component: require("./drugs/IndexComponent"),
                props: true
            },
            {
                path: ":drugId",
                component: require("./drugs/ShowDrug"),
                props: true
            }
        ]
    },
    { path: "/sales", component: SalesComponent },
    { path: "/reports", component: ReportsComponent }
];

export default new VueRouter({
    routes,
    mode: "history",
    linkActiveClass: "active"
});
