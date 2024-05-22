<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import { Task } from "@/Types/task";

const props = defineProps<{
    dialog: boolean;
    editProject: Task;
}>();

const emits = defineEmits<{
    (e: "handleDialog"): void;
}>();

const handleProjectEdit = () => {
    try {
        router.put(`projects/${props.editProject.id}/update`, {
            title: props.editProject.title,
            description: props.editProject.description,
        });
        emits("handleDialog");
    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <v-dialog :model-value="dialog" width="auto" persistent>
        <v-card min-width="400" title="Edit Project">
            <v-card-text>
                <v-text-field
                    v-model="props.editProject.title"
                    name="title"
                    label="title"
                    id="title"
                />
                <v-text-field
                    v-model="props.editProject.description"
                    name="description"
                    label="description"
                    id="description"
                />
            </v-card-text>
            <v-card-actions>
                <v-btn
                    text="Edit"
                    color="primary"
                    variant="text"
                    @click="handleProjectEdit"
                />
                <v-btn
                    text="Close"
                    variant="text"
                    color="error"
                    @click="emits('handleDialog')"
                />
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
