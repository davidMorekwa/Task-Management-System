<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AdminSideNav from '../Components/AdminSideNav.vue';
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '../Components/PrimaryButton.vue';


const props = defineProps({
      task: Object,
      users: Array
})

const formData = useForm({
      task_name: props.task.task_name,
      task_description: props.task.description,
      person_assigned: props.task.person_assigned,
      due_date: props.task.due_date
})
const isDisabled = ref(true)

const submit = () => {
      if(!isDisabled.value){
            formData.put(route('admin.update',{id: props.task.id}), {
                  onSuccess: () => {
                        console.log("TASK UPDATED SUCCESSFULLY")
                  },
                  onError: (error) => {
                        console.error("AN ERROR OCCURRED WHILE UPDATING TASK")
                        console.error(error)
                  }
            });
      } else {
            isDisabled.value = false
      }
}
const deleteTask = ()=> {
      formData.delete(route('admin.destroy',{id: props.task.id}), {
            onSuccess: () => {
                  console.log("TASK DELETED SUCCESSFULLY")
            },
            onError: (error) => {
                  console.error("AN ERROR OCCURRED WHILE DELETING TASK")
                  console.error(error)
            }
      });

}

</script>

<template>
      <AuthenticatedLayout>
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
                                :disabled="isDisabled"
                            />
                        </div>
                        <div class="m-4 w-3/4">
                            <label for="task_description">Task Description</label> <br>
                            <textarea :disabled="isDisabled" v-model="formData.task_description" class="w-full" cols="20" rows="5"></textarea>
                        </div>
                        

                        <div class="m-4 w-3/4">
                            <label for="person_assigned">Person Assigned</label> <br>
                            <select :disabled="isDisabled"  v-model="formData.person_assigned" name="person_assigned" id="person_assigned">
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
                                :disabled="isDisabled"
                            />
                        </div>
                        <br>
                        <div class="flex flex-row justify-between items-center w-full">
                              <PrimaryButton type="submit" class="w-1/3"><p class="w-full text-center"> {{ isDisabled ? "Edit" : "Save" }} Task</p></PrimaryButton>
                              <PrimaryButton @click="deleteTask()" class="bg-red-500 w-1/3"><p class="w-full text-center">Delete Task</p></PrimaryButton>
                        </div>
                        
                    </form>
                </div>
            </div>
            </template>
      </AuthenticatedLayout>
</template>