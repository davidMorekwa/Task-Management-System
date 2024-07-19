<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TaskItem from '../Components/TaskItem.vue';
</script>

<template>
      <AuthenticatedLayout>
            <template #main-content>
                  <div class="w-full h-full">
                        <h1 class="text-3xl font-bold text-center">Completed Tasks</h1>
                        <br>
                        <div class="flex flex-col items-center">
                              <TaskItem :task-name="'Task 1'" :task-status="'completed'" :task-due-date="'12/03/2024'" />
                              <TaskItem :task-name="'Task 2'" :task-status="'completed'" :task-due-date="'today'" />
                              <TaskItem :task-name="'Task 3'" :task-status="'completed'" :task-due-date="'today'" />
                              <TaskItem :task-name="'Task 4'" :task-status="'completed'" :task-due-date="'today'" />
                        </div>
                  </div>
            </template>
      </AuthenticatedLayout>
</template>