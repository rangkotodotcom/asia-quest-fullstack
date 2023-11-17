export default {
    namespaced: true,
    state: {
        isLoggedIn: false,
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
    },
    mutations: {
        setLogged(state) {
            state.isLoggedIn = true;
        },
        setLogout(state) {
            state.isLoggedIn = false;
        },
    },
    actions: {
        set_login({ commit }) {
            commit("setLogged");
        },
        set_logout({ commit }) {
            commit("setLogout");
        },
    },
};
