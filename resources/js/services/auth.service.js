import axios from "axios";
const token = localStorage.getItem("token");

class AuthService {
    registration(data) {
        return axios.post(
            "/api/register",
            {
                name: data.name,
                email: data.email,
                password: data.password,
            },
            {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            }
        );
    }

    login(data) {
        return axios.post(
            "/api/login",
            {
                email: data.email,
                password: data.password,
            },
            {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            }
        );
    }

    logout() {
        return axios.post("/api/logout", {
            headers: {
                Authorization: "Bearer " + token,
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
    }
}

export default new AuthService();
