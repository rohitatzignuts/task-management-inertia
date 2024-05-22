<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateDialog from "@/Components/Projects/CreateDialog.vue";
import EditDialog from "@/Components/Projects/EditDialog.vue";
import { ref } from "vue";
import { Project } from "../../Types/project";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import { Task } from "@/Types/task";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    projects: Array<Project>;
}>();

const isDialogOpen = ref<Boolean>(false);
const isEditDialogOpen = ref<Boolean>(false);
const projectID = ref<number | undefined>();
const editProject = ref<Task>({
    id: undefined,
    title: undefined,
    description: undefined,
});

const handleProjectEdit = (id: number) => {
    try {
        isEditDialogOpen.value = true;
        projectID.value = id;
        handleGetProject(id);
    } catch (error) {
        console.log(error);
    }
};

const handleGetProject = async (id: number | undefined) => {
    try {
        const res = await axios.get(`projects/${id}/edit`);
        editProject.value = res.data;
    } catch (error) {
        console.log(error);
    }
};

const handleProjectDelete = (id: number) => {
    try {
        if (confirm("ARE YOU SURE?")) {
            router.delete(`projects/${id}`);
        }
    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between align-center">
                    <p
                        class="p-6 text-gray-900 dark:text-gray-100 text-2xl font-bold"
                    >
                        Projects
                    </p>
                    <div><VBtn @click="isDialogOpen = true">Create</VBtn></div>
                </div>
                <VDivider />
                <div class="grid grid-cols-4 gap-4 my-4">
                    <div v-for="project in projects" :key="project.id">
                        <v-card color="#836FFF">
                            <Link :href="`/projects/${project.id}`">
                                <v-card-title>{{
                                    project.title
                                }}</v-card-title></Link
                            >
                            <v-card-text>{{ project.description }}</v-card-text>
                            <v-card-actions>
                                <v-btn @click="handleProjectEdit(project.id)"
                                    >EDIT</v-btn
                                >
                                <v-btn @click="handleProjectDelete(project.id)"
                                    >DELETE</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </div>
                </div>
            </div>
        </div>
        <CreateDialog
            :dialog="isDialogOpen"
            @handleDialog="isDialogOpen = false"
        />
        <EditDialog
            :dialog="isEditDialogOpen"
            @handleDialog="isEditDialogOpen = false"
            :editProject="editProject"
        />
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
