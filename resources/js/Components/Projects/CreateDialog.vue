<script setup lang="ts">
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    dialog: boolean;
}>();

const emits = defineEmits<{
    (e: "handleDialog"): void;
}>();

const projectTitle = ref<String>("");
const projectDescription = ref<String>("");

const handleProjectCreate = () => {
    try {
        router.post("projects/store", {
            title: projectTitle.value,
            description: projectDescription.value,
        });
        emits("handleDialog");
        projectTitle.value = "";
        projectDescription.value = "";
    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <v-dialog :model-value="dialog" width="auto" persistent>
        <v-card min-width="400" title="Create Project">
            <v-card-text>
                <v-text-field
                    v-model="projectTitle"
                    name="title"
                    label="title"
                    id="title"
                />
                <v-text-field
                    v-model="projectDescription"
                    name="description"
                    label="description"
                    id="description"
                />
            </v-card-text>
            <v-card-actions>
                <v-btn
                    text="Submit"
                    color="primary"
                    variant="text"
                    @click="handleProjectCreate"
                />
                <v-btn
                    text="close"
                    variant="text"
                    color="error"
                    @click="emits('handleDialog')"
                />
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
