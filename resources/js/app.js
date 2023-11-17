import { createApp } from "vue";
import router from "./routers";
import stores from "./stores";
import App from "./App.vue";

createApp(App).use(stores).use(router).mount("#app");

require("./bootstrap");
