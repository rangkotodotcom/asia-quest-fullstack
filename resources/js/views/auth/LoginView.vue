<template>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" method="POST">
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email" name="email" v-model="login.email" type="email" autocomplete="email"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        :class="[
                            errors.email == null
                                ? 'border-gray-300'
                                : ' border-red-600',
                        ]" />
                    <span class="text-xs text-red-600">{{ errors.email }}</span>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" v-model="login.password" type="password"
                        autocomplete="current-password"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        :class="[
                            errors.password == null
                                ? 'border-gray-300'
                                : ' border-red-600',
                        ]" />

                    <span class="text-xs text-red-600">{{ errors.password }}</span>
                </div>
            </div>

            <div>
                <button v-if="isProccess" type="button"
                    class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    disabled>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Processing...
                </button>


                <button v-else type="button" v-on:click="handleFormLogin"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            <router-link :to="{ name: 'RegistrationView' }"
                class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                Register here</router-link>
        </p>
    </div>
</template>

<script>
import authService from "../../services/auth.service";


export default {
    data() {
        return {
            login: {
            },
            errors: {
                email: null,
                password: null,
            },
            isProccess: false,
        };
    },
    methods: {
        async handleFormLogin(e) {

            if (this.login.email && this.login.password) {
                this.isProccess = true;

                try {
                    const responseLogin = await authService.login(this.login);

                    const response = await responseLogin.data;

                    if (response.status) {
                        localStorage.setItem('token', response.content.token);
                        this.$router.push('/');
                    }

                } catch (error) {
                    const { response } = error;
                    const { request, ...errorObject } = response;
                    var err = errorObject.data;


                    this.isProccess = false;
                    alert(err.message);
                };
            }

            this.errors = [];

            if (!this.login.email) {
                this.errors.email = "Masukkan Email";
            }

            if (!this.login.password) {
                this.errors.password = "Masukkan Password";
            }

            e.preventDefault();
        }
    }

}

</script>