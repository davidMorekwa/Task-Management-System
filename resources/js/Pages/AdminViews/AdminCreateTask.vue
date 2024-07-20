<script setup>
import { reactive, defineProps } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AdminSideNav from '../Components/AdminSideNav.vue';
import PrimaryButton from '../Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onErrorCaptured } from 'vue';

const props = defineProps({
    users: {
        type: Array,
        required: true
    }
})


const formData = useForm({
  task_name: null,
  task_description: null,
  person_assigned: null,
  due_date: null
})

function submit() {
    console.log(formData);
    formData.post(route('admin.store'), {
        onSuccess: () => {
            console.log("TASK CREATED SUCCESSFULLY")
        },
        onError: (error) => {
            console.error("AN ERROR OCCURRED WHILE CREATING TASK")
            console.error(error)
        }
    }
);
}
</script>

<template>
 <AuthenticatedLayout>
        <Head title="Create" />
        <template #sidenav>
                  <AdminSideNav></AdminSideNav>
            </template>
        <template #main-content>
            <div class="w-full h-full">
                <h1 class="text-3xl font-bold text-center">Create Task</h1>
                <br />
                <div class="flex flex-col justify-start items-center w-full h-full">
                    <form
                        @submit.prevent="submit"
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
                                v-model="formData.task_name"
                            />
                        </div>
                        <div class="m-4 w-3/4">
                            <label for="task_description">Task Description</label> <br>
                            <textarea v-model="formData.task_description" class="w-full" cols="20" rows="5"></textarea>
                        </div>
                        

                        <div class="m-4 w-3/4">
                            <label for="person_assigned">Person Assigned</label> <br>
                            <select v-model="formData.person_assigned" name="person_assigned" id="person_assigned">
                                <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                            </select>
                        </div>


                        <div class="m-4 w-3/4">
                            <label for="task_due_date">Due Date</label> <br>
                            <input
                                type="date"
                                name="task_due_date"
                                id="task_due_date"
                                class="border rounded-md p-1 w-full h-10 placeholder:font-serif placeholder:text-sm"
                                v-model="formData.due_date"
                            />
                        </div>
                        <br>
                        <PrimaryButton type="submit" class="w-3/4"><p class="w-full text-center">Add Task</p></PrimaryButton>
                    </form>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>