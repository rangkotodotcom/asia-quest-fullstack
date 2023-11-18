<template>
    <div class="px-3 py-1 sm:px-0 mt-5">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                To Do List
            </h1>
        </div>
        <div class="h-screen rounded-lg border-2 border-dashed border-indigo-500">

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 bg-white">
                    <button type="button" v-on:click="buttonAdd"
                        class="rounded-md bg-emerald-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        Add
                    </button>

                </div>

                <div :class="[showForm ? 'block' : 'hidden']">
                    <div class="space-y-8 px-6 py-6">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold text-gray-900">Form Taks</h2>
                            <input type="hidden" v-model="form.id">

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="taks" class="block text-sm font-medium leading-6 text-gray-900">Taks</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                            <input type="text" name="taks" id="taks" required v-model="form.taks"
                                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="button" v-on:click="cancelForm"
                                    class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                                <button type="button" v-on:click="handleSubmit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                            </div>
                        </div>

                    </div>
                </div>

                <table class="items-center w-full bg-transparent border-collapse border-blueGray-500 border-solid">
                    <thead>
                        <tr>
                            <th
                                class="md:px-6 align-middle border border-solid md:py-4 md:text-sm uppercase border-l-0 border-r-0 font-bold text-center bg-orange-100 text-gray-900 border-white text-xs py-2 px-2">
                                No
                            </th>
                            <th
                                class="md:px-6 align-middle border border-solid md:py-4 md:text-sm uppercase border-l-0 border-r-0 font-bold text-center bg-orange-100 text-gray-900 border-white text-xs py-2 px-2">
                                To Do
                            </th>
                            <th
                                class="md:px-6 align-middle border border-solid md:py-4 md:text-sm uppercase border-l-0 border-r-0 font-bold text-center bg-orange-100 text-gray-900 border-white text-xs py-2 px-2">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item, index in myTaks">
                            <th
                                class="border-t-0 md:px-6 px-2 align-middle border-l-0 border-r-0 md:text-sm text-xs md:py4 py-3 text-center flex items-center">
                                <span class="ml-3 font-bold text-blueGray-600 text-center">
                                    {{ ++index }}
                                    <input type="checkbox" v-on:click="handleCheck(item.id, item.status)"
                                        class="h-4 w-4 rounded border-grey-300 text-indigo-600 foucs:ring-indigo-600"
                                        :checked="item.status == '1' ? true : false">
                                </span>
                            </th>
                            <td
                                class="border-t-0 md:px-6 px-2 align-middle border-l-0 border-r-0 md:text-sm text-xs md:py4 py-3 text-center">
                                <p class="text-md font-bold"
                                    :class="[item.status == '1' ? 'text-emerald-500' : 'text-black']">
                                    {{ item.taks }}
                                </p>
                            </td>
                            <td
                                class="border-t-0 md:px-6 px-2 align-middle border-l-0 border-r-0 md:text-sm text-xs md:py4 py-3 text-center">
                                <div class="flex items-center justify-center gap-x-6">
                                    <button type="button" v-on:click="buttonEdit(item)"
                                        class="rounded-md bg-blue-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Edit</button>
                                    <button type="button" v-on:click="handleDelete(item.id)"
                                        class="rounded-md bg-red-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>


<script>
import { mapGetters } from "vuex";
import ToDoService from "../../services/todo.service"

export default {
    data() {
        return {
            showForm: false,
            form: {
                id: null,
                taks: null,
            },
        }
    },
    computed: {
        ...mapGetters({
            myTaks: 'todolist/myTaks',
        }),
    },

    async mounted() {
        if (this.$store.getters['todolist/myTaks'] === null) {
            try {
                const responseMyTaks = await ToDoService.getAllToDo();

                const dataMyTaks = await responseMyTaks.data;

                if (dataMyTaks.status) {
                    this.$store.dispatch("todolist/set_mytaks", dataMyTaks.content);
                }
            } catch (e) {
                alert(e);
            }
        }
    },
    methods: {
        buttonAdd() {
            this.form.id = null;
            this.form.taks = null;
            this.showForm = true;
        },

        buttonEdit(taks) {
            this.form.id = taks.id;
            this.form.taks = taks.taks;
            this.showForm = true;
        },

        cancelForm() {
            this.form.id = null;
            this.form.taks = null;
            this.showForm = false;
        },

        async handleSubmit() {
            if (this.form.id == null) {
                try {
                    const responseMyTaks = await ToDoService.storeToDO(this.form);

                    const dataMyTaks = await responseMyTaks.data;

                    if (dataMyTaks.status) {
                        this.$store.dispatch("todolist/set_mytaks", dataMyTaks.content);
                        this.showForm = false;
                    }
                } catch (e) {
                    alert(e);
                }
            } else {
                try {
                    const responseMyTaks = await ToDoService.updateToDO(this.form);

                    const dataMyTaks = await responseMyTaks.data;

                    if (dataMyTaks.status) {
                        this.$store.dispatch("todolist/set_mytaks", dataMyTaks.content);
                        this.showForm = false;
                    }
                } catch (e) {
                    alert(e);
                }
            }
        },

        async handleDelete(id) {
            try {
                const responseMyTaks = await ToDoService.deleteToDO(id);

                const statusCode = responseMyTaks.status;

                if (statusCode == 204) {
                    this.$store.dispatch("todolist/delete_mytaks",);
                    this.showForm = false;
                }
            } catch (e) {
                alert(e);
            }
        },

        async handleCheck(id, status) {
            if (status == '1') {
                var newStatus = '0';
            } else {
                var newStatus = '1';
            }

            let data = {
                id: id,
                status: newStatus,
            }


            try {
                const responseMyTaks = await ToDoService.updateStatusToDO(data);

                const dataMyTaks = await responseMyTaks.data;

                if (dataMyTaks.status) {
                    this.$store.dispatch("todolist/set_mytaks", dataMyTaks.content);
                }
            } catch (e) {
                alert(e);
            }
        }
    }
}

</script>