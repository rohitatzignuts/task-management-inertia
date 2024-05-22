<script setup lang="ts">
import { ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import { Task } from "../../Types/task";
import CreatedToDos from "./CreatedToDos.vue";
import axios from "axios";

const isCreating = ref<boolean>(false);
const taskTitle = ref<string>("");
const tasks = ref<Array<Task>>([]);

const handleTaskCreate = async () => {
    try {
        router.post("/tasks/store", {
            title: taskTitle.value,
            project_id: router.page.props.project.id,
        });
        taskTitle.value = "";
        isCreating.value = true;
        fetchTasks();
    } catch (error) {
        console.log(error);
    }
};

const fetchTasks = async () => {
    try {
        const res = await axios.get(`/tasks/${router.page.props.project.id}`);
        tasks.value = res.data;
    } catch (error) {
        console.log(error);
    }
};

onMounted(() => {
    fetchTasks();
});
</script>

<template>
    <div>
        <main class="grid grid-cols-3 gap-3">
            <div class="min-h-[400px] bg-[rgb(131,111,255,0.25)] p-4">
                <p class="mb-4 font-bold">
                    TO DO <span>{{ tasks.length }}</span>
                </p>
                <CreatedToDos :tasks="tasks" />
                <div v-if="isCreating">
                    <v-text-field
                        v-model="taskTitle"
                        box
                        label="title"
                        color="#836FFF"
                        class="text-[#836FFF]"
                        @focusout="isCreating = false"
                        @keyup.enter="handleTaskCreate"
                    ></v-text-field>
                </div>

                <VBtn
                    prepend-icon="mdi-plus"
                    block
                    variant="tonal"
                    @click="isCreating = true"
                    >create</VBtn
                >
            </div>

            <div class="min-h-[400px] bg-[rgb(131,111,255,0.25)] p-4">
                <p class="mb-4 font-bold">IN PROGRESS <span></span></p>
            </div>

            <div class="min-h-[400px] bg-[rgb(131,111,255,0.25)] p-4">
                <p class="mb-4 font-bold">DONE <span></span></p>
            </div>
        </main>
    </div>
</template>

<style lang="scss" scoped></style>
