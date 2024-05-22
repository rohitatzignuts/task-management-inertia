<script setup lang="ts">
import { Project } from "../../Types/project";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TasksSpace from "../../Components/Tasks/TasksSpace.vue";
const props = defineProps<{
    project: Project;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 text-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between align-center">
                    <p
                        class="p-6 text-gray-900 dark:text-gray-100 text-2xl font-bold"
                    >
                        {{ project.title }}
                    </p>
                </div>
                <VDivider class="my-4" />
                <div>
                    <TasksSpace />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
