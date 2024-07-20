<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AdminSideNav from "../Components/AdminSideNav.vue";
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";


const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
});

const indicator = (status) => {
    switch (status) {
        case "completed":
            return "bg-green-500";
        case "pending":
            return "bg-blue-500";
        case "overdue":
            return "bg-red-500";
        default:
            return "bg-gray-500";
    }
};

console.log(props.tasks);
</script>

<template>
    <AuthenticatedLayout>
        <template #sidenav>
            <AdminSideNav></AdminSideNav>
        </template>
        <template #main-content>
            <div class="w-full h-full relative">
                <h1 class="text-3xl font-bold text-center">All Tasks</h1>
                <br />
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-300"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">Task name</th>
                            <th scope="col" class="px-6 py-3">Task Description</th>
                            <th scope="col" class="px-6 py-3">Person Assigned</th>
                            <th scope="col" class="px-6 py-3">Due date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b border-gray-500 hover:cursor-pointer hover:bg-gray-100"
                            v-for="task in tasks"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                            >
                                <Link :href="route('admin.show', {id: task.id})">{{ task.task_name }}</Link>
                            </th>
                            <td class="px-6 py-4">{{task.description}}</td>
                            <td class="px-6 py-4">{{task.name}}</td>
                            <td class="px-6 py-4">{{task.due_date}}</td>
                            <td class="px-6 py-4">
                                <div :class="`${indicator(task.status)}`" class="w-2 h-2 border rounded-full"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
