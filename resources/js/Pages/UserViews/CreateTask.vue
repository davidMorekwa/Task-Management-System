<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "../Components/PrimaryButton.vue";
</script>

<template>
    <AuthenticatedLayout>
        <template #main-content>
            <div class="w-full h-full">
                <h1 class="text-3xl font-bold text-center">Create Task</h1>
                <br />
                <div class="flex flex-col justify-start items-center w-full h-full">
                    <form
                        @submit.prevent=""
                        method="post"
                        class="p-4 rounded-md border h-3/4 w-1/2 flex flex-col items-center shadow-md"
                    >
                        <div class="m-4 w-3/4">
                            <label for="task_name">Task Name</label> <br>
                            <input
                                type="text"
                                name="task_name"
                                id="task_name"
                                class="border rounded-md p-1 w-full h-10 placeholder:text-sm"
                                placeholder="Task Name"
                            />
                        </div>
                        <div class="m-4 w-3/4">
                            <label for="task_due_date">Due Date</label> <br>
                            <input
                                type="date"
                                name="task_due_date"
                                id="task_due_date"
                                class="border rounded-md p-1 w-full h-10 placeholder:font-serif placeholder:text-sm"
                            />
                        </div>
                        <br>
                        <PrimaryButton class="w-3/4"><p class="w-full text-center">Add Task</p></PrimaryButton>
                    </form>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
