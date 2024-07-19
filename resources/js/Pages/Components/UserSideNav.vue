<!-- This is the sidenav on the user side -->

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';



</script>

<template>
      <div >
            <Link :href="route('user.home')" class="w-full flex flex-row justify-center p-3 rounded-md m-5 bg-gray-50 hover:bg-gray-300 hover:cursor-pointer"> <!-- change bg color on click -->
                  <p class="no-underline">Pending Tasks</p> 
            </Link>
            <Link :href="route('user.completed')" class="w-full flex flex-row justify-center p-3 rounded-md m-5 bg-gray-50 hover:bg-gray-300 hover:cursor-pointer"> <!-- change bg color on click -->
                  <p>Completed Tasks</p> 
                  </Link>
            <Link :href="route('user.overdue')" class="w-full flex flex-row justify-center p-3 rounded-md m-5 bg-gray-50 hover:bg-gray-300 hover:cursor-pointer"> <!-- change bg color on click -->
                  <p>Overdue Tasks</p> 
            </Link>
            <Link :href="route('tasks.index')" class="w-full flex flex-row justify-center p-3 rounded-md m-5 bg-gray-50 hover:bg-gray-300 hover:cursor-pointer"> <!-- change bg color on click -->
                  <p>Create Tasks</p> 
            </Link>
      </div>
</template>