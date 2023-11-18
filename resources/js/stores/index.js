import { createStore } from "vuex";

import auth from "./modules/auth";
import todolist from "./modules/todolist";

const stores = createStore({
    modules: {
        auth,
        todolist,
    },
});

export default stores;
