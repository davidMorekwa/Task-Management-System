<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import TaskItem from "../Components/TaskItem.vue";
import UserSideNav from "../Components/UserSideNav.vue";
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "../Components/PrimaryButton.vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import {useForm} from "@inertiajs/vue3";

const toast = useToast();
const props = defineProps({
    overdueTasks: {
        type: Object,
    },
});

const formData = useForm({
    id: "",
});
const completeTask = (id) => {
    console.log("Complete task " + id);

    formData.put(route("user.complete", { id: id }), {
        onSuccess: () => {
            toast.success("Task completed successfully", {
                position: "top-right",
                duration: 2000,
            });
        },
        onError: (error) => {
            toast.error("An error occurred while completing task", {
                position: "top-right",
                duration: 2000,
            });
            console.error(error);
        },
    });
};
</script>

<template>
    <Head title="Overdue" />
    <AuthenticatedLayout>
        <template #sidenav>
            <UserSideNav></UserSideNav>
        </template>
        <template #main-content>
            <div class="w-full h-full">
                <h1 class="text-3xl font-bold text-center">Overdue Tasks</h1>
                <br />
                <table
                    v-if="props.overdueTasks.length > 0"
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">Task name</th>
                            <th scope="col" class="px-6 py-3">
                                Task Description
                            </th>
                            <th scope="col" class="px-6 py-3">Due date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b border-gray-500 hover:cursor-pointer hover:bg-gray-100"
                            v-for="task in props.overdueTasks"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                            >
                                <Link
                                    :href="route('admin.show', { id: task.id })"
                                    >{{ task.task_name }}</Link
                                >
                            </th>
                            <td class="px-6 py-4">{{ task.description }}</td>
                            <td class="px-6 py-4">{{ task.name }}</td>
                            <td class="px-6 py-4">{{ task.due_date }}</td>
                            <td>
                                <PrimaryButton
                                    @click="completeTask(task.id)"
                                    class="bg-green-100 hover:bg-green-300 active:bg-green-300 focus:bg-green-300"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        x="0px"
                                        y="0px"
                                        fill="green"
                                        width="15"
                                        height="15"
                                        viewBox="0 0 50 50"
                                    >
                                        <path
                                            d="M 41.9375 8.625 C 41.273438 8.648438 40.664063 9 40.3125 9.5625 L 21.5 38.34375 L 9.3125 27.8125 C 8.789063 27.269531 8.003906 27.066406 7.28125 27.292969 C 6.5625 27.515625 6.027344 28.125 5.902344 28.867188 C 5.777344 29.613281 6.078125 30.363281 6.6875 30.8125 L 20.625 42.875 C 21.0625 43.246094 21.640625 43.410156 22.207031 43.328125 C 22.777344 43.242188 23.28125 42.917969 23.59375 42.4375 L 43.6875 11.75 C 44.117188 11.121094 44.152344 10.308594 43.78125 9.644531 C 43.410156 8.984375 42.695313 8.589844 41.9375 8.625 Z"
                                        ></path>
                                    </svg>
                                </PrimaryButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="flex flex-col items-center">
                    <p>No Overdue tasks</p>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
