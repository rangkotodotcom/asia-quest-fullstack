import { createApp } from "vue";
import router from "./routers";
import stores from "./stores";
import setupInterceptor from "./services/setupInterceptor";
import App from "./App.vue";

setupInterceptor.getAuthSetup();

createApp(App).use(stores).use(router).mount("#app");

require("./bootstrap");
