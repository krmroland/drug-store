import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
    {
        path: "/drugs",
        component: require("./components/EmptyLayout"),
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
    {
        path: "/sales",
        component: require("./components/EmptyLayout"),
        children: [
            {
                path: "/",
                component: require("./sales/IndexComponent")
            },
            {
                path: "create",
                component: require("./sales/CreateComponent")
            },
            {
                path: ":id",
                props: true,
                component: require("./sales/ShowSale")
            }
        ]
    },
    { path: "/reports", component: require("./reports/IndexComponent") },
    { path: "/home", component: require("./components/DashboardComponent") }
];

export default new VueRouter({
    routes,
    mode: "history",
    linkActiveClass: "active"
});
