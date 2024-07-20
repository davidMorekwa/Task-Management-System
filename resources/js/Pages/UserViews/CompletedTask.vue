<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TaskItem from '../Components/TaskItem.vue';
import UserSideNav from '../Components/UserSideNav.vue';
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
      completedTasks: {
            type: Object,
      }
})


</script>

<template>
      <Head title="Completed"/>
      <AuthenticatedLayout>
            <template #sidenav>
                  <UserSideNav></UserSideNav>
            </template>
            <template #main-content>
                  <div class="w-full h-full">
                        <h1 class="text-3xl font-bold text-center">Completed Tasks</h1>
                        <br>
                        <table v-if="props.completedTasks.length > 0"
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-300"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">Task name</th>
                            <th scope="col" class="px-6 py-3">Task Description</th>
                            <th scope="col" class="px-6 py-3 ">Due date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b border-gray-500 hover:cursor-pointer hover:bg-gray-100"
                            v-for="task in props.completedTasks"
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
                        </tr>
                    </tbody>
                        </table>
                        <div v-else class="flex flex-col items-center">
                              <p>No Completed tasks</p>
                        </div>
                  </div>
            </template>
      </AuthenticatedLayout>
</template>