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
        setLogged(state, data) {
            state.isLoggedIn = true;
            state.latisKey = data;
        },
        setLogout(state) {
            state.isLoggedIn = false;
            state.latisKey = null;
        },
    },
    actions: {
        set_login({ commit }, data) {
            commit("setLogged", data);
        },
        set_logout({ commit }) {
            commit("setLogout");
        },
    },
};
