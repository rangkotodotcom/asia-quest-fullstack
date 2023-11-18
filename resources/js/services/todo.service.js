import axios from "axios";
const token = localStorage.getItem("token");

class ToDoService {
    getAllToDo() {
        return axios.get("/api/todolist", {
            headers: {
                Authorization: "Bearer " + token,
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
    }

    getSingleToDo(id) {
        return axios.get("/api/todolist/" + id, {
            headers: {
                Authorization: "Bearer " + token,
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
    }

    storeToDO(data) {
        return axios.post(
            "/api/todolist",
            {
                taks: data.taks,
            },
            {
                headers: {
                    Authorization: "Bearer " + token,
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            }
        );
    }

    updateToDO(data) {
        return axios.put(
            "/api/todolist/" + data.id,
            {
                taks: data.taks,
            },
            {
                headers: {
                    Authorization: "Bearer " + token,
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            }
        );
    }

    updateStatusToDO(data) {
        return axios.put(
            "/api/todolist/" + data.id + "/status",
            {
                status: data.status,
            },
            {
                headers: {
                    Authorization: "Bearer " + token,
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            }
        );
    }

    deleteToDO(id) {
        return axios.delete("/api/todolist/" + id, {
            headers: {
                Authorization: "Bearer " + token,
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
    }
}

export default new ToDoService();
