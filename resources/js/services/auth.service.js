import axios from "axios";

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
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
    }
}

export default new AuthService();
