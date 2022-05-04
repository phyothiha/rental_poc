// Global
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import { createApp } from "vue";
import "./utils/global-validators";

import RentalForm from "./components/RentalForm.vue";
import DashboardHeader from "./components/Dashboard/Header.vue";
import DashboardNavigationBar from "./components/Dashboard/NavigationBar.vue";
import DashboardTable from "./components/Dashboard/Table.vue";

// # Creating an Application Instance
const app = createApp({
  data: () => ({}),
});

// # Component Registration - Global Registration

// Frontend
app.component("rental-form", RentalForm);

// Backend
app
  .component("dashboard-header", DashboardHeader)
  .component("dashboard-navigation-bar", DashboardNavigationBar)
  .component("dashboard-table", DashboardTable);

// # Mounting the App
app.mount("#app");
