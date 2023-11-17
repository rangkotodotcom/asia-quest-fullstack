import { createStore } from "vuex";

import auth from "./modules/auth";

const stores = createStore({
    modules: {
        auth,
    },
});

export default stores;
