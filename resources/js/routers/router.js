// Layout
import Auth from "../layouts/Auth.vue";
import Home from "../layouts/Home.vue";

// View Auth
import LoginView from "../views/auth/LoginView.vue";
import RegistrationView from "../views/auth/RegistrationView.vue";

// View Home
import HomeView from "../views/home/HomeView.vue";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
        redirect: "/",
        meta: {
            isAuth: true,
        },
        children: [
            {
                path: "/",
                name: "HomeView",
                component: HomeView,
            },
        ],
    },
    {
        path: "/auth",
        component: Auth,
        name: "auth",
        redirect: "/auth/login",
        children: [
            {
                path: "/auth/login",
                name: "LoginView",
                component: LoginView,
            },
            {
                path: "/auth/registation",
                name: "RegistrationView",
                component: RegistrationView,
            },
        ],
    },
];

export default routes;
