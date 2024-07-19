<script setup>
import { defineProps } from "vue";
import { computed } from "vue";
import PrimaryButton from "./PrimaryButton.vue";

const props = defineProps(["taskName", "taskDueDate", "taskStatus"]);

const buttonText = computed(() => {
    switch (props.taskStatus) {
        case "completed":
            return "Mark as Incomplete";
        case "overdue":
            return "Mark as complete";
        default:
            return "Complete";
    }
});
const btn_bg = computed(() => {
    switch (props.taskStatus) {
        case "completed":
            return "bg-blue-300";
        case "overdue":
            return "bg-red-300";
        default:
            return "bg-green-300";
    }
});

</script>

<template>
    <div
        class="w-1/2 flex flex-row justify-between p-3 rounded-md m-4 bg-gray-50 hover:cursor-pointer"
    >
        <p>{{ taskName }}</p>
        <p>{{ taskDueDate }}</p>
        <PrimaryButton>{{ buttonText }}</PrimaryButton>
    </div>
</template>
