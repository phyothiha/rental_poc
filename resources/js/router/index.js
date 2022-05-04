import VueRouter from "vue-router";
// import App from "../components/App.vue";

import FrontendLayout from "../views/layouts/Frontend.vue";
import RentalRequestForm from "../views/RentalRequestForm.vue";

import BackendLayout from "../views/layouts/Backend.vue";
import Dashboard from "../components/Dashboard.vue";

const frontend = [
  {
    path: "/",
    component: FrontendLayout,
    meta: { guest: true },
    children: [
      {
        path: "/rental-form",
        component: RentalRequestForm,
      },
    ],
  },
];

const backend = [
  {
    path: "/dashboard",
    component: BackendLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: "",
        component: Dashboard,
      },
    ],
  },
];

const routes = [...frontend, ...backend];

const router = new VueRouter({
  mode: "history",
  routes,
});

export default router;
