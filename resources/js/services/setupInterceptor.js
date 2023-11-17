import stores from "../stores";

class setupInterceptorService {
    getAuthSetup() {
        var token = localStorage.getItem("token");

        if (token) {
            stores.dispatch("auth/set_login");
        }
    }
}

export default new setupInterceptorService();
