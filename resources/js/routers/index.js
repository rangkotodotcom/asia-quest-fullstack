import { createWebHistory, createRouter } from "vue-router";

import routes from "./router";
import stores from "../stores";

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return {
            top: 0,
        };
    },
});

router.beforeEach((to, from, next) => {
    if (
        (to.name === "auth" ||
            to.name === "LoginView" ||
            to.name === "RegistrationView") &&
        stores.getters["auth/isLoggedIn"]
    ) {
        next({ path: "/" });
    } else if (to.matched.some((record) => record.meta.isAuth)) {
        if (!stores.getters["auth/isLoggedIn"]) {
            next({ path: "/auth" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
