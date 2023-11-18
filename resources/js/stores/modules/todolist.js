export default {
    namespaced: true,
    state: {
        myTaks: null,
    },
    getters: {
        myTaks(state) {
            return state.myTaks;
        },
        myTaksById: (state) => (id) => {
            return state.myTaks.find((taks) => taks.id === id);
        },
    },
    mutations: {
        setMyTaks(state, data) {
            state.myTaks = data;
        },
        updateSort(state, data) {
            state.myTaks = data;
        },
        deleteTaks: function (state, elementIndex) {
            state.myTaks.splice(elementIndex, 1);
        },
    },
    actions: {
        set_mytaks({ commit }, data) {
            commit("setMyTaks", data);
        },
        delete_mytaks({ commit }, data) {
            commit("deleteTaks", data);
        },
    },
};
